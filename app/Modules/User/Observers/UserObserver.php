<?php
namespace App\Modules\User\Observers;
#use Illuminate\Database\Eloquent\Model;
use App\Modules\User\Models\User;

class UserObserver
{
    /*
   public function creating(Item $item)
   {
      $item->name = strtoupper($item->name);
   }
   */
   public function retrieved(Site $site)
   {
        $site->address = "DONPARRIVERA".strtoupper($site->address);
   }
}