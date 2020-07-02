<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;

class WebController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $num=0;
        $carousels=Banner::where('type', 1)->where('state', "1")->get();
        $banner_width=Banner::where('type', 2)->where('state', "1")->first();
        $banner_middle=Banner::where('type', 3)->where('state', "1")->first();
        $banner_bottom=Banner::where('type', 4)->where('state', "1")->first();
        return view('web.home', compact('num', 'carousels', 'banner_width', 'banner_middle', 'banner_bottom'));
    }

    public function notices() {
        return view('web.notices');
    }

    public function videos() {
        return view('web.videos');
    }
}
