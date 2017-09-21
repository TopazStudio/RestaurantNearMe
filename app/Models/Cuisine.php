<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
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

//Relationships
    //restaurant
    public function restaurant(){
        return $this->belongsTo('App\Models\Restaurant','restaurantId');
    }

    //Pictures
    public function pictures(){
        return $this->morphMany('App\Models\Picture','pic');
    }

}
