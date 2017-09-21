<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
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
