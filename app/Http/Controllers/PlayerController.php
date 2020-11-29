<?php

namespace App\Http\Controllers;

use App\Team;
use App\Player;
use App\Position;
use Illuminate\Http\Request;
use App\Http\Requests\PlayerStoreRequest;
use App\Http\Requests\PlayerUpdateRequest;
use Illuminate\Support\Str;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tournament, $team)
    {
        $team=Team::where('slug', $team)->first();
        $num=1;
        return view('admin.players.index', compact('tournament', 'team', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tournament, $team)
    {
        $positions=Position::all();
        return view('admin.players.create', compact('tournament', 'team', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlayerStoreRequest $request, $tournament, $team)
    {
        $count=Player::where('name', request('name'))->count();
        $slug=Str::slug(request('name'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Player::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('name'), '-')."-".$num;
                $num++;
            } else {
                $team=Team::where('slug', $team)->firstOrFail();
                $position=Position::where('slug', request('position_id'))->firstOrFail();
                $data=array('name' => request('name'), 'slug' => $slug, 'number' => request('number'), 'position_id' => $position->id, 'team_id' => $team->id);
                break;
            }
        }

        // Mover imagen a carpeta players y extraer nombre
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $image = $slug.".".$file->getClientOriginalExtension();
            $file->move(public_path().'/admins/img/players/', $image);
            $data['photo'] = $image;
        }

        $player=Player::create($data);

        if ($player) {
            return redirect()->route('jugadores.index', ['tournament' => $tournament, 'team' => $team->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El jugador ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('jugadores.index', ['tournament' => $tournament, 'team' => $team->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit($tournament, $team, $slug)
    {
        $player=Player::where('slug', $slug)->firstOrFail();
        $positions=Position::all();
        return view('admin.players.edit', compact('tournament', 'team', 'player', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(PlayerUpdateRequest $request, $tournament, $team, $slug)
    {
        $team=Team::where('slug', $team)->firstOrFail();
        $player=Player::where('slug', $slug)->where('team_id', $team->id)->firstOrFail();
        $position=Position::where('slug', request('position_id'))->firstOrFail();
        $data=array('name' => request('name'), 'number' => request('number'), 'position_id' => $position->id);

        // Mover imagen a carpeta players y extraer nombre
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $image = $slug.".".$file->getClientOriginalExtension();
            if (file_exists(public_path().'/admins/img/players/'.$image)) {
                unlink(public_path().'/admins/img/players/'.$image);
            }
            $file->move(public_path().'/admins/img/players/', $image);
            $data['photo'] = $image;
        }

        $player->fill($data)->save();

        if ($player) {
            return redirect()->route('jugadores.edit', ['tournament' => $tournament, 'team' => $team->slug, 'slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El jugador ha sido editado exitosamente.']);
        } else {
            return redirect()->route('jugadores.edit', ['tournament' => $tournament, 'team' => $team->slug, 'slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy($tournament, $team, $slug)
    {
        $team=Team::where('slug', $team)->firstOrFail();
        $player=Player::where('slug', $slug)->where('team_id', $team->id)->firstOrFail();
        $player->delete();

        if ($player) {
            return redirect()->route('jugadores.index', ['tournament' => $tournament, 'team' => $team->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El jugador ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('jugadores.index', ['tournament' => $tournament, 'team' => $team->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
