<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\CategoryGallery;
use Illuminate\Http\Request;
use App\Http\Requests\GalleryStoreRequest;
use App\Http\Requests\GalleryUpdateRequest;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries=Gallery::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.galleries.index', compact('galleries', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=CategoryGallery::all();
        return view('admin.galleries.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryStoreRequest $request)
    {
        $count=Gallery::where('title', request('title'))->count();
        $slug=Str::slug(request('title'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Gallery::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('title'), '-')."-".$num;
                $num++;
            } else {
                $category=CategoryGallery::where('slug', request('category_id'))->firstOrFail();
                $data=array('title' => request('title'), 'slug' => $slug, 'featured' => request('featured'), 'state' => request('state'), 'category_id' => $category->id);
                break;
            }
        }

        // Mover imagen a carpeta galleries y extraer nombre
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = $slug.".".$file->getClientOriginalExtension();
            $file->move(public_path().'/admins/img/galleries/', $image);
            $data['image'] = $image;
        }

        $gallery=Gallery::create($data);

        if ($gallery) {
            return redirect()->route('galerias.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La foto ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('galerias.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $gallery=Gallery::where('slug', $slug)->firstOrFail();
        $categories=CategoryGallery::all();
        return view('admin.galleries.edit', compact('gallery', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryUpdateRequest $request, $slug)
    {
        $gallery=Gallery::where('slug', $slug)->firstOrFail();
        $category=CategoryGallery::where('slug', request('category_id'))->firstOrFail();
        $data=array('title' => request('title'), 'featured' => request('featured'), 'state' => request('state'), 'category_id' => $category->id);

        // Mover imagen a carpeta galleries y extraer nombre
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = $slug.".".$file->getClientOriginalExtension();
            if (file_exists(public_path().'/admins/img/galleries/'.$image)) {
                unlink(public_path().'/admins/img/galleries/'.$image);
            }
            $file->move(public_path().'/admins/img/galleries/', $image);
            $data['image'] = $image;
        }

        $gallery->fill($data)->save();

        if ($gallery) {
            return redirect()->route('galerias.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La foto ha sido editada exitosamente.']);
        } else {
            return redirect()->route('galerias.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
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
        $gallery=Gallery::where('slug', $slug)->firstOrFail();
        $gallery->delete();

        if ($gallery) {
            return redirect()->route('galerias.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La foto ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('galerias.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, $slug) {

        $gallery=Gallery::where('slug', $slug)->firstOrFail();
        $gallery->fill(['state' => 0])->save();

        if ($gallery) {
            return redirect()->route('galerias.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La foto ha sido desactivada exitosamente.']);
        } else {
            return redirect()->route('galerias.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, $slug) {

        $gallery=Gallery::where('slug', $slug)->firstOrFail();
        $gallery->fill(['state' => "1"])->save();

        if ($gallery) {
            return redirect()->route('galerias.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La foto ha sido desactivada exitosamente.']);
        } else {
            return redirect()->route('galerias.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
