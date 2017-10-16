<?php

namespace App\Models;

use App\Util\SessionUtil;
use App\Util\AutoCRUD\Cruddable;
use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class Cuisine extends Model implements Cruddable
{
    use ElasticquentTrait;

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

//CRUD
    /**
     * Settings used for automatic CRUD function.
     *
     * @return array
    */
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

//INDEXING
    /**
     * Model's index type
     *
     * @var string
     */
    public $docTypeName;

    //TODO: make this its own table then create a relationship
    public static $types = [
        'Bevourage',
        'Meat',
        'Full Coarse',
    ];

    function getIndexName()
    {
        return 'cuisine_catalog';
    }

    function getTypeName()
    {
        return $this->docTypeName;
    }

    public static function index(){
        foreach (self::$types as $type){
            $cuisines = self::where('Type','=',$type)->get();
            if(!empty($cuisines)){
                foreach ($cuisines as $cuisine){
                    $cuisine->docTypeName = $type;
                }
                $cuisines->addToIndex();
            }
        }
        return true;
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
