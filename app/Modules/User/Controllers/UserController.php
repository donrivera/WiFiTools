<?php

namespace App\Modules\User\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Modules\User\Libraries\ResponseHelper;
#use App\Modules\Site\Services\DemoOne;
use App\Modules\User\Contracts\UserServiceInterface;
#use Jarischaefer\HalApi\Controllers\HalApiController;
#use Jarischaefer\HalApi\Controllers\HalApiControllerContract;
use URL;
use Hash;
#use Response;
 
class UserController extends Controller
{
    public function __construct(UserServiceInterface $user)
	{
        
        $this->user=$user;
        //$this->hal_api=$hal_api;
    }
    public function index()
    {
        //View All Sites
        return $this->user->view();
    }
    public function show($id)
    {
        //View Sites Per Site ID
        return $this->user->findById($id);
        
    }   
    public function authCheck()
    {
        //Return if Auth is Expired
        return $this->user->authCheck();
    }
    public function logOut()
    {   //Unset Auth 
        return $this->user->logOut();
    }
    public function store(Request $request)
    {
        $validate=$this->validate($request, 
            [
                'name'      => 'required',
                'email'     => 'required',
                'password'  => 'required|min:6'
            ]);
        if(!$validate)
        {return $this->user->store($request);}
        
    }
    public function update(Request $request,$id)
    {
        $validate=$this->validate($request, 
            [
                'name'      => 'required',
                'email'     => 'required',
                'password'  => 'required|min:6'
            ]);
        if(!$validate)
        {return $this->user->update($request,$id);}
    }
}