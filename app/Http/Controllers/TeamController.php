<?php

namespace App\Http\Controllers;

use App\Team;
use App\Tournament;
use App\Color;
use Illuminate\Http\Request;
use App\Http\Requests\TeamStoreRequest;
use App\Http\Requests\TeamUpdateRequest;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tournament)
    {
        $tournament=Tournament::where('slug', $tournament)->first();
        $num=1;
        return view('admin.teams.index', compact('tournament', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tournament)
    {
        return view('admin.teams.create', compact('tournament'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamStoreRequest $request, $tournament)
    {
        $count=Team::where('name', request('name'))->count();
        $slug=Str::slug(request('name'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Team::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('name'), '-')."-".$num;
                $num++;
            } else {
                $tournament=Tournament::where('slug', $tournament)->firstOrFail();
                $data=array('name' => request('name'), 'slug' => $slug, 'tournament_id' => $tournament->id);
                break;
            }
        }

        // Mover imagen a carpeta teams y extraer nombre
        if ($request->hasFile('shield')) {
            $file = $request->file('shield');
            $image = $slug.".".$file->getClientOriginalExtension();
            $file->move(public_path().'/admins/img/teams/', $image);
            $data['shield'] = $image;
        }

        $team=Team::create($data);

        if ($team) {
            $colors=Color::where('tournament_id', $tournament->id)->orderBy('position', 'DESC')->get();
            foreach ($colors as $color) {
                if ($color->color=="#dddddd") {
                    Color::create(['position' => $color->position, 'tournament_id' => $tournament->id])->save();
                    break;
                }
            }

            $count=Color::where('tournament_id', $tournament->id)->count();
            if ($count==0) {
                Color::create(['position' => 1, 'tournament_id' => $tournament->id])->save();
            }

            if ($count>0 && $count==count($colors)) {
                $color=Color::where('tournament_id', $tournament->id)->orderBy('position', 'DESC')->first();
                Color::create(['position' => $color->position+1, 'tournament_id' => $tournament->id])->save();
            }

            $num=1;
            $colors=Color::where('tournament_id', $tournament->id)->orderBy('position', 'ASC')->get();
            foreach ($colors as $color) {
                $color=Color::where('id', $color->id)->first();
                $color->fill(['position' => $num])->save();
                $num++;
            }

            return redirect()->route('equipos.index', ['tournament' => $tournament->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El equipo ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('equipos.index', ['tournament' => $tournament->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit($tournament, $slug)
    {
        $team=Team::where('slug', $slug)->firstOrFail();
        return view('admin.teams.edit', compact('tournament', 'team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(TeamUpdateRequest $request, $tournament, $slug)
    {
        $tournament=Tournament::where('slug', $tournament)->firstOrFail();
        $team=Team::where('slug', $slug)->where('tournament_id', $tournament->id)->firstOrFail();
        $data=array('name' => request('name'));

        // Mover imagen a carpeta teams y extraer nombre
        if ($request->hasFile('shield')) {
            $file = $request->file('shield');
            $image = $slug.".".$file->getClientOriginalExtension();
            if (file_exists(public_path().'/admins/img/teams/'.$image)) {
                unlink(public_path().'/admins/img/teams/'.$image);
            }
            $file->move(public_path().'/admins/img/teams/', $image);
            $data['shield'] = $image;
        }

        $team->fill($data)->save();

        if ($team) {
            return redirect()->route('equipos.edit', ['tournament' => $tournament->slug, 'slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El equipo ha sido editado exitosamente.']);
        } else {
            return redirect()->route('equipos.edit', ['tournament' => $tournament->slug, 'slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy($tournament, $slug)
    {
        $tournament=Tournament::where('slug', $tournament)->firstOrFail();
        $team=Team::where('slug', $slug)->where('tournament_id', $tournament->id)->firstOrFail();
        $team->delete();

        if ($team) {
            $colors=Color::where('tournament_id', $tournament->id)->orderBy('position', 'DESC')->get();
            foreach ($colors as $color) {
                if ($color->color=="#dddddd") {
                    $color=Color::where('id', $color->id)->firstOrFail();
                    $color->delete();
                    break;
                }
            }

            $count=Color::where('tournament_id', $tournament->id)->count();
            if ($count==count($colors)) {
                $color=Color::where('tournament_id', $tournament->id)->orderBy('position', 'DESC')->first();
                $color->delete();
            }

            $num=1;
            $colors=Color::where('tournament_id', $tournament->id)->orderBy('position', 'ASC')->get();
            foreach ($colors as $color) {
                $color=Color::where('id', $color->id)->first();
                $color->fill(['position' => $num])->save();
                $num++;
            }

            return redirect()->route('equipos.index', ['tournament' => $tournament->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El equipo ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('equipos.index', ['tournament' => $tournament->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
