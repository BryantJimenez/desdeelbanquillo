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

function typeBanner($type) {
	if ($type==1) {
		return '<span class="badge badge-primary">Principal Superior</span>';
	} elseif ($type==2) {
		return '<span class="badge badge-primary">Principal Alargado</span>';
	} elseif ($type==3) {
		return '<span class="badge badge-primary">Principal Medio</span>';
	} elseif ($type==4) {
		return '<span class="badge badge-primary">Principal Inferior</span>';
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

function target($target) {
	if ($target==1) {
		return "En la misma Pestaña";
	} elseif ($target==2) {
		return "Nueva Pestaña";
	} else {
		return "Ninguno";
	}
}