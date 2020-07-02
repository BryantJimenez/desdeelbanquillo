<?php

namespace App\Http\Controllers;

use App\News;
use App\Category;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Auth;

class NewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $news=News::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.news.index', compact('news', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('admin.news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count=News::where('title', request('title'))->count();
        $slug=Str::slug(request('title'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=News::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('title'), '-')."-".$num;
                $num++;
            } else {

                $category=Category::where('slug', request('category_id'))->firstOrFail();
                $data=array('title' => request('title'), 'slug' => $slug, 'summary' => request('summary'), 'content' => request('content'), 'url' => request('url'), 'featured' => request('featured'), 'comments' => request('comments'), 'state' => request('state'), 'category_id' => $category->id, 'user_id' => Auth::user()->id);
                break;
            }
        }

        // Mover imagen a carpeta news y extraer nombre
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = $slug.".".$file->getClientOriginalExtension();
            $file->move(public_path().'/admins/img/news/', $image);
            $data['image'] = $image;
        }

        $new=News::create($data);

        if ($new) {
            return redirect()->route('noticias.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La noticia ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('noticias.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $new=News::where('slug', $slug)->firstOrFail();
        $categories=Category::all();
        return view('admin.news.edit', compact('new', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }
}
