<?php

namespace App\Modules\Log\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Modules\Log\Libraries\ResponseHelper;
use App\Modules\Log\Contracts\LogServiceInterface;
use URL;
use Hash;

class LogController extends Controller
{
    public function __construct(LogServiceInterface $log)
	{
        
        $this->log=$log;
        //$this->hal_api=$hal_api;
    }
    public function index()
    {
        //View All Sites
        return $this->log->view();
    }
    public function show($min)
    {
        //View Sites Per Site ID
        return $this->log->show($min);//findById($id);
        
    }  
    public function showPerMc(Request $request,$mc=null,$min=null)
    {
        //dd($request->route());
        //$request->path()
        //$route=$request->route();
        //dd($route[2]['first']);
        //dd($request->input('second'));
        //dd($first);
        //print_r($request->input());
        //View Sites Per Site ID
        //dd($request->get('first'));
        return $this->log->showPerMc(array("ip"=>"112.198.100.186","min"=>$min));
        
    }    
    public function showError($min)
    {
        return $this->log->showError($min);//findById($id);
        
    }    
}