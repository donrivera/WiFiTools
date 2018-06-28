<?php

namespace App\Modules\Site\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Modules\Site\Libraries\SiteHelper;
#use App\Modules\Site\Services\DemoOne;
use App\Modules\Site\Contracts\SiteServiceInterface;
#use Jarischaefer\HalApi\Controllers\HalApiController;
#use Jarischaefer\HalApi\Controllers\HalApiControllerContract;
use URL;
use Hash;
#use Response;

class SiteController extends Controller
{
    private $site;
    //private $hal_api;
    
    public function __construct(SiteServiceInterface $site)
	{
        
        $this->site=$site;
        //$this->hal_api=$hal_api;
    }
    public function index()
    {
        //View All Sites
        return $this->site->view();
        //return $this->responseFactory->json($this->createResponse($parameters)->build());
        
    }
    public function show($id)
    {
        //View Sites Per Site ID
        return $this->site->findById($id);
        
    }    
}
