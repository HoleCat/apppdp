<nav class="nav-index navbar navbar-expand-md navbar-dark bg-dark shadow-sm fixed-top py-0">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img style="max-width: 50px" src="{{ asset('assets/logo/logo_contador.png') }}" alt="">
            APPCONTADOR
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">INGRESAR</a>
                    </li>
                @else
                
                    @if (Route::has('register'))
                        @isadmin('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">REGISTRAR</a>
                        </li>
                        @endisadmin
                    @endif

                    @isadmin('reporte')    
                    <li class="nav-item">
                        <a class="nav-link" id="nav-reporte">REPORTE</a>
                    </li>
                    @endisadmin

                    @isadmin('validador')
                    <li class="nav-item">
                        <a class="nav-link" id="nav-validador">VALIDADOR</a>
                    </li>
                    @endisadmin

                    @isadmin('muestreo')
                    <li class="nav-item">
                        <a class="nav-link" id="nav-muestreo">MUESTREO</a>
                    </li>
                    @endisadmin

                    @isadmin('caja')
                    <li class="nav-item">
                        <a class="nav-link" id="nav-caja">CAJA</a>
                    </li>
                    @endisadmin

                    @isadmin('activos')
                    <li class="nav-item">
                        <a class="nav-link" id="nav-activos">ACTIVOS</a>
                    </li>
                    @endisadmin

                    @isadmin('balance')
                    <li class="nav-item">
                        <a class="nav-link" id="nav-balance">BALANCE</a>
                    </li>
                    @endisadmin

                    @isadmin('xml')
                    <li class="nav-item">
                        <a class="nav-link" id="nav-xml">XML</a>
                    </li>
                    @endisadmin

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>
                                CERRAR SESION
                            </a>
                            <a class="dropdown-item" id="datauser-btn" onclick="getview('#content','/Userdata',confirmacion)">
                                <i class="fas fa-address-card"></i> USUARIO
                            </a>
                            @isadmin('admin')
                            <a class="dropdown-item" id="admin-btn" onclick="getview('#content','/Admin',confirmacion)">
                                <i class="fas fa-user-tie"></i> ADMIN
                            </a>
                            @endisadmin
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            
                            <a class="dropdown-item" href="{{ asset('assets/files/templatemayorcompra.xlsx') }}"
                               ><i class="fas fa-shopping-bag"></i>
                               PLANTILLA COMPRAS
                            </a>

                            <a class="dropdown-item" href="{{ asset('assets/files/templatemayorventa.xlsx') }}"
                               ><i class="fas fa-concierge-bell"></i>
                               PLANTILLA VENTAS
                            </a>

                            <a class="dropdown-item" href="{{ asset('assets/files/templatemayorgasto.xlsx') }}"
                               ><i class="fas fa-comment-dollar"></i>
                               PLANTILLA GASTOS
                            </a>

                            <a class="dropdown-item" href="{{ asset('assets/files/templateactivos.xlsx') }}"
                               ><i class="fas fa-funnel-dollar"></i>
                               PLANTILLA ACTIVOS FIJOS
                            </a>
                            <a class="dropdown-item" href="homologacion/index"
                               ><i class="fas fa-balance-scale"></i>
                               HOMOLOGACIONES
                            </a>
                            @isadmin('caja')
                            <a class="dropdown-item" href="aprobador/index"
                               ><i class="fas fa-check"></i>
                               APROBADORES
                            </a>
                            @endisadmin
                            @isadmin('admin')
                            <a class="dropdown-item" href="noticia/index"
                               ><i class="fas fa-blog"></i>
                               NOTICIAS
                            </a>
                            @endisadmin
                            @isadmin('caja')
                            <a class="dropdown-item" href="centrocosto/index"
                               ><i class="fas fa-address-card"></i>
                               CENTRO DE COSTOS
                            </a>
                            @endisadmin
                            @isadmin('caja')
                            <a class="dropdown-item" href="contabilidad/index"
                               ><i class="fas fa-address-book"></i>
                               CODIGOS CONTABLES
                            </a>
                            @endisadmin
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
