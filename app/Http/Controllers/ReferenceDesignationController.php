<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReferenceDesignationRequest;
use App\Http\Requests\UpdateReferenceDesignationRequest;
use App\Repositories\ReferenceDesignationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ReferenceDesignationController extends AppBaseController
{
    /** @var  ReferenceDesignationRepository */
    private $referenceDesignationRepository;

    public function __construct(ReferenceDesignationRepository $referenceDesignationRepo)
    {
        $this->referenceDesignationRepository = $referenceDesignationRepo;
    }

    /**
     * Display a listing of the ReferenceDesignation.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $referenceDesignations = $this->referenceDesignationRepository->all();

        return view('reference_designations.index')
            ->with('referenceDesignations', $referenceDesignations);
    }

    /**
     * Show the form for creating a new ReferenceDesignation.
     *
     * @return Response
     */
    public function create()
    {
        return view('reference_designations.create');
    }

    /**
     * Store a newly created ReferenceDesignation in storage.
     *
     * @param CreateReferenceDesignationRequest $request
     *
     * @return Response
     */
    public function store(CreateReferenceDesignationRequest $request)
    {
        $input = $request->all();

        $referenceDesignation = $this->referenceDesignationRepository->create($input);

        Flash::success('Reference Designation saved successfully.');

        return redirect(route('referenceDesignations.index'));
    }

    /**
     * Display the specified ReferenceDesignation.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $referenceDesignation = $this->referenceDesignationRepository->find($id);

        if (empty($referenceDesignation)) {
            Flash::error('Reference Designation not found');

            return redirect(route('referenceDesignations.index'));
        }

        return view('reference_designations.show')->with('referenceDesignation', $referenceDesignation);
    }

    /**
     * Show the form for editing the specified ReferenceDesignation.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $referenceDesignation = $this->referenceDesignationRepository->find($id);

        if (empty($referenceDesignation)) {
            Flash::error('Reference Designation not found');

            return redirect(route('referenceDesignations.index'));
        }

        return view('reference_designations.edit')->with('referenceDesignation', $referenceDesignation);
    }

    /**
     * Update the specified ReferenceDesignation in storage.
     *
     * @param int $id
     * @param UpdateReferenceDesignationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReferenceDesignationRequest $request)
    {
        $referenceDesignation = $this->referenceDesignationRepository->find($id);

        if (empty($referenceDesignation)) {
            Flash::error('Reference Designation not found');

            return redirect(route('referenceDesignations.index'));
        }

        $referenceDesignation = $this->referenceDesignationRepository->update($request->all(), $id);

        Flash::success('Reference Designation updated successfully.');

        return redirect(route('referenceDesignations.index'));
    }

    /**
     * Remove the specified ReferenceDesignation from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $referenceDesignation = $this->referenceDesignationRepository->find($id);

        if (empty($referenceDesignation)) {
            Flash::error('Reference Designation not found');

            return redirect(route('referenceDesignations.index'));
        }

        $this->referenceDesignationRepository->delete($id);

        Flash::success('Reference Designation deleted successfully.');

        return redirect(route('referenceDesignations.index'));
    }
}
