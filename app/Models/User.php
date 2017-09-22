<?php

namespace App\Models;

use App\Util\RedisMapper\MappableInRedis;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MappableInRedis
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAttributeMap()
    {
        return [
            'id',
            'name',
            'email',
            'password',
            'role'
        ];
    }

//Relationships
    //restaurant
    public function restaurant(){
        return $this->hasOne('App\Models\Restaurant','managerId');
    }
}
