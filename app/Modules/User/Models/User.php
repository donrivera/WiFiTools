<?php

namespace App\Modules\User\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //use EntrustUserTrait;
    //use Notifiable;
    //use EntrustUserTrait;
    use Notifiable, HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /*
    public function role()
    {
        return $this->belongsToMany('App\Modules\User\Models\Role');
    }
    /*
    public function permissions()
    {
        return $this->belongsToMany('App\Modules\User\Models\Permission');
    }
   */ 
}
