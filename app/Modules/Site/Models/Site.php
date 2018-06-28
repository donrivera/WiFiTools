<?php

namespace App\Modules\Site\Models;

use Illuminate\Database\Eloquent\Model;

// use App\Modules\SubscriberGroup\Models\SubscriberGroup;
// use App\Modules\SubscriberGroup\Models\SubscriberGroupSitePivot;

class Site extends Model
{

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'voucher_cms';

    /**
     * Database table used for this model.
     *
     * @var string
     */
    protected $table = 'site';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'site_id';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'auth_ip', 'auth_key', 'auth_port', 'ac_brand'
    ];

    ### RELATIONSHIPS

    // /**
    //  * The owner of the site.
    //  * 1:1
    //  */
    // public function owner()
    // {
    //     return $this->belongsTo('App\Models\User',
    //                             'owner_id',
    //                             'user_id');
    // }
    //
    // /**
    //  * The authentication methods that are associated with the site.
    //  * 1:many
    //  */
    // public function authMethods()
    // {
    //     return $this->hasMany('App\Models\SiteAuthMethod',
    //                           'site_id',
    //                           'site_id');
    // }
    
    public function voucherBatches()
    {
        return $this->hasMany('App\Modules\Voucher\Models\VoucherBatch',
                              'site_id',
                              'site_id');
    }
    
    // /**
    //  * The access controllers that are associated with the site.
    //  * many:many
    //  */
    // public function accessControllers()
    // {
    //     return $this->belongsToMany('App\Modules\Site\Models\AccessController',
    //                                 'site_access_controller',
    //                                 'access_controller_id',
    //                                 'site_id');
    // }
    //
    // /**
    //  * The access point groups that are associated with the site.
    //  * many:many
    //  */
    // public function accessPointGroups()
    // {
    //     return $this->belongsToMany('App\Modules\Site\Models\AccessPointGroup',
    //                                 'site_access_point_group',
    //                                 'access_point_group_id',
    //                                 'site_id');
    // }
    //
    // /**
    //  * The SSIDs that are associated with the site.
    //  * many:many
    //  */
    // public function ssids()
    // {
    //     return $this->belongsToMany('App\Modules\Site\Models\ServiceSet',
    //                                 'site_service_set',
    //                                 'service_set_id',
    //                                 'site_id');
    // }

    /**
     * The products that are associated with the site.
     * many:many
     */
    
    public function products()
    {
        return $this->belongsToMany('App\Models\Product',
                                    'site_product',
                                    'product_id',
                                    'site_id');
    }
    
    // /**
    //  * Relation between site and site wifi model
    //  * @return Collection
    //  */
    // public function wifi()
    // {
    //     return $this->hasOne('App\Modules\Site\Models\SiteWifi',
    //                          'site_id',
    //                          'site_id');
    // }
    //
    // /**
    //  * Relation betweent site and site_ad; 1:many
    //  * @return Collection
    //  */
    // public function ads()
    // {
    //     return $this->hasMany('App\Modules\Site\Models\SiteAd',
    //                           'site_id',
    //                           'site_id');
    // }
    //
    // /**
    //  * The subscriber groups that are associated with the site.
    //  * many:many
    //  */
    // public function subscriberGroups()
    // {
    //     return $this->belongsToMany('App\Modules\SubscriberGroup\Models\SubscriberGroup',
    //                                 'subscriber_group_site',
    //                                 'site_id',
    //                                 'group_id');
    // }

    /**
     * Pivot model for many-to-many relationthips
     */
    // public function newPivot(Model $parent, array $attributes, $table, $exists)
    // {
    //     if ($parent instanceof SubscriberGroup) {
    //         return new SubscriberGroupSitePivot($parent,
    //                                             $attributes,
    //                                             $table,
    //                                             $exists);
    //     }

    //     return parent::newPivot($parent, $attributes, $table, $exists);
    // }
}
