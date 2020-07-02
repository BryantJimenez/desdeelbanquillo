<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="profile-info">
            <figure class="user-cover-image"></figure>
            <div class="user-info">
                <img src="{{ asset('/admins/img/pelotaredonda.png') }}" width="90" height="90" alt="logo">
                <h6 class="">Portal Deportivo</h6>
                <p class="">Sistema de Gestión</p>
            </div>
        </div>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu {{ active('admin') }}">
                <a href="{{ route('admin') }}" aria-expanded="{{ menu_expanded('admin') }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span> Inicio</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/administradores', 0) }}">
                <a href="{{ route('administradores.index') }}" aria-expanded="{{ menu_expanded('admin/administradores', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-user-tie"></i> Administradores</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/usuarios', 0) }}">
                <a href="{{ route('usuarios.index') }}" aria-expanded="{{ menu_expanded('admin/usuarios', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-user"></i> Usuarios</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/categorias', 0) }}">
                <a href="{{ route('categorias.index') }}" aria-expanded="{{ menu_expanded('admin/categorias', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fab fa-dropbox"></i> Categorías de Noticias</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/noticias', 0) }}">
                <a href="{{ route('noticias.index') }}" aria-expanded="{{ menu_expanded('admin/noticias', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-newspaper"></i> Noticias</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/comentarios', 0) }}">
                <a href="javascript:void(0);" aria-expanded="{{ menu_expanded('admin/comentarios', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="far fa-comments"></i> Comentarios</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/entrevistas', 0) }}">
                <a href="javascript:void(0);" aria-expanded="{{ menu_expanded('admin/entrevistas', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-microphone-alt"></i> Entrevistas</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/videos', 0) }}">
                <a href="javascript:void(0);" aria-expanded="{{ menu_expanded('admin/videos', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fab fa-youtube"></i> Videos</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/galerias', 0) }}">
                <a href="#gallery" data-toggle="collapse" aria-expanded="{{ menu_expanded('admin/galerias', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-images"></i> Galería de Fotos</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ submenu('admin/galerias', 0) }} }}" id="gallery" data-parent="#accordionExample">
                    <li {{ submenu('admin/banners') }}>
                        <a href="javascript:void(0);"> Categorías</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"> Fotos</a>
                    </li>                           
                </ul>
            </li>

            <li class="menu {{ active('admin/paginas', 0) }}">
                <a href="#page" data-toggle="collapse" aria-expanded="{{ menu_expanded('admin/paginas', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-bullhorn"></i> Páginas</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ submenu('admin/paginas', 0) }} }}" id="page" data-parent="#accordionExample">
                    <li {{ submenu('admin/banners') }}>
                        <a href="javascript:void(0);"> Premios Deb</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"> E-Sport</a>
                    </li>                           
                </ul>
            </li>

            <li class="menu {{ active('admin/banners', 0) }}">
                <a href="#advertising" data-toggle="collapse" aria-expanded="{{ menu_expanded('admin/banners', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-bullhorn"></i> Publicidad</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ submenu('admin/banners', 0) }} }}" id="advertising" data-parent="#accordionExample">
                    <li {{ submenu('admin/banners') }}>
                        <a href="{{ route('banners.index') }}"> Banners Principales</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"> Banners Noticias</a>
                    </li>                           
                </ul>
            </li>

            <li class="menu {{ active('admin/visitas', 0) }}">
                <a href="javascript:void(0);" aria-expanded="{{ menu_expanded('admin/visitas', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-chart-line"></i> Visitas</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/torneos', 0) }}">
                <a href="javascript:void(0);" aria-expanded="{{ menu_expanded('admin/torneos', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-trophy"></i> Torneos</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/ajustes', 0) }}">
                <a href="#cog" data-toggle="collapse" aria-expanded="{{ menu_expanded('admin/ajustes', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-cogs"></i> Ajustes</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ submenu('admin/ajustes', 0) }} }}" id="cog" data-parent="#accordionExample">
                    <li {{ submenu('admin/ajustes') }}>
                        <a href="javascript:void(0);"> Publicidad Botonera</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"> Redes Sociales</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"> Contacto</a>
                    </li>
                </ul>
            </li>
        </ul>

    </nav>

</div>