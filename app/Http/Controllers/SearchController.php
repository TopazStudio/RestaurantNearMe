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
     * Index the entities in storage for searching.
     *
     * @return \Illuminate\Http\JsonResponse
    */
    public function index(){
        if (Cuisine::index()){
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    /**
     * Do a complex search on the entity
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function complex(Request $request){
        if ($foods = Cuisine::complexSearch($request->all())){
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
     * @param $term
     * @return \Illuminate\Http\JsonResponse
     */
    public function simple($term){
        //TODO: fix simple search
        $f = new Cuisine();
//        $f->docTypeName = 'Bevourage';
        if ($foods = $f::search($term)){
            return response()->json([
                'took' => $foods->took(),
                'totalHits' => $foods->totalHits(),
                'hits'=>$foods->all(),
            ]);
        }
        return $this->errorResponse();
    }
}