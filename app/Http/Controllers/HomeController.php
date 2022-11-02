<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function about()
    {
        return view('home.about');
    }

    public function contact()
    {
        return view('home.contact');
    }
}
