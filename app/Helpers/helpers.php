<?php

function state($state) {
	if ($state==0) {
		return '<span class="badge badge-danger">Inactivo</span>';
	} elseif ($state==1) {
		return '<span class="badge badge-success">Activo</span>';
	} else {
		return '<span class="badge badge-dark">Desconocido</span>';
	}
}

function stateNew($state) {
	if ($state==1) {
		return '<span class="badge badge-primary">Publicado</span>';
	} elseif ($state==2) {
		return '<span class="badge badge-info">Borrador</span>';
	} else {
		return '<span class="badge badge-dark">Desconocido</span>';
	}
}

function typeUser($type, $badge=1) {
	if ($badge==1) {
		if ($type==1) {
			return '<span class="badge badge-primary">Super Admin</span>';
		} elseif ($type==2) {
			return '<span class="badge badge-primary">Administrador</span>';
		} elseif ($type==3) {
			return '<span class="badge badge-primary">Usuario</span>';
		} else {
			return '<span class="badge badge-dark">Desconocido</span>';
		}
	} elseif ($badge==0) {
		if ($type==1) {
			return 'Super Admin';
		} elseif ($type==2) {
			return 'Administrador';
		} elseif ($type==3) {
			return 'Usuario';
		} else {
			return 'Desconocido';
		}
	}
}

function featuredBanner($featured) {
	if ($featured==1) {
		return '<span class="badge badge-primary">Principal Superior</span>';
	} elseif ($featured==2) {
		return '<span class="badge badge-primary">Principal Alargado</span>';
	} elseif ($featured==3) {
		return '<span class="badge badge-primary">Principal Medio</span>';
	} elseif ($featured==4) {
		return '<span class="badge badge-primary">Principal Inferior</span>';
	} elseif ($featured==5) {
		return '<span class="badge badge-primary">Noticia Superior</span>';
	} elseif ($featured==6) {
		return '<span class="badge badge-primary">Noticia Alargado</span>';
	} elseif ($featured==7) {
		return '<span class="badge badge-primary">Noticia Inferior</span>';
	} else {
		return '<span class="badge badge-dark">Desconocido</span>';
	}
}

function active($path, $group=null) {
	if (is_array($path)) {
		foreach ($path as $url) {
			if (is_null($group)) {
				if (request()->is($path)) {
					return 'active';
				}
			} else {
				if (is_int(strpos(request()->path(), $path))) {
					return 'active';
				}
			}
		}
		return '';
	} else {
		if (is_null($group)) {
			return request()->is($path) ? 'active' : '';
		} else {
			return is_int(strpos(request()->path(), $path)) ? 'active' : '';
		}
	}
}

function menu_expanded($path, $group=null) {
	if (is_array($path)) {
		foreach ($path as $url) {
			if (is_null($group)) {
				if (request()->is($path)) {
					return 'true';
				}
			} else {
				if (is_int(strpos(request()->path(), $path))) {
					return 'true';
				}
			}
		}
		return 'false';
	} else {
		if (is_null($group)) {
			return request()->is($path) ? 'true' : 'false';
		} else {
			return is_int(strpos(request()->path(), $path)) ? 'true' : 'false';
		}
	}
}

function submenu($path, $action=null) {
	if (is_array($path)) {
		foreach ($path as $url) {
			if (is_null($action)) {
				if (request()->is($path)) {
					return 'class=active';
				}
			} else {
				if (is_int(strpos(request()->path(), $path))) {
					return 'show';
				}
			}
		}
		return '';
	} else {
		if (is_null($action)) {
			return request()->is($path) ? 'class=active' : '';
		} else {
			return is_int(strpos(request()->path(), $path)) ? 'show' : '';
		}
	}
}

function selectArray($arrays, $selectedItems) {
	$selects="";
	foreach ($arrays as $array) {
		$select="";
		if (count($selectedItems)>0) {
			foreach ($selectedItems as $selected) {
				if (is_object($selected) && $selected->slug==$array->slug) {
					$select="selected";
					break;
				} elseif ($selected==$array->slug) {
					$select="selected";
					break;
				}
			}
		}
		$selects.='<option value="'.$array->slug.'" '.$select.'>'.$array->name.'</option>';
	}
	return $selects;
}

function store_files($file, $file_name, $route) {
	$image=$file_name.".".$file->getClientOriginalExtension();
	if (file_exists(public_path().$route.$image)) {
		unlink(public_path().$route.$image);
	}
	$file->move(public_path().$route, $image);
	return $image;
}

function image_exist($file_route, $image, $user_image=false, $large=true) {
	if (file_exists(public_path().$file_route.$image)) {
		$img=asset($file_route.$image);
	} else {
		if ($user_image) {
			$img=asset("/admins/img/template/usuario.png");
		} else {
			if ($large) {
				$img=asset("/admins/img/template/imagen.jpg");
			} else {
				$img=asset("/admins/img/template/image.jpg");
			}
		}
	}

	return $img;
}

function target($target) {
	if ($target==1) {
		return "En la misma Pestaña";
	} elseif ($target==2) {
		return "Nueva Pestaña";
	} else {
		return "Ninguno";
	}
}

function featured($featured) {
	if ($featured==1) {
		return '<span class="badge badge-primary">Si</span>';
	} elseif ($featured==0) {
		return '<span class="badge badge-danger">No</span>';
	} else {
		return '<span class="badge badge-dark">Desconocido</span>';
	}
}

function youtubeUrl($url) {
	$url_new=substr($url, 32);
	if (is_numeric(strpos($url_new, '&'))) {
		$end=strpos($url_new, '&');
		$youtube=substr($url_new, 0, $end);
	} else {
		$youtube=substr($url, 32);
	}

	return "https://www.youtube.com/embed/".$youtube;
}