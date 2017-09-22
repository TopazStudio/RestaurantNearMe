<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use App\Models\Restaurant;
use App\Services\RestaurantService;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    protected $restaurantService;

    public function __construct(RestaurantService $restaurantService){
        if (env('APP_ENV') != 'development')
            $this->middleware('auth',['except' => ['index','show']]);
        $this->restaurantService = $restaurantService;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index()
    {
        return $this->response($this->restaurantService->getAll(),'restaurant.restaurantTable');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function create()
    {
        return $this->response([
            'mode' => 'create'
        ],'restaurant.restaurantForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'Name' => 'required|string',
            'Location' => 'required|string',
            'image' => 'image|nullable|max:1999'
        ]);

        if($this->restaurantService->add($request)){
            return $this->response([
                'success' => $this->restaurantService->info
            ],'restaurant.restaurantTable');
        }else{
            return $this->response([
                'error' => $this->restaurantService->errors
            ],'restaurant.restaurantTable');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        return $this->response($this->restaurantService->get($id),'restaurant.restaurantView');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        return $this->response([
            'mode' => 'edit',
            'modal' => $this->restaurantService->get($id)
        ],'restaurant.restaurantForm');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'Name' => 'required|string',
            'Location' => 'required|string',
            'restaurantPic' => 'image|nullable|max:1999'
        ]);


        if($this->restaurantService->update($request,$id)){
            return $this->response([
                'success' => $this->restaurantService->info
            ],'restaurant.restaurantTable');
        }else{
            return $this->response([
                'error' => $this->restaurantService->errors
            ],'restaurant.restaurantTable');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function destroy($id)
    {
        if($this->restaurantService->delete($id)){
            return $this->response([
                'success' => $this->restaurantService->info
            ],'restaurant.restaurantTable');
        }else{
            return $this->response([
                'error' => $this->restaurantService->errors
            ],'restaurant.restaurantTable');
        }
    }
}
