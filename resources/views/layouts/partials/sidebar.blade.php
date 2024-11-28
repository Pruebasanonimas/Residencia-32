<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">CRM</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                 {{-- Gestión de alumnos --}} 
                <li class="nav-item">
                    <a href="{{ route('alumnos.gestion') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Gestión de alumnos</p>
                    </a>
                </li>

                 {{-- Cursos --}} 
                <li class="nav-item">
                    <a href="{{ route('cursos.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-book-reader"></i>
                        <p>Ver Cursos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cursos.create') }}" class="nav-link">
                        <i class="nav-icon fas fa-folder-plus"></i>
                        <p>Crear Curso</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/editcursos') }}" class="nav-link">
                        <i class="nav-icon fas fa-pen-square"></i>
                        <p>Editar Curso</p>
                    </a>
                </li>
                @isset($curso)
                    <li class="nav-item">
                        <a href="{{ route('cursos.edit', ['id' => $curso->id]) }}" class="nav-link">
                            <i class="nav-icon fas fa-pencil-alt"></i>
                            <p>Editar Curso</p>
                        </a>
                    </li>
                @endisset

                 {{-- Noticias --}} 
                <li class="nav-item">
                    <a href="{{ route('crearnoticia') }}" class="nav-link">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Crear Noticia</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('editarnoticia') }}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>Editar Noticia</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('vistanoticias') }}" class="nav-link">
                        <i class="nav-icon fas fa-eye"></i>
                        <p>Ver noticia</p>
                    </a>
                </li>

                 {{-- Calendario --}} 
                <li class="nav-item">
                    <a href="{{ url('fullcalender') }}" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>Calendario</p>
                    </a>
                </li>

                {{-- Subir y editar documentos --}} 
                <li class="nav-item">
                    <a href="{{ url('/subir') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-upload"></i>
                        <p>Subir Documentos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/edit') }}" class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>Editar Documentos</p>
                    </a>
                </li>


                 {{-- Enviar correos --}} 
                <li class="nav-item">
                    <a href="{{ url('/enviar-correos') }}" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>Envio de correos</p>
                    </a>
                </li>

                 {{-- Cerrar sesión --}} 
                <li class="nav-item">
                    <a href="#" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Cerrar sesión</p>
                    </a>
                    <hr class="sidebar-divider my-2" style="border-top: 1px solid white;">  {{-- Línea divisoria --}} 
                <li class="nav-item">
                    <a href="{{ url('/crearmenu') }}" class="nav-link">
                        <i class="nav-icon fas fa-list-alt"></i> 
                        <p>Crear menú</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/editarmenu') }}" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i> 
                        <p>Editar menú</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/vistamenu') }}" class="nav-link">
                        <i class="nav-icon fas fa-book-open"></i> 
                        <p>Ver menú</p>
                    </a>
                </li>



                <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </li>

            </ul>
        </nav>
    </div>
</aside>
