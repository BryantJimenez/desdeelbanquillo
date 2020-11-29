<?php

namespace App\Http\Controllers;

use App\Tournament;
use App\Day;
use App\Match;
use App\Stadium;
use App\Team;
use App\Color;
use App\Player;
use App\MatchTeam;
use App\MatchPlayer;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tournament)
    {
        $tournament=Tournament::where('slug', $tournament)->firstOrFail();
        return view('admin.results.index', compact('tournament'));
    }

    public function classification($tournament)
    {
        $tournament=Tournament::where('slug', $tournament)->firstOrFail();
        $colors=Color::where('tournament_id', $tournament->id)->orderBy('position', 'ASC')->get();

        $num=0;
        $teams=[];
        foreach ($tournament->teams as $team) {
            $teams[$num]=array('team' => $team, 'matches' => 0, 'wins' => 0, 'draw' => 0, 'losses' => 0, 'points' => 0, 'favor' => 0, 'against' => 0, 'difference' => 0);
            foreach ($team->matches as $match) {
                if (!is_null($match->pivot->goals)) {
                    $teams[$num]['matches']=$teams[$num]['matches']+1;
                    $teams[$num]['favor']=$teams[$num]['favor']+$match->pivot->goals;

                    foreach ($match->teams as $team_match) {
                        if ($team_match->id!=$team->id) {
                            $rival_goals=$team_match->pivot->goals;
                            $teams[$num]['against']=$teams[$num]['against']+$team_match->pivot->goals;
                        }
                    }

                    if ($match->pivot->goals>$rival_goals) {
                        $teams[$num]['points']=$teams[$num]['points']+3;
                        $teams[$num]['wins']=$teams[$num]['wins']+1;
                    } elseif ($match->pivot->goals==$rival_goals) {
                        $teams[$num]['points']=$teams[$num]['points']+1;
                        $teams[$num]['draw']=$teams[$num]['draw']+1;
                    } else {
                        $teams[$num]['losses']=$teams[$num]['losses']+1;
                    }
                }
            }
            $teams[$num]['difference']=$teams[$num]['favor']-$teams[$num]['against'];
            $num++;
        }

        usort($teams, function($a, $b) {
            return $a['points'] - $b['points'];
        });
        $teams=array_reverse($teams);

        $num=0;
        $num2=0;
        $prev=true;
        $positions=[];
        foreach ($teams as $team) {
            if ($prev===true) {
                $positions[$num][$num2]=$team;
            } else {
                if ($prev!=$team['points']) {
                    $num++;
                    $num2=0;
                    $positions[$num][$num2]=$team;
                } else {
                    $num2++;
                    $positions[$num][$num2]=$team;
                }
            }
            $prev=$team['points'];           
        }

        for ($i=0; $i < count($positions); $i++) { 
            usort($positions[$i], function($a, $b) {
                return $a['difference'] - $b['difference'];
            });
            $positions[$i]=array_reverse($positions[$i]);
        }

        $num=1;

        return view('admin.results.classification', compact('num', 'tournament', 'positions', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		// Validación para que no se repita el slug
    	$slug='partido';
    	$num=0;
    	while (true) {
    		$count=Match::where('slug', $slug)->count();
    		if ($count>0) {
    			$slug='partido-'.$num;
    			$num++;
    		} else {
    			$day=Day::where('slug', request('day'))->first();
    			$stadium=Stadium::where('slug', request('stadium'))->first();
    			$first_team=Team::where('slug', request('first_team'))->first();
    			$second_team=Team::where('slug', request('second_team'))->first();
    			if (is_null($day) || is_null($stadium) || is_null($first_team) || is_null($second_team)) {
    				return response()->json(['status' => false, 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
    			}

    			$data=array('slug' => $slug, 'date' => date('Y-m-d H:i:s', strtotime(request('date'))), 'stadium_id' => $stadium->id, 'day_id' => $day->id);
    			break;
    		}
    	}

    	$match=Match::create($data);

    	MatchTeam::create(['team_id' => $first_team->id, 'match_id' => $match->id]);
    	MatchTeam::create(['team_id' => $second_team->id, 'match_id' => $match->id]);

    	if ($match) {
    		return response()->json(['status' => true, 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El partido ha sido registrado exitosamente.', 'date' => date('d-m-Y H:i', strtotime(request('date')))." hs", 'first_team' => $first_team->name, 'second_team' => $second_team->name, 'stadium' => $stadium->name, 'match' => $match->slug]);
    	} else {
    		return response()->json(['status' => false, 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
    	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
    	$match=Match::where('slug', $slug)->firstOrFail();
        $tournament=$match->day->tournament->slug;
    	$match->delete();

        if ($match) {
            return redirect()->route('jornadas.index', ['tournament' => $tournament])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El partido ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('jornadas.index', ['tournament' => $tournament])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function goals(Request $request)
    {
        $match=Match::where('slug', request('match'))->first();
        $match_team=MatchTeam::where('match_id', $match->id)->where('team_id', $match->teams[request('team')]->id)->first();
        $match_team->fill(['goals' => request('goals')])->save();

        if (request('team')=="0") {
            $match_team2=MatchTeam::where('match_id', $match->id)->where('team_id', $match->teams[1]->id)->first();
        } else {
            $match_team2=MatchTeam::where('match_id', $match->id)->where('team_id', $match->teams[0]->id)->first();
        }

        if (is_null($match_team2->goals)) {
            $match_team2->fill(['goals' => "0"])->save();
        }

        if ($match && $match_team) {
            return response()->json(['status' => true, 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'Los goles han sido editados exitosamente.']);
        } else {
            return response()->json(['status' => false, 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function matchState(Request $request)
    {
        $match=Match::where('slug', request('match'))->first();
        $match->fill(['state' => request('state')])->save();

        if ($match) {
            return response()->json(['status' => true, 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El partido ha sido editado exitosamente.']);
        } else {
            return response()->json(['status' => false, 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function state(Request $request)
    {
        $day=Day::where('slug', request('day'))->first();
        foreach ($day->tournament->days as $days) {
            $days=Day::where('slug', $days->slug)->first();
            $days->fill(['state' => "0"])->save();
        }
        $day->fill(['state' => request('state')])->save();

        if ($day) {
            return response()->json(['status' => true, 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La jornada por defecto ha sido editada exitosamente.']);
        } else {
            return response()->json(['status' => false, 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function teams(Request $request)
    {
        $match=Match::where('slug', request('match'))->first();

        if ($match) {
            if (is_null($match->teams[0]->pivot->goals)) {
                $goals1=0;
            } else {
                $goals1=$match->teams[0]->pivot->goals;
            }

            if (is_null($match->teams[1]->pivot->goals)) {
                $goals2=0;
            } else {
                $goals2=$match->teams[1]->pivot->goals;
            }

            return response()->json(['status' => true, 'team_one_name' => $match->teams[0]->name, 'team_two_name' => $match->teams[1]->name, 'team_one_goals' => $goals1, 'team_two_goals' => $goals2, 'team_one' => $match->teams[0]->players, 'team_two' => $match->teams[1]->players]);
        } else {
            return response()->json(['status' => false, 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function players(Request $request)
    {
        $match=Match::where('slug', request('match'))->first();

        $match_players=MatchPlayer::where('match_id', $match->id)->get();
        foreach ($match_players as $match_player) {
            $match_play=MatchPlayer::where('id', $match_player->id)->first();
            $match_play->delete();
        }

        if ($request->has('players1')) {
            $players1=request('players1');
            foreach ($players1 as $player) {
                $player=Player::where('slug', $player)->first();
                MatchPlayer::create(['player_id' => $player->id, 'match_id' => $match->id]);
            }
        }

        if ($request->has('players2')) {
            $players2=request('players2');
            foreach ($players2 as $player) {
                $player=Player::where('slug', $player)->first();
                MatchPlayer::create(['player_id' => $player->id, 'match_id' => $match->id]);
            }
        }

        if ($match) {
            return response()->json(['status' => true, 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'Los goleadores han sido registrados exitosamente.']);
        } else {
            return response()->json(['status' => false, 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function colors(Request $request, $tournament)
    {
        $tournament=Tournament::where('slug', $tournament)->firstOrFail();
        $color=Color::where('tournament_id', $tournament->id)->where('position', request('position'))->firstOrFail();
        $color->fill(['color' => request('color')])->save();

        if ($color) {
            return redirect()->route('resultados.classification', ['tournament' => $tournament->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El color ha sido editado exitosamente.']);
        } else {
            return redirect()->route('resultados.classification', ['tournament' => $tournament->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
