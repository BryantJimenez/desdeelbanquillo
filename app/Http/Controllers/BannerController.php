<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;
use App\Http\Requests\BannerStoreRequest;
use App\Http\Requests\BannerUpdateRequest;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $banners = Banner::orderBy('id', 'DESC')->get();
        $num = 1;
        return view('admin.banners.index', compact('banners', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerStoreRequest $request)
    {
        $count=Banner::where('title', request('title'))->count();
        $slug=Str::slug(request('title'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Banner::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('title'), '-')."-".$num;
                $num++;
            } else {
                if (!empty(request('url'))) {
                    $pre_url=request('pre_url');
                    if (!empty(request('target'))) {
                        $target=request('target');
                    } else {
                        $target=0;
                    }
                } else {
                    $pre_url=NULL;
                    $target=0;
                }

                $data=array('title' => request('title'), 'slug' => $slug, 'type' => request('type'), 'pre_url' => $pre_url, 'url' => request('url'), 'target' => $target, 'state' => request('state'));
                break;
            }
        }

        // Mover imagen a carpeta banners y extraer nombre
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = $slug.".".$file->getClientOriginalExtension();
            $file->move(public_path().'/admins/img/banners/', $image);
            $data['image'] = $image;
        }

        if (request('state')==1 && request('type')!=1) {
            $count_last = Banner::where('type', request('type'))->where('state', "1")->count();
            if ($count_last>=1) {
                $last = Banner::where('type', request('type'))->where('state', "1")->orderBy('id', 'DESC')->first();;
            }
        }

        $banner=Banner::create($data);

        if ($banner) {
            if (request('state')==1 && request('type')!=1 && $count_last>=1) {
                $last->fill(['state' => "0"])->save();
            }

            return redirect()->route('banners.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El banner ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('banners.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $banner=Banner::where('slug', $slug)->firstOrFail();
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(BannerUpdateRequest $request, $slug) {

        $banner=Banner::where('slug', $slug)->firstOrFail();
        if (!empty(request('url'))) {
            $pre_url=request('pre_url');
            if (!empty(request('target'))) {
                $target=request('target');
            } else {
                $target=0;
            }
        } else {
            $pre_url=NULL;
            $target=0;
        }

        $data=array('title' => request('title'), 'type' => request('type'), 'pre_url' => $pre_url, 'url' => request('url'), 'target' => $target, 'state' => request('state'));

        // Mover imagen a carpeta banners y extraer nombre
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = $slug.".".$file->getClientOriginalExtension();
            $file->move(public_path().'/admins/img/banners/', $image);
            $data['image'] = $image;
        }

        if (request('state')==1 && request('type')!=1) {
            $count_last = Banner::where('type', request('type'))->where('state', "1")->count();
            if ($count_last>=1) {
                $last = Banner::where('type', request('type'))->where('state', "1")->orderBy('id', 'DESC')->first();
            }
        }

        $banner->fill($data)->save();

        if ($banner) {
            if (request('state')==1 && request('type')!=1 && $count_last>=1) {
                if ($banner->slug!=$last->slug) {
                    $last->fill(['state' => "0"])->save();
                }
            }

            return redirect()->route('banners.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El banner ha sido editado exitosamente.']);
        } else {
            return redirect()->route('banners.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, $slug) {

        $banner = Banner::where('slug', $slug)->firstOrFail();
        $banner->fill(['state' => "0"])->save();

        if ($banner) {
            return redirect()->route('banners.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El banner ha sido desactivado exitosamente.']);
        } else {
            return redirect()->route('banners.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, $slug) {
        $banner = Banner::where('slug', $slug)->firstOrFail();

        if ($banner->type!=1) {
            $count_last = Banner::where('type', $banner->type)->where('state', "1")->count();
            if ($count_last>=1) {
                $last = Banner::where('type', $banner->type)->where('state', "1")->orderBy('id', 'DESC')->first();
            }
        }

        $banner->fill(['state' => "1"])->save();

        if ($banner->type!=1 && $count_last>=1) {
            if ($banner->slug!=$last->slug) {
                $last->fill(['state' => "0"])->save();
            }
        }

        if ($banner) {
            return redirect()->route('banners.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El banner ha sido activado exitosamente.']);
        } else {
            return redirect()->route('banners.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
