<?php
namespace App\Modules\Site\Observers;
#use Illuminate\Database\Eloquent\Model;
use App\Modules\Site\Models\Site;

class SiteObserver
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