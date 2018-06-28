<?php
// app/Library/Services/Contracts/CustomServiceInterface.php
namespace App\Modules\Log\Contracts;
  
Interface LogServiceInterface
{
    public function view();
    public function findByMc($mc);
    public function show($min);
    public function showPerMC($data=array());
    public function showError($min);
}