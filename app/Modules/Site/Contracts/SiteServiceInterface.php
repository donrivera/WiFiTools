<?php
// app/Library/Services/Contracts/CustomServiceInterface.php
namespace App\Modules\Site\Contracts;
  
Interface SiteServiceInterface
{
    public function doSomethingUseful();
    public function view();
    public function findById($id);
}