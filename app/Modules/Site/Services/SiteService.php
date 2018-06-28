<?php
namespace App\Modules\Site\Services;
use App\Modules\Site\Contracts\SiteServiceInterface;
use App\Modules\Site\Models\Site;
use App\Modules\Site\Helpers\ResponseHelper;
class SiteService implements SiteServiceInterface
{
    public function doSomethingUseful()
    {
      return 'Output from DemoOne Class One';
    }
    public function view()
    { 
      return ResponseHelper::jsonSuccess(Site::all());
    }
    public function findById($id)
    {
      $findbyid=Site::find($id);
      $error="ID Not Found...";
      return (($findbyid)?ResponseHelper::jsonSuccess($findbyid):ResponseHelper::jsonFailed($error));
      
      
    }
    public function findProductBySiteId($id)
    {
      //$product=
    }
}