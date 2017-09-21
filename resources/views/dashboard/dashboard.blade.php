@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        <a href="cuisine/create" class="btn btn-primary">
                            Register Cuisine
                        </a>
                        <a href="restaurants/create" class="btn btn-primary">
                            Register Restaurant
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
