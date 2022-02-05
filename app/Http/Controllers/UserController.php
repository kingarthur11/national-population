<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SignupRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserRepository;
use Hash;
use Validator;
use Auth;
use DB;

class UserController extends AppBaseController
{
    private $UserRepository;

    public function __construct(UserRepository $UserRepo)
    {
        $this->UserRepository = $UserRepo;
    }
    public function signup (SignupRequest $request)
    {
        $input = ($request->all());
        $input['password'] = Hash::make($input['password']);

        $userSignup = $this->UserRepository->getByEmail($input['email']);

        if ($userSignup) {
            return $this->sendError('user already exist', 400);
        }else {
            $this->UserRepository->createUser($input);
            return $this->sendResponse($input, 'success');
        }
        
    }

    public function login (LoginRequet $request)
    {
        $login_data = ($request->all());
        $customer = $this->customerRepository->getByEmail($login_data['email']);
        if(!$customer) {
            return $this->sendError('User does not exist', 422);
        }
        if (!(Hash::check($login_data['password'], $customer->password))) {
            return $this->sendError('Password mismatch', 422);
        }

        $token = $customer->createToken('Laravel Password Grant Client')->accessToken;
        $customerData = $this->customerRepository->getByEmailLogin($login_data['email']);
       
        $customerData[0]['token'] = $token;
        return $this->sendResponse($customerData[0], 'login successfully');

    }
}