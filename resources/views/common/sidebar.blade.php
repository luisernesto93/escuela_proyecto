<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            {{-- <i class="fas fa-university"></i> --}}
            <img src="{{ asset('images/icon.png') }}" alt="Logo" width="50px">
        </div>
        <div class="sidebar-brand-text mx-3">ITPIAI</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>INICIO</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        PARAMETROS
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    @php
        //Es para verificar si la ruta fue seleccionada, requiere un array con los nombres de las rutas para verificar sus extensiones
        //.index, .create, .update, .edit, .show. Ejemplo selectedRout(['estudiantes']) verificará así y devolverá true o false
        //estudiantes.index, estudiantes.create, estudiantes.update, estudiantes.edit, estudiantes.show
        //Por defecto usar solo para verificar rutas de ese tipo por cada elemento del array enviado
        //También se puede enviar extensiones personalizadas y esos serán las nuevas extensiones a verificar por cada elemento
        function isRouteSelected($rutas, $extension = null)
        {
            $extension = $extension ?? ['index', 'create', 'update', 'edit', 'show'];
            foreach ($rutas as $ruta) {
                foreach ($extension as $view) {
                    if (Route::is($ruta . '.' . $view)) {
                        return true;
                    }
                }
            }
            return false;
        }
        function addAttribMenu($applyAttributes = false)
        {
            $menu = [
                'nav-link' => $applyAttributes ? '' : 'collapsed',
                'aria-expanded' => $applyAttributes ? 'true' : 'false',
                'nav-item' => $applyAttributes ? 'active' : '',
                'collapse' => $applyAttributes ? 'show' : '',
            ];
            return $menu;
        }
        // $menu_parametros = [];
        // $menu_localizaciones = [];
        // $menu_estudiantes = [];
        // $menu_inscripciones = [];
        // $menu_administradores = [];
        // $menu_reportes = [];

        $routesMoluleParameters = ['gestions', 'plazoinscripcions', 'becas','plan_estudios', 'resoluciones', 'canal_publicitarios', 'modalidadpagos', 'turnos', 'carreras', 'docentes', 'materias'];
        $menu_parametros = addAttribMenu(isRouteSelected($routesMoluleParameters));

        $routesModuleLocalizaciones = ['paises', 'departamentos', 'provincias', 'localidades'];
        $menu_localizaciones = addAttribMenu(isRouteSelected($routesModuleLocalizaciones));

        $routesModuleEstudents = ['estudiantes', 'generos', 'expedicion_cis'];
        $menu_estudiantes = addAttribMenu(isRouteSelected($routesModuleEstudents));

        $routesModuleInscriptions = ['inscripciones', 'estado_verificaciones', 'libros'];
        $menu_inscripciones = addAttribMenu(isRouteSelected($routesModuleInscriptions) || Route::is('notasgestions.index') || isRouteSelected(['detalle_inscripcion_becas'], ['index', 'edit']));

        $menu_administradores = addAttribMenu(isRouteSelected(['users']) || Route::is('users.delete') || isRouteSelected(['empresas'], ['index', 'create']) || isRouteSelected(['roles', 'permissions'], ['index', 'create']));
        $menu_reportes = addAttribMenu(isRouteSelected(['r_inscripcion'], ['index', 'filtrar']));

    @endphp
    <li class="nav-item {{ $menu_parametros['nav-item'] }}">
        <a class="nav-link {{ $menu_parametros['nav-link'] }}" href="#" data-toggle="collapse"
            data-target="#collapseParametros" aria-expanded="{{ $menu_parametros['aria-expanded'] }}"
            aria-controls="collapseParametros">
            <i class="fas fa-fw fa-cog fa-lg"></i>
            <span>PAR&Aacute;METROS</span>
        </a>
        <div id="collapseParametros" class="collapse {{ $menu_parametros['collapse'] }}" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Route::is('gestions.index') ? 'active' : '' }}"
                    href="{{ route('gestions.index') }}">Gestiones</a>
                <a class="collapse-item {{ Route::is('plazoinscripcions.index') ? 'active' : '' }}"
                    href="{{ route('plazoinscripcions.index') }}">Plazo Inscripciones</a>
                <a class="collapse-item {{ Route::is('becas.index') ? 'active' : '' }}"
                    href="{{ route('becas.index') }}">Becas</a>
                <a class="collapse-item {{ Route::is('docentes.index') ? 'active' : '' }}"
                    href="{{ route('docentes.index') }}">Docentes</a>
                <a class="collapse-item {{ Route::is('resoluciones.index') ? 'active' : '' }}"
                    href="{{ route('resoluciones.index') }}">Resoluciones</a>
                <a class="collapse-item {{ Route::is('plan_estudios.index') ? 'active' : '' }}"
                    href="{{ route('plan_estudios.index') }}">Plan de Estudio</a>
                <a class="collapse-item {{ Route::is('carreras.index') ? 'active' : '' }}"
                        href="{{ route('carreras.index') }}">Carreras</a>
                <a class="collapse-item {{ Route::is('materias.index') ? 'active' : '' }}"
                    href="{{ route('materias.index') }}">Materias</a>
                <a class="collapse-item {{ Route::is('turnos.index') ? 'active' : '' }}"
                    href="{{ route('turnos.index') }}">Turnos</a>
                <a class="collapse-item {{ Route::is('canal_publicitarios.index') ? 'active' : '' }}"
                    href="{{ route('canal_publicitarios.index') }}">Canal Publicitario</a>
                <a class="collapse-item {{ Route::is('modalidadpagos.index') ? 'active' : '' }}"
                    href="{{ route('modalidadpagos.index') }}">Modalidad Pagos</a>
            </div>
        </div>
    </li>
    {{-- You --}}
    <hr class="sidebar-divider">
    <li class="nav-item {{ $menu_localizaciones['nav-item'] }}">
        <a class="nav-link collapsed {{ $menu_localizaciones['nav-link'] }}" href="#" data-toggle="collapse"
            data-target="#collapseLocation" aria-expanded="{{ $menu_localizaciones['aria-expanded'] }}"
            aria-controls="collapseLocation">
            <i class="fas fa-globe"></i>
            <span>LOCALIZACIONES</span>
        </a>
        <div id="collapseLocation" class="collapse {{ $menu_localizaciones['collapse'] }}"
            aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Route::is('paises.index') ? 'active' : '' }}"
                    href="{{ route('paises.index') }}">Países</a>
                <a class="collapse-item {{ Route::is('departamentos.index') ? 'active' : '' }}"
                    href="{{ route('departamentos.index') }}">Departamentos</a>
                <a class="collapse-item {{ Route::is('provincias.index') ? 'active' : '' }}"
                    href="{{ route('provincias.index') }}">Provincias</a>
                <a class="collapse-item {{ Route::is('localidades.index') ? 'active' : '' }}"
                    href="{{ route('localidades.index') }}">Localidades</a>
            </div>
        </div>
    </li>
    {{-- Fin  You --}}
    <hr class="sidebar-divider">
    <li class="nav-item {{ $menu_estudiantes['nav-item'] }}">
        <a class="nav-link collapsed {{ $menu_estudiantes['nav-link'] }}" href="#" data-toggle="collapse"
            data-target="#collapseEstudent" aria-expanded="{{ $menu_estudiantes['aria-expanded'] }}"
            aria-controls="collapseEstudent">
            <i class="fas fa-user-graduate"></i>
            <span>ESTUDIANTE</span>
        </a>
        <div id="collapseEstudent" class="collapse {{ $menu_estudiantes['collapse'] }}" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Route::is('generos.index') ? 'active' : '' }}"
                    href="{{ route('generos.index') }}">G&eacute;nero</a>
                <a class="collapse-item {{ Route::is('expedicion_cis.index') ? 'active' : '' }}"
                    href="{{ route('expedicion_cis.index') }}">Expediciones CI</a>
                <a class="collapse-item {{ Route::is('estudiantes.index') ? 'active' : '' }}"
                    href="{{ route('estudiantes.index') }}">Estudiantes</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item {{ $menu_inscripciones['nav-item'] }}">
        <a class="nav-link collapsed {{ $menu_inscripciones['nav-link'] }}" href="#" data-toggle="collapse"
            data-target="#collapseInscription" aria-expanded="{{ $menu_inscripciones['aria-expanded'] }}"
            aria-controls="collapseInscription">
            <i class="fas fa-clipboard-list"></i>
            <span>INSCRIPCIONES</span>
        </a>
        <div id="collapseInscription" class="collapse {{ $menu_inscripciones['collapse'] }}"
            aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <a class="collapse-item {{ Route::is('inscriptors.index') ? 'active' : '' }}"
                    href="{{ route('inscriptors.index') }}">Inscriptor</a> --}}
                <a class="collapse-item {{ Route::is('libros.index') ? 'active' : '' }}"
                        href="{{ route('libros.index') }}">Libros</a><a class="collapse-item {{ Route::is('inscripciones.index') ? 'active' : '' }}"
                    href="{{ route('inscripciones.index') }}">Inscripciones</a>
                <a class="collapse-item {{ Route::is('estado_verificaciones.index') ? 'active' : '' }}"
                    href="{{ route('estado_verificaciones.index') }}">Verificaciones</a>

                <a class="collapse-item {{ Route::is('notasgestions.index') ? 'active' : '' }}"
                    href="{{ route('notasgestions.index') }}">Notas Gestiones</a>
                <a class="collapse-item {{ Route::is('detalle_inscripcion_becas.index') ? 'active' : '' }}"
                    href="{{ route('detalle_inscripcion_becas.index') }}">Detalle Inscripción Beca</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    @hasrole('Admin')
        <!-- Heading -->
        <div class="sidebar-heading">
            Admin Section
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ $menu_administradores['nav-item'] }}">
            <a class="nav-link collapsed {{ $menu_administradores['nav-link'] }}" href="#" data-toggle="collapse"
                data-target="#collapsePages" aria-expanded="{{ $menu_administradores['aria-expanded'] }}"
                aria-controls="collapsePages">
                <i class="fas fa-user-shield"></i>
                <span>ADMINISTRADOR</span>
            </a>
            <div id="collapsePages" class="collapse {{ $menu_administradores['collapse'] }}"
                aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Roles & Permisos</h6>
                    <a class="collapse-item" href="{{ route('roles.index') }}">Roles</a>
                    <a class="collapse-item" href="{{ route('permissions.index') }}">Permisos</a>
                    <a class="collapse-item {{ Route::is('users.index') ? 'active' : '' }}"
                        href="{{ route('users.index') }}">Usuarios</a>
                    <a class="collapse-item {{ Route::is('empresas.index') ? 'active' : '' }}"
                        href="{{ route('empresas.index') }}">Empresa</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    @endhasrole
    @hasrole('Admin')
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ $menu_reportes['nav-item'] }}">
            <a class="nav-link collapsed {{ $menu_reportes['nav-link'] }}" href="#" data-toggle="collapse"
                data-target="#collapseReport" aria-expanded="{{ $menu_reportes['aria-expanded'] }}"
                aria-controls="collapseReport">
                <i class="fas fa-table"></i>
                <span>REPORTES</span>
            </a>
            <div id="collapseReport" class="collapse {{ $menu_reportes['collapse'] }}" aria-labelledby="headingPages"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('r_inscripcion.index') }}">Alumnos Inscriptos</a>
                    <a class="collapse-item" href="{{ route('r_historico_academico.index') }}">Historicos Academicos</a>
                    <a class="collapse-item" href="{{ route('r_centralizador.index') }}">Centralizador Notas</a>
                </div>
            </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    @endhasrole

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt"></i>
            <span>Cerrar Seción</span>
        </a>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
