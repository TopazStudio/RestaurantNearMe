<?php

namespace App\Models;

use App\Util\AutoCRUD\Cruddable;
use App\Util\SessionUtil;
use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model implements Cruddable
{
    use ElasticquentTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Name',
        'Location',
        'Longitude',
        'Latitude',
        'Likes',
        'DisLikes',
        'managerId'
    ];

    public static function crudSettings(){
        return[
            'hasPicture'=>true,
            'attributes' => [
                'Name',
                'Location',
                'Longitude',
                'Latitude',
            ],
            'relationships' => [
                'managerId' => (\Redis::hgetall(SessionUtil::getRedisSession() . ':user:current'))['id']
            ],
            'parentRel' => ['managerId' => (\Redis::hgetall(SessionUtil::getRedisSession() . ':user:current'))['id']]
        ];
    }

//INDEXING

    function getIndexName()
    {
        return 'restaurants';
    }

    public static function index(){
        $restaurants = self::all();
        $restaurants->addToIndex();
        dd($restaurants);

        return true;
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
