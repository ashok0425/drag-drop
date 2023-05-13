<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        $cities=config('city');
       return view('frontend.index',compact('cities'));
    }

    public function register(Request $request)
    {
       return view('frontend.register');
    }

    public function login(Request $request)
    {
       return view('frontend.login');
    }
}
