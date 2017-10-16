@extends('layouts.app')

@section('content')
    <!--banner-->
    <section id="banner">
        <div class="bg-color">
            <header id="header">
                <div class="container">
                    <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn">&times;</a>
                        <!-- Authentication Links -->
                        @guest
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Register</a>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                        <a href="#search">Search</a>
                        <a href="#about">About</a>
                        <a href="#contact-us">Contact Us</a>
                    </div>
                    <!-- Use any element to open the sidenav -->
                    <span class="pull-right menu-icon">☰</span>
                </div>
            </header>
            <div class="container">
                <div class="row">
                    <div class="inner text-center">
                        <h1 class="logo-name">Restaurant Near Me</h1>
                        <h2>Find restaurants near you.</h2>
                    </div>
                    <div id="search" class="col-xs-12 text-center" style="padding:60px;">
                        <input type="text" name="search" id="mainSearch" placeholder="Search Restaurants, Cuisine and Locations">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / banner -->
    @include('inc.aboutus')
@endsection