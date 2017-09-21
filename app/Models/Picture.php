<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'location',
        'picturable_id',
        'picturable_type',
    ];

//RELATIONSHIPS
    //polymorphic relationship
    public function pic(){
        return $this->morphTo();
    }
}
