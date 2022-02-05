<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCitizenRequest;
use App\Http\Requests\LGARequest;
use App\Http\Requests\StateRequest;
use App\Http\Requests\WardRequest;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\InterestSettings;
use App\Repositories\CitizenRepository;
use Hash;
use Validator;
use Auth;
use DB;

class Citizencontroller extends AppBaseController
{
    private $CitizenRepository;

    public function __construct(CitizenRepository $UserRepo)
    {
        $this->CitizenRepository = $UserRepo;
    }
    public function registerCitizen (CreateCitizenRequest $request)
    {
        $input = ($request->all());

        $citizen = $this->CitizenRepository->getByPhoneNo($input['phone_no']);

        if ($citizen) {
            return $this->sendError('user already exist', 400);
        }else {
            $this->CitizenRepository->createCitizen($input);
            return $this->sendResponse($input, 'success');
        }
        
    }
    public function createStates (CreateCitizenRequest $request)
    {
        $input = ($request->all());

        $state = $this->CitizenRepository->createstate($input);
        if ($state) {
            return $this->sendResponse($input, 'success');
        }
    }

    public function createLGA (CreateCitizenRequest $request)
    {
        $input = ($request->all());

        $lga = $this->CitizenRepository->createlga($input);
        if ($lga) {
            return $this->sendResponse($input, 'success');
        }
    }

    public function createWard (CreateCitizenRequest $request)
    {
        $input = ($request->all());

        $ward = $this->CitizenRepository->createward($input);
        if ($ward) {
            return $this->sendResponse($input, 'success');
        }
    }

    public function getAllCitizins ()
    {
        $citizen = $this->CitizenRepository->getcitizins();
        if ($citizen) {
            return $this->sendResponse($citizen, 'success');
        }
    }
    

    public function getAllWardCitizins ()
    {
        $ward = $this->CitizenRepository->getallCitizenInWard();
        if ($ward) {
            return $this->sendResponse($ward, 'success');
        }
    }
    
    public function getAllLGACitizins ()
    {
        $lga = $this->CitizenRepository->getallCitizenInLga();
        if ($lga) {
            return $this->sendResponse($lga, 'success');
        }
    }
    
    public function getAllStateCitizins ()
    {
        $state = $this->CitizenRepository->getallCitizenInState();
        if ($state) {
            return $this->sendResponse($state, 'success');
        }
    }
}