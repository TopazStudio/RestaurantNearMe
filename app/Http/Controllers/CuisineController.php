<?php

namespace App\Http\Controllers;

use App\Models\Cuisine;
use App\Services\CuisineService;
use Illuminate\Http\Request;

class CuisineController extends Controller
{

    private $cuisineService;

    /**
     * Create a new controller instance.
     *
     *
     * @param CuisineService $cuisineService
     * @internal param RestaurantService $restaurantService
     */
    public function __construct(CuisineService $cuisineService)
    {
        if (env('APP_ENV') != 'development')
            $this->middleware('auth',['except' => ['index','show']]);
        $this->cuisineService = $cuisineService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        //TODO: add cuisine view
        return $this->response($this->cuisineService->getAll());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return $this->response([
            'mode' => 'create'
        ],'cuisine.cuisineForm');
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
            'Type' => 'required|string',
            'image' => 'image|nullable|max:1999'
        ]);

        if($this->cuisineService->addCuisine($request)){
            return $this->response([
                'success' => $this->cuisineService->info
            ],'dashboard.dashboard');
        }else{
            return $this->response([
                'error' => $this->cuisineService->errors
            ],'dashboard.dashboard');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param Cuisine $cuisine
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Illuminate\View\View
     * @internal param int $id
     */
    public function show(Cuisine $cuisine)
    {
        return $this->response($cuisine);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'Name' => 'required|string',
            'Type' => 'required|string',
            'cuisinePic' => 'image|nullable|max:1999'
        ]);


        if($this->cuisineService->updateCuisine($request,$id)){
            return $this->response([
                'success' => $this->cuisineService->info
            ],'dashboard.dashboard');
        }else{
            return $this->response([
                'error' => $this->cuisineService->errors
            ],'dashboard.dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function destroy($id)
    {
        if($this->cuisineService->deleteCuisine($id)){
            return $this->response([
                'success' => $this->cuisineService->info
            ],'dashboard.dashboard');
        }else{
            return $this->response([
                'error' => $this->cuisineService->errors
            ],'dashboard.dashboard');
        }
    }
}
