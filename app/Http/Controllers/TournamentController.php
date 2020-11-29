<?php

namespace App\Http\Controllers;

use App\Tournament;
use App\Day;
use Illuminate\Http\Request;
use App\Http\Requests\TournamentStoreRequest;
use App\Http\Requests\TournamentUpdateRequest;
use Illuminate\Support\Str;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $tournaments=Tournament::orderBy('position', 'ASC')->get();
        $num=1;
        return view('admin.tournaments.index', compact('tournaments', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tournaments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TournamentStoreRequest $request)
    {
        $count=Tournament::where('title', request('title'))->count();
        $slug=Str::slug(request('title'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Tournament::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('title'), '-')."-".$num;
                $num++;
            } else {
                $tournaments=Tournament::orderBy('position', 'DESC')->get();
                foreach ($tournaments as $champion) {
                    $champion->fill(['position' => $champion->position+1])->save();
                }
                $data=array('title' => request('title'), 'slug' => $slug, 'year' => request('year'), 'day' => request('days'), 'position' => '1');
                break;
            }
        }

        $tournament=Tournament::create($data);

         $this->dayStore($tournament, $request);

        if ($tournament) {
            return redirect()->route('torneos.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El torneo ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('torneos.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $tournament=Tournament::where('slug', $slug)->firstOrFail();
        return view('admin.tournaments.edit', compact('tournament'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(TournamentUpdateRequest $request, $slug) {

        $tournament=Tournament::where('slug', $slug)->firstOrFail();
        $data=array('title' => request('title'), 'year' => request('year'), 'day' => request('days'));
        $tournament->fill($data)->save();

        $this->dayUpdate($tournament, $request);

        if ($tournament) {
            return redirect()->route('torneos.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El torneo ha sido editado exitosamente.']);
        } else {
            return redirect()->route('torneos.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function destroy($slug)
    {
        $tournament=Tournament::where('slug', $slug)->firstOrFail();
        $tournament->delete();

        if ($tournament) {
            return redirect()->route('torneos.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El torneo ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('banners.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function down($slug)
    {
        $tournament=Tournament::where('slug', $slug)->firstOrFail();
        $down=Tournament::where('position', $tournament->position+1)->firstOrFail();

        $tournament->fill(['position' => $tournament->position+1])->save();
        $down->fill(['position' => $down->position-1])->save();

        if ($tournament && $down) {
            return redirect()->route('torneos.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El torneo ha sido editado exitosamente.']);
        } else {
            return redirect()->route('banners.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function up($slug)
    {
        $tournament=Tournament::where('slug', $slug)->firstOrFail();
        $up=Tournament::where('position', $tournament->position-1)->firstOrFail();

        $tournament->fill(['position' => $tournament->position-1])->save();
        $up->fill(['position' => $up->position+1])->save();

        if ($tournament && $up) {
            return redirect()->route('torneos.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El torneo ha sido editado exitosamente.']);
        } else {
            return redirect()->route('banners.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function dayStore($tournament, $request)
    {
        for ($i=0; $i < $request->days; $i++) {
            // Validación para que no se repita el slug
            $slug='jornada';
            $num=0;
            while (true) {
                $count=Day::where('slug', $slug)->count();
                if ($count>0) {
                    $slug='jornada-'.$num;
                    $num++;
                } else {
                    $data=array('day' => $i+1, 'slug' => $slug, 'tournament_id' => $tournament->id);
                    break;
                }
            }

            Day::create($data);
        }
    }

    public function dayUpdate($tournament, $request)
    {
        $count=count($tournament->days);
        if ($count<$request->days) {
            for ($i=$count; $i < $request->days; $i++) {
            // Validación para que no se repita el slug
                $slug='jornada';
                $num=0;
                while (true) {
                    $count=Day::where('slug', $slug)->count();
                    if ($count>0) {
                        $slug='jornada-'.$num;
                        $num++;
                    } else {
                        $data=array('day' => $i+1, 'slug' => $slug, 'tournament_id' => $tournament->id);
                        break;
                    }
                }

                Day::create($data);
            }
        } elseif ($count>$request->days) {
            foreach ($tournament->days as $day) {
                if ($day->day>$request->days) {
                    $delete_day=Day::where('id', $day->id)->firstOrFail();
                    $delete_day->delete();
                }
                
            }
        }
    }
}
