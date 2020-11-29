<?php

namespace App\Http\Controllers;

use App\Day;
use App\Stadium;
use App\Tournament;
use App\Team;
use Illuminate\Http\Request;

class DayController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tournament)
    {
        $tournament=Tournament::where('slug', $tournament)->firstOrFail();
        $stadiums=Stadium::all();
        return view('admin.days.index', compact('tournament', 'stadiums'));
    }
}
