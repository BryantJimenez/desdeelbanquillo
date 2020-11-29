<?php

namespace App\Http\Controllers;

use App\Stadium;
use Illuminate\Http\Request;
use App\Http\Requests\StadiumStoreRequest;
use App\Http\Requests\StadiumUpdateRequest;
use Illuminate\Support\Str;

class StadiumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $stadiums=Stadium::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.stadiums.index', compact('stadiums', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.stadiums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StadiumStoreRequest $request)
    {
        $count=Stadium::where('name', request('name'))->count();
        $slug=Str::slug(request('name'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Stadium::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('name'), '-')."-".$num;
                $num++;
            } else {
                $data=array('name' => request('name'), 'slug' => $slug);
                break;
            }
        }

        $stadium=Stadium::create($data);

        if ($stadium) {
            return redirect()->route('estadios.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El estadio ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('estadios.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $stadium=Stadium::where('slug', $slug)->firstOrFail();
        return view('admin.stadiums.edit', compact('stadium'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(StadiumUpdateRequest $request, $slug) {

        $stadium=Stadium::where('slug', $slug)->firstOrFail();
        $stadium->fill($request->all())->save();

        if ($stadium) {
            return redirect()->route('estadios.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El estadio ha sido editado exitosamente.']);
        } else {
            return redirect()->route('estadios.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $stadium=Stadium::where('slug', $slug)->firstOrFail();
        $stadium->delete();

        if ($stadium) {
            return redirect()->route('estadios.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El estadio ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('estadios.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
