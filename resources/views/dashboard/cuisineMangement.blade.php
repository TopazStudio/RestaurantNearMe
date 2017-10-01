@extends('dashboard')

@section('main')
    <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
        <div>
            <h2>CUISINE MANAGEMENT</h2><br>
            <form class="form-inline mt-2 mt-md-0" style="float:left;">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <button class="btn btn-outline-success btn-lg" style="float:right;">NEW</button>
        </div>
        <div class="table-responsive">
            @include('cuisine.cuisineTable')
        </div>
        @include('cuisine.cuisineForm')
    </main>
@endSection