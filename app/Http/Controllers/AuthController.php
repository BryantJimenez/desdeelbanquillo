<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\LoginCustomRequest;
use App\Http\Requests\RegisterCustomRequest;
use Illuminate\Support\Facades\Hash;
use App\Notifications\ResetPasswordCustomNotification;

class AuthController extends Controller
{
	public function login(LoginCustomRequest $request) {
		$user=User::where('email', request('email'))->first();
		if (!is_null($user)) {
			if($user->type==1 || $user->type==2 || $user->state==0) {
			 	return redirect()->back()->with(['error.login' => 'Este usuario no tiene permitido ingresar.'])->withInput();
			} elseif(Hash::check(request('password'), $user->password)) {
				$request->session()->push('user', $user);
				return redirect()->back();
			}
		}
		
		return redirect()->back()->with(['error.login' => 'Las credenciales no coinciden.'])->withInput();
	}

	public function register(RegisterCustomRequest $request) {
		$count=User::where('name', request('name'))->where('lastname', request('lastname'))->count();
		$slug=Str::slug(request('name')." ".request('lastname'), '-');
		if ($count>0) {
			$slug=$slug."-".$count;
		}

        // Validación para que no se repita el slug
		$num=0;
		while (true) {
			$count2=User::where('slug', $slug)->count();
			if ($count2>0) {
				$slug=Str::slug(request('name')." ".request('lastname'), '-')."-".$num;
				$num++;
			} else {
				$data=array('name' => request('name'), 'lastname' => request('lastname'), 'slug' => $slug, 'email' => request('email'), 'password' => Hash::make(request('password')));
				break;
			}
		}

		$user=User::create($data);

		if ($user) {
			$user_new=User::where('email', request('email'))->first();
			$request->session()->push('user', $user_new);
			return redirect()->back();
		} else {
			return redirect()->back()->with(['error.register' => 'Ha ocurrido un problema, intentelo nuevamente.'])->withInputs();
		}
	}

	public function recovery(Request $request) {
		$user=User::where('email', request('recovery'))->first();
		if (!is_null($user)) {
			
			$user->notify(new ResetPasswordCustomNotification());
			return redirect()->back()->with(['success.recovery' => 'El correo ha sido enviado exitosamente']);
		}
		
		return redirect()->back()->with(['error.recovery' => 'Este usuario no existe.'])->withInput();
	}

	public function resetForm(Request $request, $slug) {
		return view('web.auth.reset', compact('slug'));
	}

	public function reset(Request $request) {
		$user=User::where('slug', request('slug'))->first();
		if (!is_null($user)) {

			$user->fill(['password' => Hash::make(request('password'))])->save();
			if ($user) {
				return redirect()->back()->with(['success.reset' => 'La contraseña ha sido actualizada exitosamente.']);
			} else {
				return redirect()->back()->with(['error.reset' => 'Ha ocurrido un problema durante el proceso, intentelo nuevamente.'])->withInput();
			}
		}
		
		return redirect()->back()->with(['error.reset' => 'Este usuario no existe.'])->withInput();
	}

	public function logout(Request $request) {
		if ($request->session()->has('user')) {
			$request->session()->forget('user');
		}

		return redirect()->back();
	}
}
