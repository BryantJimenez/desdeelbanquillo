<?php

namespace App\Http\Controllers;

use App\User;
use App\News;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentStoreRequest;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments=Comment::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.comments.index', compact('comments', 'num'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentStoreRequest $request)
    {
        // Validación para que no se repita el slug
        $slug='comentario';
        $num=0;
        while (true) {
            $count=Comment::where('slug', $slug)->count();
            if ($count>0) {
                $slug='comentario-'.$num;
                $num++;
            } else {

                $news=News::where('slug', request('news_id'))->firstOrFail();
                $data=array('text' => request('text'), 'slug' => $slug, 'news_id' => $news->id, 'user_id' => session('user')[0]->id, 'state' => "1");
                break;
            }
        }

        $comment=Comment::create($data);

        if ($comment) {
            return response()->json(['status' => true, 'name' => $comment->user->name, 'lastname' => $comment->user->lastname, 'text' => $comment->text, 'date' => $comment->created_at->diffForHumans(), 'type' => 'success', 'title' => 'Comentario Registrado', 'msg' => 'El comentario ha sido registrado exitosamente.']);
        } else {
            return response()->json(['status' => true, 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $comment=Comment::where('slug', $slug)->firstOrFail();
        $comment->delete();

        if ($comment) {
            return redirect()->route('comentarios.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El comentario ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('comentarios.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, $slug) {

        $comment=Comment::where('slug', $slug)->firstOrFail();
        $comment->fill(['state' => 0])->save();

        if ($comment) {
            return redirect()->route('comentarios.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El comentario ha sido desactivado exitosamente.']);
        } else {
            return redirect()->route('comentarios.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, $slug) {

        $comment=Comment::where('slug', $slug)->firstOrFail();
        $comment->fill(['state' => "1"])->save();

        if ($comment) {
            return redirect()->route('comentarios.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El comentario ha sido activado exitosamente.']);
        } else {
            return redirect()->route('comentarios.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function userDeactivate(Request $request, $slug) {

        $user = User::where('slug', $slug)->firstOrFail();
        $user->fill(['state' => 0])->save();

        if ($user) {
            return redirect()->route('comentarios.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El usuario ha sido desactivado exitosamente.']);
        } else {
            return redirect()->route('comentarios.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function userActivate(Request $request, $slug) {

        $user = User::where('slug', $slug)->firstOrFail();
        $user->fill(['state' => "1"])->save();

        if ($user) {
            return redirect()->route('comentarios.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El usuario ha sido activado exitosamente.']);
        } else {
            return redirect()->route('comentarios.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
