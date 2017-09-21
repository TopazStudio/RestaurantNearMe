<?php
/**
 * Created by PhpStorm.
 * User: erikn
 * Date: 9/19/2017
 * Time: 11:23 AM
 */

namespace App\Services;

use App\Models\Restaurant;
use App\Traits\HandlesImages;
use Illuminate\Http\Request;
class RestaurantService extends Service {

    use HandlesImages;

    protected $picType = 'restaurantPic';

    protected $picPath = 'public/restaurantPic';

    public function addRestaurant(Request $request){

        $restaurant = Restaurant::create([
            'Name' => $request->name,
            'Location' => $request->location,
            'Likes' => '0',
            'Dislikes' => '0',
            'managerId' => auth()->user()->id
        ]);

        //Handle image
        if ($request->hasFile('restaurant_image')){
            $this->handleImage($request,$restaurant->id);
        }else{
            $this->defaultImage($restaurant->id);
        }

        return empty($this->errors);
    }
}