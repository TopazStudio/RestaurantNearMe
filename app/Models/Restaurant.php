<?php

namespace App\Models;

use App\Util\AutoCRUD\Cruddable;
use App\Util\SessionUtil;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model implements Cruddable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Name',
        'Location',
        'Likes',
        'DisLikes',
        'managerId'
    ];

    public static function crudSettings(){
        return[
            'hasPicture'=>true,
            'attributes' => [
                'Name',
                'Location'
            ],
            'relationships' => [
                'managerId' => (\Redis::hgetall(SessionUtil::getRedisSession() . ':user:current'))['id']
            ],
            'parentRel' => ['managerId' => (\Redis::hgetall(SessionUtil::getRedisSession() . ':user:current'))['id']]
        ];
    }

//Restaurants
    //Cuisine
    public function cuisine(){
        return $this->hasMany('App\Models\Cuisine','restaurantId');
    }

    //Manager
    public function manager(){
        return $this->belongsTo('App\Models\User','managerId');
    }

    //Pictures
    public function pictures(){
        return $this->morphMany('App\Models\Picture','pic');
    }
}
