<?php
/**
 * Created by PhpStorm.
 * User: erikn
 * Date: 9/19/2017
 * Time: 11:23 AM
 */

namespace App\Http\Controllers;

use App\Models\Cuisine;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Determine the enitity being searched for
     *
     * @param $entity
     * @return string
     */
    private function route($entity){
        switch ($entity){
            case 'cuisine':
                return 'App\Models\Cuisine';
                break;
            case  'restaurant':
                return 'App\Models\Restaurant';
                break;
            default:
                return 'App\Models\Cuisine';
                break;
        }
    }

    /**
     * Index the entities in storage for searching.
     *
     * @param $entity
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($entity){
        if (call_user_func([$this->route($entity),'index'])){
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    /**
     * Do a complex search on the entity
     *
     * @param $entity
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function complex($entity,Request $request){
        if ($foods = call_user_func([$this->route($entity),'complexSearch'],$request->all())){
            return response()->json([
                'took' => $foods->took(),
                'totalHits' => $foods->totalHits(),
                'hits'=>$foods->all(),
                'aggr' => $foods->getAggregations(),
            ]);
        }
        return $this->errorResponse();
    }

    /**
     * Do a simple search on the entity
     *
     * @param $entity
     * @param $term
     * @return \Illuminate\Http\JsonResponse
     */
    public function simple($entity,$term){
        //TODO: fix simple search
        if ($foods = call_user_func([$this->route($entity),'search'],$term)){
            return response()->json([
                'took' => $foods->took(),
                'totalHits' => $foods->totalHits(),
                'hits'=>$foods->all(),
            ]);
        }
        return $this->errorResponse();
    }
}