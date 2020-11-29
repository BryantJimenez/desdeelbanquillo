<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;
use App\Http\Requests\BannerNewsStoreRequest;
use App\Http\Requests\BannerNewsUpdateRequest;
use Illuminate\Support\Str;

class BannerNewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $banners=Banner::where('type', 2)->orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.banners.news.index', compact('banners', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerNewsStoreRequest $request)
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

                $data=array('title' => request('title'), 'slug' => $slug, 'featured' => request('featured'), 'pre_url' => $pre_url, 'url' => request('url'), 'target' => $target, 'type' => "2", 'state' => request('state'));
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

        $banner=Banner::create($data);

        if ($banner) {
            return redirect()->route('banners.noticias.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El banner ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('banners.noticias.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
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
        return view('admin.banners.news.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(BannerNewsUpdateRequest $request, $slug) {

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

        $data=array('title' => request('title'), 'featured' => request('featured'), 'pre_url' => $pre_url, 'url' => request('url'), 'target' => $target, 'state' => request('state'));

        // Mover imagen a carpeta banners y extraer nombre
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = $slug.".".$file->getClientOriginalExtension();
            if (file_exists(public_path().'/admins/img/banners/'.$image)) {
                unlink(public_path().'/admins/img/banners/'.$image);
            }
            $file->move(public_path().'/admins/img/banners/', $image);
            $data['image'] = $image;
        }

        $banner->fill($data)->save();

        if ($banner) {
            return redirect()->route('banners.noticias.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El banner ha sido editado exitosamente.']);
        } else {
            return redirect()->route('banners.noticias.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function destroy($slug)
    {
        $banner=Banner::where('slug', $slug)->firstOrFail();
        $banner->delete();

        if ($banner) {
            return redirect()->route('banners.noticias.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El banner ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('banners.noticias.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, $slug) {

        $banner = Banner::where('slug', $slug)->firstOrFail();
        $banner->fill(['state' => 0])->save();

        if ($banner) {
            return redirect()->route('banners.noticias.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El banner ha sido desactivado exitosamente.']);
        } else {
            return redirect()->route('banners.noticias.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, $slug) {

        $banner = Banner::where('slug', $slug)->firstOrFail();
        $banner->fill(['state' => "1"])->save();

        if ($banner) {
            return redirect()->route('banners.noticias.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El banner ha sido activado exitosamente.']);
        } else {
            return redirect()->route('banners.noticias.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
