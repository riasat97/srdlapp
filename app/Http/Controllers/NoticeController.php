<?php

namespace App\Http\Controllers;

use App\DataTables\NoticeDataTable;
use App\Http\Requests\CreateNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;
use App\Models\Notice;
use App\Models\NoticeAttachment;
use App\Repositories\NoticeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Response;

class NoticeController extends AppBaseController
{
    /** @var  NoticeRepository */
    private $noticeRepository;

    public function __construct(NoticeRepository $noticeRepo)
    {
        $this->noticeRepository = $noticeRepo;
    }

    /**
     * Display a listing of the Notice.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
       $notices = $this->noticeRepository->all();
        return view('notices.index')
            ->with('notices', $notices);
    }
    public function notices(NoticeDataTable $dataTable,Request $request)
    {
        return $dataTable->render('notices.notice_attachments');
    }

    /**
     * Show the form for creating a new Notice.
     *
     * @return Response
     */
    public function create()
    {
        return view('notices.create');
    }

    /**
     * Store a newly created Notice in storage.
     *
     * @param CreateNoticeRequest $request
     *
     * @return Response
     */
    public function store(CreateNoticeRequest $request)
    {
        //$input = $request->all();
       // $notice = $this->noticeRepository->create($input);
        $notice= Notice::create([
            'title' => $request->get('title'),
            'published_at' => $request->get('published_at'),
        ]);

        foreach($request->file('filenames') as $file){
            $attachment= new NoticeAttachment();
            $fileName = time().'_'.$file->getClientOriginalName();
            $filePath = $file->storeAs('notices', $fileName, 'public');
            $attachment->file = time().'_'.$file->getClientOriginalName();
            $attachment->file_path = $filePath;
            $notice->attachments()->save($attachment);
        }
        Flash::success('Notice saved successfully.');

        return redirect(route('notice.attachments'));
    }

    /**
     * Display the specified Notice.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $notice = $this->noticeRepository->find($id);

        if (empty($notice)) {
            Flash::error('Notice not found');

            return redirect(route('notices.index'));
        }

        return view('notices.show')->with('notice', $notice);
    }

    /**
     * Show the form for editing the specified Notice.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $notice = $this->noticeRepository->find($id);

        if (empty($notice)) {
            Flash::error('Notice not found');

            return redirect(route('notices.index'));
        }

        return view('notices.edit')->with('notice', $notice);
    }

    /**
     * Update the specified Notice in storage.
     *
     * @param int $id
     * @param UpdateNoticeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNoticeRequest $request)
    {
        $notice= Notice::where('id',$id)->first();
        if (empty($notice)) {
            Flash::error('Notice not found');

            return redirect(route('notices.index'));
        }
        $notice = [
            'title' => $request->get('title'),
            'published_at' => $request->get('published_at')
        ];

        $notice= Notice::where('id',$id)->update($notice);
        $notice= Notice::where('id',$id)->first();
        $notice=$this->fileUpload($request,$request->file('file1'),$notice,'file1');
        $notice->save();
       // $notice = $this->noticeRepository->update($request->all(), $id);

        Flash::success('Notice updated successfully.');

        return redirect(route('notices.index'));
    }
    public function fileUpload(Request $req,$file,$attachment,$ex){
        $appFilePath= $ex."_path";
        if(!empty($attachment->$appFilePath)  ){
            Storage::delete($attachment->$appFilePath);
        }
        $fileName = time().'_'.$file->getClientOriginalName();
        $filePath = $req->file($ex)->storeAs('notices', $fileName, 'public');
        $attachment->$ex = time().'_'.$file->getClientOriginalName();
        $attachment->$appFilePath = $filePath;
        return $attachment;
    }
    /**
     * Remove the specified Notice from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $notice = $this->noticeRepository->find($id);

        if (empty($notice)) {
            Flash::error('Notice not found');

            return redirect(route('notices.index'));
        }
        if(!empty($notice->attachments)){
            foreach($notice->attachments as $attachment){
                Storage::delete($attachment->file_path);
            }
        }

        $this->noticeRepository->delete($id);

        Flash::success('Notice deleted successfully.');

        return redirect(route('notices.index'));
    }
    public function displayPdf($id,$path){
        $notice= NoticeAttachment::where('id',$id)->first();
        if(!empty($notice->$path)){
            //$file =  base_path().'/public/uploads/documents/'.$application;
            $fileName =  $notice->$path;
            $file=Storage::path($fileName);
            //dd($file);
            if (Storage::exists($fileName)){

                $ext =File::extension($file);
                //dd($ext);
                if($ext=='pdf'){
                    $content_types='application/pdf';
                }elseif ($ext=='doc') {
                    $content_types='application/msword';
                }elseif ($ext=='docx') {
                    $content_types='application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                }elseif ($ext=='xls') {
                    $content_types='application/vnd.ms-excel';
                }elseif ($ext=='xlsx') {
                    $content_types='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
                }elseif ($ext=='txt') {
                    $content_types='application/octet-stream';
                }

                return response(file_get_contents($file),200)
                    ->header('Content-Type',$content_types);

            }else{
                abort(404);
                //exit('Requested file does not exist on our server!');
            }

        }else{
            abort(404);
        }
    }
}
