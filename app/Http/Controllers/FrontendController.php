<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function home(){
        return view('index');
    }



    function about(){
        return view('about');
    }

    function contact()
    {
        return view('contact');
    }


    function service()
    {
        return view('service');
    }
    
}
