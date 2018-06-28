<?php
// app/Library/Services/Contracts/CustomServiceInterface.php
namespace App\Modules\User\Contracts;
  
Interface UserServiceInterface
{
    public function view();
    public function findById($id);
    public function authCheck();
    public function logOut();
    public function store($request);
    public function update($request,$id);
}