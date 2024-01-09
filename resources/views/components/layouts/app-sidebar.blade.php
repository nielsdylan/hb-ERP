<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="index.html">
                <img src="{{ asset('images/logo/hb_group.png') }}" class="header-brand-img desktop-logo" alt="logo" style=" width: 60px;background-color: #ffff;border-radius: 30px; ">
                <img src="{{ asset('images/logo/hb_group.png') }}" class="header-brand-img toggle-logo" style="background-color: #ffff;border-radius: 30px;" alt="logo">
                <img src="{{ asset('images/logo/hb_group.png') }}" class="header-brand-img light-logo" alt="logo">
                <img src="{{ asset('images/logo/hb_group.png') }}" class="header-brand-img light-logo1"
                    alt="logo" style=" width: 60px;background-color: #ffff;border-radius: 30px; ">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            {{-- <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg') }}"
                    fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div> --}}
            <ul class="side-menu">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('hb.dashboard') }}"><i
                            class="side-menu__icon fe fe-home"></i><span
                            class="side-menu__label">Dashboard</span></a>
                </li>
                <li class="sub-category">
                    <h3>UI Kit</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon fe fe-slack"></i><span
                            class="side-menu__label">Academico</span><i
                            class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="panel sidetab-menu">
                            <div class="panel-body tabs-menu-body p-0 border-0">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="side1">
                                        <ul class="sidemenu-list">
                                            <li class="side-menu-label1"><a href="javascript:void(0)">Apps</a></li>
                                            <li><a href="{{ route('hb.academicos.alumnos.lista') }}" class="slide-item"> Alumnos</a></li>
                                            <li><a href="{{ route('hb.academicos.docentes.lista') }}" class="slide-item"> Docentes</a></li>
                                            <li><a href="{{ route('hb.academicos.asignaturas.lista') }}" class="slide-item"> Asignaturas</a></li>
                                            <li><a href="{{ route('hb.academicos.cursos.lista') }}" class="slide-item"> Cursos</a></li>
                                            <li><a href="{{ route('hb.academicos.aulas.lista') }}" class="slide-item"> Aulas</a></li>
                                            <li><a href="{{ route('hb.academicos.cuestionario.lista') }}" class="slide-item"> Cuestionario</a></li>
                                            <li><a href="{{ route('hb.academicos.certificados.lista') }}" class="slide-item"> Certificados </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('hb.empresas.lista') }}"><i
                            class="side-menu__icon fa fa-building-o"></i><span
                            class="side-menu__label">Empresas</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
