<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Score;
use Illuminate\Http\Request;
use App\Http\Requests\SettingUpdateRequest;

class SettingController extends Controller
{
    public function results()
    {
        $num=1;
        $scores=Score::all();
        return view('admin.settings.index', compact('num', 'scores'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $setting=Setting::where('id', '1')->firstOrFail();
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingUpdateRequest $request)
    {
        $setting=Setting::where('id', '1')->firstOrFail();

        if (!empty(request('listen'))) {
            $pre_url=request('pre_url');
        } else {
            $pre_url=NULL;
        }
        $data=array('facebook' => request('facebook'), 'instagram' => request('instagram'), 'twitter' => request('twitter'), 'email_one' => request('email_one'), 'email_two' => request('email_two'), 'pre_url' => $pre_url, 'listen' => request('listen'));

        // Mover imagen a carpeta settings y extraer nombre
        if ($request->hasFile('brands')) {
            $file = $request->file('brands');
            $image = "marcas.".$file->getClientOriginalExtension();
            if (file_exists(public_path().'/admins/img/settings/'.$image)) {
                unlink(public_path().'/admins/img/settings/'.$image);
            }
            $file->move(public_path().'/admins/img/settings/', $image);
            $data['brands'] = $image;
        }

        $setting->fill($data)->save();

        if ($setting) {
            return redirect()->route('ajustes.edit')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'Los ajustes han sido editados exitosamente.']);
        } else {
            return redirect()->route('ajustes.edit')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
