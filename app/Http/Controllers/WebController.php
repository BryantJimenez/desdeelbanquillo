<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('web.home');
    }

    public function notices() {
        return view('web.notices');
    }

    public function videos() {
        return view('web.videos');
    }
}
