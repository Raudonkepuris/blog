@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="row justify-content-center">
    <div class="col-2 p-0"></div>

    <div class="col-8 center">
        <div class="row">
            <img src="{{ asset("assets/pepe_band.gif") }}" alt="Pepe band" class="w-100">
        </div>

        <div class="row">
            <h1 id="welcome" class="text-goldenrod text-center">Welcome!</h1>
        </div>

        <div class="row" id="abt-website">
            <ul class="main lst-none">
                <li class="main"><h5>About this website:</h5></li>
                <ul class="second lst-none">
                    <li class="second">Started at school (as all great things *cough cough* linux, *cough cough* C++), this blog is becoming a worldwide craze, between three or four people.</li>
                    <li class="second">Registrations are disabled and the whole user-role functionality is reserved for jannies, as I see no purpose for using them with visiting users. Using sessions I have implemented the basic functionality for rating and commenting on posts, which provides anonimity as I don't store any browser information.</li>
                </ul>

                <li class="main"><h5>Find me on other platforms:</h5></li>
                <ul class="second">
                    <img src="{{ asset("assets/vastemptiness.gif") }}" alt="" style="height:100px; width:auto;">
                </ul>
            </ul>
        </div>

        <div class="row align-content-center">
            <div class="col chad">
                <a href="https://landchad.net/" target="_blank"><img src="{{ asset("assets/landchad.gif") }}" alt="landchad.net"></a>
            </div>
        </div>
    </div>

    <div class="col-2 p-0"></div>
</div>
@endsection
