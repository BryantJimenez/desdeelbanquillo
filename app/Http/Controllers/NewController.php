<?php

namespace App\Http\Controllers;

use App\News;
use App\Category;
use App\CategoryNews;
use App\Tag;
use App\NewsTag;
use Illuminate\Http\Request;
use App\Http\Requests\NewsStoreRequest;
use App\Http\Requests\NewsUpdateRequest;
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
    public function store(NewsStoreRequest $request)
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
                $data=array('title' => request('title'), 'slug' => $slug, 'summary' => request('summary'), 'content' => request('content'), 'video' => request('video'), 'featured' => request('featured'), 'comment' => request('comments'), 'state' => request('state'));
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

        $categories=request('category_id');
        foreach ($categories as $slugCategory) {
            $category=Category::where('slug', $slugCategory)->firstOrFail();
            CategoryNews::create(['news_id' => $new->id, 'category_id' => $category->id]);
        }

        $tags=explode(",", request('tags'));
        foreach ($tags as $tag) {
            $count=Tag::where('slug', Str::slug($tag, '-'))->count();
            if ($count==0) {
                $count=Tag::where('name', $tag)->count();
                $slug=Str::slug($tag, '-');
                if ($count>0) {
                    $slug=$slug."-".$count;
                }

                // Validación para que no se repita el slug
                $num=0;
                while (true) {
                    $count2=Tag::where('slug', $slug)->count();
                    if ($count2>0) {
                        $slug=Str::slug($tag, '-')."-".$num;
                        $num++;
                    } else {
                        $data=array('name' => $tag, 'slug' => $slug);
                        break;
                    }
                }

                $tag_new=Tag::create($data);
                NewsTag::create(['tag_id' => $tag_new->id, 'news_id' => $new->id]);
            } else {
                $tag_new=Tag::where('slug', Str::slug($tag, '-'))->first();
                NewsTag::create(['tag_id' => $tag_new->id, 'news_id' => $new->id]);
            }

        }

        if ($new) {
            if ((request('featured')==1 || request('featured')==2 || request('featured')==3) && request('state')==1) {
                $count_news=News::where('featured', request('featured'))->where('state', "1")->count();
                if (($count_news>5 && request('featured')==1) || ($count_news>4 && request('featured')==2) || ($count_news>2 && request('featured')==3)) {
                    $num=1;
                    $news=News::where('featured', request('featured'))->where('state', "1")->orderBy('id', 'DESC')->get();
                    foreach ($news as $n) {
                        if (request('featured')==1) {
                            if ($num>5) {
                                $extra=News::where('id', $n->id)->first();
                                $extra->fill(['featured' => NULL])->save();
                            }
                        } elseif (request('featured')==2) {
                            if ($num>4) {
                                $extra=News::where('id', $n->id)->first();
                                $extra->fill(['featured' => NULL])->save();
                            }
                        }  else {
                            if ($num>2) {
                                $extra=News::where('id', $n->id)->first();
                                $extra->fill(['featured' => NULL])->save();
                            }
                        }
                        $num++;
                    }
                }
            }
            return redirect()->route('noticias.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La noticia ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('noticias.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
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
    public function update(NewsUpdateRequest $request, $slug)
    {
        $new=News::where('slug', $slug)->firstOrFail();
        $data=array('title' => request('title'), 'summary' => request('summary'), 'content' => request('content'), 'video' => request('video'), 'featured' => request('featured'), 'comment' => request('comments'), 'state' => request('state'));

        // Mover imagen a carpeta news y extraer nombre
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = $slug.".".$file->getClientOriginalExtension();
            if (file_exists(public_path().'/admins/img/news/'.$image)) {
                unlink(public_path().'/admins/img/news/'.$image);
            }
            $file->move(public_path().'/admins/img/news/', $image);
            $data['image'] = $image;
        }

        $new->fill($data)->save();

        foreach ($new->categories as $category) {
            $category_news=CategoryNews::where('news_id', $new->id)->where('category_id', $category->id)->firstOrFail();
            $category_news->delete();
        }

        foreach ($new->tags as $tag) {
            $news_tag=NewsTag::where('news_id', $new->id)->where('tag_id', $tag->id)->firstOrFail();
            $news_tag->delete();
        }

        $categories=request('category_id');
        foreach ($categories as $slugCategory) {
            $category=Category::where('slug', $slugCategory)->firstOrFail();
            CategoryNews::create(['news_id' => $new->id, 'category_id' => $category->id]);
        }

        $tags=explode(",", request('tags'));
        foreach ($tags as $tag) {
            $count=Tag::where('slug', Str::slug($tag, '-'))->count();
            if ($count==0) {
                $count=Tag::where('name', $tag)->count();
                $slug=Str::slug($tag, '-');
                if ($count>0) {
                    $slug=$slug."-".$count;
                }

                // Validación para que no se repita el slug
                $num=0;
                while (true) {
                    $count2=Tag::where('slug', $slug)->count();
                    if ($count2>0) {
                        $slug=Str::slug($tag, '-')."-".$num;
                        $num++;
                    } else {
                        $data=array('name' => $tag, 'slug' => $slug);
                        break;
                    }
                }

                $tag_new=Tag::create($data);
                NewsTag::create(['tag_id' => $tag_new->id, 'news_id' => $new->id]);
            } else {
                $tag_new=Tag::where('slug', Str::slug($tag, '-'))->first();
                NewsTag::create(['tag_id' => $tag_new->id, 'news_id' => $new->id]);
            }

        }

        if ($new) {
            if ((request('featured')==1 || request('featured')==2 || request('featured')==3) && request('state')==1) {
                $count_news=News::where('featured', request('featured'))->where('state', "1")->count();
                if (($count_news>5 && request('featured')==1) || ($count_news>4 && request('featured')==2) || ($count_news>2 && request('featured')==3)) {
                    $num=1;
                    $news=News::where('featured', request('featured'))->where('state', "1")->where('id', "!=", $new->id)->orderBy('id', 'DESC')->get();
                    foreach ($news as $n) {
                        if (request('featured')==1) {
                            if ($num>4) {
                                $extra=News::where('id', $n->id)->first();
                                $extra->fill(['featured' => NULL])->save();
                            }
                        } elseif (request('featured')==2) {
                            if ($num>3) {
                                $extra=News::where('id', $n->id)->first();
                                $extra->fill(['featured' => NULL])->save();
                            }
                        }  else {
                            if ($num>1) {
                                $extra=News::where('id', $n->id)->first();
                                $extra->fill(['featured' => NULL])->save();
                            }
                        }
                        $num++;
                    }
                }
            }
            return redirect()->route('noticias.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La noticia ha sido editada exitosamente.']);
        } else {
            return redirect()->route('noticias.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $new=News::where('slug', $slug)->firstOrFail();
        $new->delete();

        if ($new) {
            return redirect()->route('noticias.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La noticia ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('noticias.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, $slug) {

        $new=News::where('slug', $slug)->firstOrFail();
        $new->fill(['state' => "2"])->save();

        if ($new) {
            return redirect()->route('noticias.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La noticia ha sido desactivada exitosamente.']);
        } else {
            return redirect()->route('noticias.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, $slug) {

        $new=News::where('slug', $slug)->firstOrFail();
        $new->fill(['state' => "1"])->save();

        if ($new) {
            return redirect()->route('noticias.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La noticia ha sido publicada exitosamente.']);
        } else {
            return redirect()->route('noticias.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
