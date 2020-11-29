<?php

namespace App\Http\Controllers;

use App\User;
use App\Banner;
use App\Category;
use App\News;
use App\Video;
use App\Gallery;
use App\CategoryGallery;
use App\Tournament;
use App\Team;
use App\Tag;
use App\Visit;
use App\NewsVisit;
use App\Day;
use App\Match;
use App\Color;
use App\Score;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Jenssegers\Agent\Agent;

class WebController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request) {
        $this->visitor();

        $num=0;
        $setting=Setting::where('id', "1")->first();
        $tournaments=Tournament::orderBy('position', 'ASC')->get();

        $carousels=Banner::where('featured', 1)->where('state', "1")->get();
        $banner_width=Banner::where('featured', 2)->where('state', "1")->first();
        $banner_middle=Banner::where('featured', 3)->where('state', "1")->first();
        $banner_bottom=Banner::where('featured', 4)->where('state', "1")->first();

        $super_featured=News::where('featured', 1)->where('state', "1")->orderBy('id', 'DESC')->limit(5)->get();
        $featureds=News::where('featured', 2)->where('state', "1")->orderBy('id', 'DESC')->limit(4)->get();
        $bottom_featured=News::where('featured', 3)->where('state', "1")->orderBy('id', 'DESC')->limit(2)->get();

        $videos=Video::where('featured', "1")->where('state', "1")->orderBy('id', 'DESC')->limit(2)->get();

        $galleries=Gallery::where('featured', "1")->where('state', "1")->orderBy('id', 'DESC')->limit(8)->get();

        $count=0;
        $count2=0;
        $matches=[];
        $results=Match::where('state', "1")->orderBy('id', 'DESC')->limit(8)->get();
        foreach ($results as $result) {
            $matches[$count][$count2]=$result;
            if ($count2==0) {
                $count2++;
            } elseif ($count2>0) {
                $count++;
                $count2=0;
            }
        }

        return view('web.home', compact('num', 'setting', 'tournaments', 'carousels', 'banner_width', 'banner_middle', 'banner_bottom', 'super_featured', 'featureds', 'bottom_featured', 'videos', 'galleries', 'matches'));
    }

    public function news(Request $request, $category=null) {
        $this->visitor();

        $setting=Setting::where('id', "1")->first();
        $tournaments=Tournament::orderBy('position', 'ASC')->get();
        $selected=$category;
        $categories=Category::all();

        if ($request->has('pagina')) {
            $offset=9*(request('pagina')-1);
        } else {
            $offset=0;
        }

        if (is_null($category)) {

            $news=News::where('state', "1")->orderBy('id', 'DESC')->offset($offset)->limit(9)->get();
            $total=News::where('state', "1")->get();
            $search=NULL;
        } else {
            $category=Category::where('slug', $category)->firstOrFail();
            $news=News::select('news.id', 'news.slug', 'news.title', 'news.image', 'news.summary', 'news.created_at')->join('category_news', 'news.id', '=', 'category_news.news_id')->where('news.state', "1")->where('category_news.category_id', $category->id)->orderBy('news.id', 'DESC')->offset($offset)->limit(9)->get();
            $total=News::join('category_news', 'news.id', '=', 'category_news.news_id')->where('news.state', "1")->where('category_news.category_id', $category->id)->get();
            $search=array('name' => $category->name, 'slug' => $category->slug);
        }

        $varPage='pagina';
        $page=Paginator::resolveCurrentPage($varPage);
        $pagination=new LengthAwarePaginator($news, $total=count($total), $perPage = 9, $page, ['path' => Paginator::resolveCurrentPath(), 'pageName' => $varPage]);

        return view('web.news', compact('setting', 'tournaments', 'news', 'categories', 'selected', 'pagination', 'search'));
    }

    public function new($category, $slug) {
        $setting=Setting::where('id', "1")->first();
        $tournaments=Tournament::orderBy('position', 'ASC')->get();
        $category=Category::where('slug', $category)->firstOrFail();
        $new=News::where('slug', $slug)->firstOrFail();

        $this->visitor($new->id);

        $banner_top=Banner::where('featured', 5)->where('state', "1")->inRandomOrder()->first();
        $banner_middle=Banner::where('featured', 6)->where('state', "1")->inRandomOrder()->first();
        $banner_bottom=Banner::where('featured', 7)->where('state', "1")->inRandomOrder()->first();

        $related_news=News::where('id', '!=', $new->id)->orderBy('id', 'DESC')->where('state', "1")->limit(2)->get();

        return view('web.new', compact('setting', 'tournaments', 'category', 'new', 'banner_top', 'banner_middle', 'banner_bottom', 'related_news'));
    }

    public function search(Request $request) {
        $this->visitor();

        $setting=Setting::where('id', "1")->first();
        $tournaments=Tournament::orderBy('position', 'ASC')->get();

        if ($request->has('pagina')) {
            $offset=9*(request('pagina')-1);
        } else {
            $offset=0;
        }

        $news=[];
        $arrays=explode(' ', request('search'));
        foreach ($arrays as $array) {
            $tags=Tag::where('slug', 'LIKE', "%".Str::slug($array, '-')."%")->get();
            foreach ($tags as $tag) {
                foreach ($tag->news as $new) {
                    $news[$new->slug]=$new;
                }
            }
        }

        $varPage='pagina';
        $page=Paginator::resolveCurrentPage($varPage);
        $pagination=new LengthAwarePaginator($news, $total=count($news), $perPage = 9, $page, ['path' => Paginator::resolveCurrentPath(), 'pageName' => $varPage]);

        return view('web.search', compact('setting', 'tournaments', 'news', 'pagination', 'offset'));
    }

    public function videos(Request $request) {
        $this->visitor();

        $setting=Setting::where('id', "1")->first();
        $tournaments=Tournament::orderBy('position', 'ASC')->get();
        if ($request->has('pagina')) {
            $offset=8*(request('pagina')-1);
        } else {
            $offset=0;
        }

        $videos=Video::where('state', "1")->orderBy('id', 'DESC')->offset($offset)->limit(8)->get();

        $varPage='pagina';
        $page=Paginator::resolveCurrentPage($varPage);
        $pagination=new LengthAwarePaginator($videos, $total=count($videos), $perPage = 8, $page, ['path' => Paginator::resolveCurrentPath(), 'pageName' => $varPage]);

        return view('web.videos', compact('setting', 'tournaments', 'videos', 'pagination'));
    }

    public function galleries(Request $request, $category=null) {
        $this->visitor();

        $setting=Setting::where('id', "1")->first();
        $tournaments=Tournament::orderBy('position', 'ASC')->get();
        $selected=$category;
        $categories=CategoryGallery::all();

        if ($request->has('pagina')) {
            $offset=16*(request('pagina')-1);
        } else {
            $offset=0;
        }

        if (is_null($category)) {
            $galleries=Gallery::where('state', "1")->orderBy('id', 'DESC')->offset($offset)->limit(16)->get();
            $total=Gallery::where('state', "1")->get();
        } else {
            $category=CategoryGallery::where('slug', $category)->firstOrFail();
            $galleries=Gallery::where('state', "1")->where('category_id', $category->id)->orderBy('id', 'DESC')->offset($offset)->limit(16)->get();
            $total=Gallery::where('state', "1")->where('category_id', $category->id)->get();
        }

        $varPage='pagina';
        $page=Paginator::resolveCurrentPage($varPage);
        $pagination=new LengthAwarePaginator($galleries, $total=count($total), $perPage = 12, $page, ['path' => Paginator::resolveCurrentPath(), 'pageName' => $varPage]);

        return view('web.galleries', compact('setting', 'tournaments', 'galleries', 'categories', 'selected', 'pagination'));
    }

    public function calendar(Request $request, $tournament) {
        $this->visitor();

        $setting=Setting::where('id', "1")->first();
        $tournaments=Tournament::orderBy('position', 'ASC')->get();
        $league=Tournament::where('slug', $tournament)->first();

        if ($request->has('day')) {
            $day=Day::where('tournament_id', $league->id)->where('day', request('day'))->first();
            if (is_null($day)) {
                $day=Day::where('tournament_id', $league->id)->orderBy('day', 'ASC')->first();
            }
        } else {
            $day=Day::where('tournament_id', $league->id)->where('state', "1")->first();
            if (is_null($day)) {
                $day=Day::where('tournament_id', $league->id)->orderBy('day', 'ASC')->first();
            }
        }

        return view('web.tournaments.calendar', compact('setting', 'tournaments', 'league', 'day'));
    }

    public function goals(Request $request)
    {
        $match=Match::where('slug', request('match'))->first();
        $num=0;
        $num2=0;
        $team_one=[];
        $team_two=[];
        foreach ($match->players as $player) {
            if ($player->team->slug==$match->teams[0]->slug) {
                $team_one[$num]=array('name' => $player->name);
                $num++;
            }

            if ($player->team->slug==$match->teams[1]->slug) {
                $team_two[$num2]=array('name' => $player->name);
                $num2++;
            }
        }

        if ($match) {
            return response()->json(['status' => true, 'team_one_name' => $match->teams[0]->name, 'team_two_name' => $match->teams[1]->name, 'team_one' => $team_one, 'team_two' => $team_two]);
        } else {
            return response()->json(['status' => false, 'type' => 'error', 'title' => 'Error', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function classification(Request $request, $tournament) {
        $this->visitor();

        $setting=Setting::where('id', "1")->first();
        $tournaments=Tournament::orderBy('position', 'ASC')->get();
        $league=Tournament::where('slug', $tournament)->first();

        if ($request->has('day')) {
            $day=Day::where('tournament_id', $league->id)->where('day', request('day'))->first();
            if (is_null($day)) {
                $day=Day::where('tournament_id', $league->id)->orderBy('day', 'ASC')->first();
            }
        } else {
            $day=Day::where('tournament_id', $league->id)->where('state', "1")->first();
            if (is_null($day)) {
                $day=Day::where('tournament_id', $league->id)->orderBy('day', 'ASC')->first();
            }
        }

        $colors=Color::where('tournament_id', $league->id)->orderBy('position', 'ASC')->get();

        $num=0;
        $teams=[];
        foreach ($league->teams as $team) {
            $teams[$num]=array('team' => $team, 'matches' => 0, 'wins' => 0, 'draw' => 0, 'losses' => 0, 'points' => 0, 'favor' => 0, 'against' => 0, 'difference' => 0);
            foreach ($team->matches as $match) {
                if (!is_null($match->pivot->goals) && $match->day->day<=$day->day) {
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

        $num=0;

        return view('web.tournaments.classification', compact('num', 'setting', 'tournaments', 'league', 'positions', 'colors', 'day'));
    }

    public function teams($tournament) {
        $this->visitor();

        $setting=Setting::where('id', "1")->first();
        $tournaments=Tournament::orderBy('position', 'ASC')->get();
        $league=Tournament::where('slug', $tournament)->first();

        return view('web.tournaments.teams', compact('setting', 'tournaments', 'league'));
    }

    public function players($tournament, $team) {
        $this->visitor();

        $setting=Setting::where('id', "1")->first();
        $tournaments=Tournament::orderBy('position', 'ASC')->get();
        $league=Tournament::where('slug', $tournament)->first();

        $team=Team::where('slug', $team)->first();

        return view('web.tournaments.players', compact('setting', 'tournaments', 'league', 'team'));
    }

    public function scorers(Request $request, $tournament) {
        $this->visitor();

        $setting=Setting::where('id', "1")->first();
        $tournaments=Tournament::orderBy('position', 'ASC')->get();
        $league=Tournament::where('slug', $tournament)->first();

        $num=0;
        $scorers=[];
        foreach ($league->teams as $teams) {
            foreach ($teams->players as $player) {
                if (count($player->matches)>0) {
                    $scorers[$num]=array('player' => $player, 'goals' => count($player->matches));
                    $num++;
                }
            }
        }

        usort($scorers, function($a, $b) {
            return $a['goals'] - $b['goals'];
        });
        $scorers=array_reverse($scorers);

        return view('web.tournaments.scorers', compact('setting', 'tournaments', 'league', 'scorers'));
    }

    public function goal(Request $request) {
        $match=Match::where('slug', request('match_id'))->firstOrFail();
        $score=Score::create(['name' => request('name'), 'time' => request('time'), 'score_one' => request('goals_one'), 'score_two' => request('goals_two'), 'team_one' => $match->teams[0]->name, 'team_two' => $match->teams[1]->name, 'tournament' => $match->day->tournament->title]);

        if ($score) {
            return redirect()->back()->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Envio exitoso', 'msg' => 'El marcador ha sido enviado exitosamente.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Envio fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function visitor($new=null) {
        $agent=new Agent();
        if ($agent->isDesktop()) {
            $device="Escritorio";
        } elseif ($agent->isMobile()) {
            if ($agent->isPhone()) {
                $device="Teléfono";
            } elseif ($agent->isTablet()) {
                $device="Tablet";
            }
        }

        if (filter_var(request()->server('HTTP_CLIENT_IP'), FILTER_VALIDATE_IP)) {
            $ip=request()->server('HTTP_CLIENTE_IP');
        }
        elseif (filter_var(request()->server('HTTP_X_FORWARDED_FOR'), FILTER_VALIDATE_IP)) {
            $ip=request()->server('HTTP_X_FORWARDED_FOR');
        }
        elseif (filter_var( request()->server('HTTP_VIA'), FILTER_VALIDATE_IP)) {
            $ip=request()->server('HTTP_VIA');
        }
        else {
            $ip=request()->server('REMOTE_ADDR');
        }

        $visit=Visit::create(['visitor' => $ip, 'device' => $device]);

        if (!is_null($new)) {
            NewsVisit::create(['news_id' => $new, 'visit_id' => $visit->id]);
        }
    }
}
