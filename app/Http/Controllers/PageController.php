<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function dashboard () : View
    {
        return view('pages.dashboard');
    }

    public function home () : View
    {
        return view('pages.home');
    }
}
