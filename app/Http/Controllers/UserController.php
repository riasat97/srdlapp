<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\UserLog;
use App\Repositories\UserRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Response;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('users.index');
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();

        //$user = $this->userRepository->create($input);
        $user = User::create([
            'username' => $input['username'],
            'password' => Hash::make($input['password']),
            'name' => $input['name'],
            'designation' => $input['designation'],
            //'posting_type' => $input['posting_type'],
            'mobile' => $input['mobile'],
            'email' => $input['email'],
        ]);
        $user->assignRole($input['role']);
        Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if (Auth::user()->hasRole(['super admin']))
            $user = $this->userRepository->find($id);
        elseif (Auth::user()->id == $id)
            $user = $this->userRepository->find($id);
        else  return abort(403);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }
        $isPap= Auth::user()->hasAnyRole(['district','upazila'])?true:false;
        if (Auth::user()->hasRole(['vendor','trainer'])){
            $name=$user->name;
            $email= $user->email;
            return view('users.edit',['user'=>$user,'name'=>$name,'email'=>$email,'isPap'=>$isPap]);
        }
        $designations= $this->getDesignationsByUserRole($user);
        $designation_selected= $this->getSelectedDesignation($user);
        $name = $this->getName($user);
        $email= $this->getEmail($user);
        return view('users.edit',['user'=>$user,'name'=>$name,'email'=>$email,'designations'=>$designations,
            'designation_selected'=>$designation_selected,'isPap'=>$isPap]);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        //dd($request->all());
        if (Auth::user()->hasRole(['super admin'])){
            $user = $this->userRepository->update($request->all(), $id);
            Flash::success('User updated successfully.');
            return redirect(route('users.index'));
        }
        elseif (Auth::user()->id == $id){
            $user = $this->userRepository->update(array_merge($request->all(),['status'=>1]), $id);
            $this->updateUserLog($user,$request);
            Flash::success('User updated successfully.');
            return redirect(route('users.edit',['id'=>$id]));
        }
        else  return abort(403);
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }

    private function getName(User $user)
    {
        $name_parts = explode(" ", $user->name);
        if (Auth::user()->hasRole(['district admin'])) {
            if (count(explode(" ",$user->name)) == 3)
                $name = strtolower($name_parts[0]) . "_" . strtolower($name_parts[2]);
            return (!empty($name)&&$name == $user->username) ? "" : $user->name;
        }
        if (Auth::user()->hasRole(['upazila admin'])) {
            if (count(explode(" ",$user->name)) == 3)
                $name = strtolower($name_parts[0]). "_"  . explode("_", $user->username)[1] . "_" . strtolower($name_parts[2]);
            return (!empty($name)&&$name == $user->username) ? "" : $user->name;
        }
            return $user->name;
    }
    private function getEmail(User $user)
    {
        if(empty($user->email)) return '';
        $email_parts = explode("@", $user->email);
        $email_match = '@'.strtolower($email_parts[1]);
        return (!empty($email_match)&&$email_match == '@mail.com') ? "" : $user->email;
    }
    private function getDesignationsByUserRole(User $user){
        if ($user->hasRole(['district admin']) && !$user->hasRole(['district'])) {
            return array('0' => 'নির্বাচন করুন', 'dc' => 'জেলা প্রশাসক', 'adc' => 'অতিরিক্ত জেলা প্রশাসক');
        }
        if ($user->hasRole(['district'])) {
            return array('0' => 'নির্বাচন করুন', 'programmer' => 'প্রোগ্রামার', 'ap' => 'সহকারী প্রোগ্রামার', 'ane' => 'সহকারী নেটওয়ার্ক ইঞ্জিনিয়ার');
        }
        if ($user->hasRole(['upazila admin']) && !$user->hasRole(['upazila'])) {
            return array('0' => 'নির্বাচন করুন', 'uno' => 'উপজেলা নির্বাহী অফিসার');
        }
        if ($user->hasRole(['upazila'])) {
            return array('0' => 'নির্বাচন করুন', 'ap' => 'সহকারী প্রোগ্রামার');
        }
        return [];
    }

    private function getSelectedDesignation(User $user)
    {
        if(!empty($user)&&$user->designation)
            return $user->designation;
        if ($user->hasRole(['district admin']) && !$user->hasRole(['district'])) {
            return 'dc';
        }
        if ($user->hasRole(['district'])) {
            return 'programmer';
        }
        if ($user->hasRole(['upazila admin']) && !$user->hasRole(['upazila'])) {
            return 'uno';
        }
        if ($user->hasRole(['upazila'])) {
            return 'ap';
        }
        return 0;
    }

    private function updateUserLog(User $user,$request)
    {
        if($user->wasChanged('name') && $user->wasChanged('mobile') or $user->wasChanged('name') && $user->wasChanged('email') ){
            $userlog= UserLog::create(array_merge($request->all(),['user_id'=>$user->id]));
        }

    }
}
