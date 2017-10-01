@extends('layouts.app')

@section('content')
    @include('inc.nav')
    <div class="container-fluid">
        <div class="row">
            <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
                <ul class="nav nav-pills flex-column">
                    {{--<li class="nav-item">
                        <a class="nav-link active" href="{{ route('dashboard.cuisine') }}">Cuisine <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('dashboard.analytics') }}">Analystics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('dashboard.settings') }}">Settings</a>
                    </li>--}}
                </ul>

            </nav>
            @yield('main')
        </div>
    </div>
@endsection

