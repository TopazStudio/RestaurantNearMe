<?php

namespace App\Models;

use App\Util\AutoCRUD\Cruddable;
use App\Util\SessionUtil;
use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model implements Cruddable
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cuisine';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Name',
        'Type',
        'Likes',
        'DisLikes',
        'restaurantId'
    ];

    public static function crudSettings()
    {
        return[
            'hasPicture'=>true,
            'attributes' => [
                'Name',
                'Type'
            ],
            'relationships' => [
                'restaurantId' => (\Redis::hgetall(SessionUtil::getRedisSession() . ':user:restaurant'))['id']
            ],
            'parentRel' => ['restaurantId' => (\Redis::hgetall(SessionUtil::getRedisSession() . ':user:restaurant'))['id']]
        ];
    }

//Relationships
    public function relationships(){
        return [
            ['App\Models\Restaurant'=>'restaurantId']
        ];
    }

    //restaurant
    public function restaurant(){
        return $this->belongsTo('App\Models\Restaurant','restaurantId');
    }

    //Pictures
    public function pictures(){
        return $this->morphMany('App\Models\Picture','pic');
    }
}
