@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center marb-35">
                <h1 class="header-h">Restaurant Registration</h1>
                <p class="header-p">Give the name of your restaurant and help as to locate it. Will bring customers right to your door step!!</p>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">RESTAURANT FORM</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ $mode == 'create'? route('restaurants.store'): route('restaurants.update') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('Name') ? ' has-error' : '' }}">
                                <label for="Name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="Name" type="text" class="form-control" name="Name" value="{{ old('Name') }}" required autofocus>

                                    @if ($errors->has('Name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('Name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--TODO: change Location to address from the results --}}
                            <div class="form-group{{ $errors->has('Address') ? ' has-error' : '' }}">
                                <label for="Location" class="col-md-4 control-label">Address</label>

                                <div class="col-md-6">
                                    <input id="Location" type="text" class="form-control" name="Location" value="{{ old('Address') }}" placeholder="Nairobi West, Nairobi, Kenya" required autofocus>

                                    @if ($errors->has('Address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('Address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <br>

                            {{--MAP--}}
                            <div style="position: relative;">
                                <p>Just to get a clear view of where you are.</p>
                                <div id="locQuery">
                                    <input id="addressInput" type="text" placeholder="Enter the location here">
                                    <input id="long" name="Longitude" type="hidden">
                                    <input id="lat" name="Latitude" type="hidden">
                                    <button onclick="event.preventDefault(); getLatLng()">OK</button>
                                </div>
                                <div id="map"></div>
                            </div>
                            {{--END OF MAP--}}

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        SUBMIT
                                    </button>

                                    <button type="reset" class="btn btn-primary">
                                        CANCEL
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection