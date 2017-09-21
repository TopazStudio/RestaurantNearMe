<?php
/**
 * Created by PhpStorm.
 * User: erikn
 * Date: 9/19/2017
 * Time: 11:23 AM
 */

namespace App\Services;
use App\Models\Cuisine;
use App\Traits\HandlesImages;
use Illuminate\Http\Request;

class CuisineService extends Service
{
    use HandlesImages;

    protected $picType = 'cuisinePic';

    protected $picPath = 'public/cuisinePic';

    /**
     * Used to fetch a Cuisine without any restriction.
     *
     * @param Request $request
     * @return Cuisine|CuisineService
     * @internal param $id
     */
    public function addCuisine(Request $request){

        $cuisine = Cuisine::create([
            'Name' => $request->name,
            'Type' => $request->type,
            'restaurantId' => auth()->user()->restaurant->id
        ]);

        if ($cuisine) $this->info['added'] = $cuisine->id;
        else $this->errors['add']['Add Failed'] = $cuisine->id;

        //Handle image
        if ($request->hasFile($this->picType)){
            $this->handleImage($request,$cuisine->id);
        }else{
            $this->defaultImage($cuisine->id);
        }

        return empty($this->errors);
    }

    public function getAll(){
        return Cuisine::all();
    }

    /**
     * Used to fetch a Cuisine without any restriction.
     *
     * @param $id
     * @return Cuisine|CuisineService
     */
    public function get($id){
        return Cuisine::where('id','=',$id);
    }

    /**
     * Used to update a Cuisine owned by the current user,
     *
     * @param $id
     * @return bool
     */
    public function updateCuisine(Request $request,$id){
        $cuisine = Cuisine::where('id','=',$id);
        if($cuisine->update($request->only('Name,Type'))){
            $this->info['updated'] = $id;
        }else{
            $this->errors['update']['Not Updated'] = $id;
        }

        return empty($this->errors);
    }

    /**
     * Used to delete a Cuisine owned by the current user,
     *
     * @param $id
     * @return bool
     */
    public function deleteCuisine($id){
        $cuisine = Cuisine::where('id','=',$id);
        if($cuisine->delete()){
            $this->info['deleted'] = $id;
        }else{
            $this->errors['delete']['Delete Failed'] = $id;
        }

        return empty($this->errors);
    }
}