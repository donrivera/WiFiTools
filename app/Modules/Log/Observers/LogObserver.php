<?php
namespace App\Modules\Log\Observers;
#use Illuminate\Database\Eloquent\Model;
use App\Modules\Log\Models\Log;

class LogObserver
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