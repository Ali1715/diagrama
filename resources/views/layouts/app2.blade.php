<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'L') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://demo.dashboardpack.com/architectui-html-free/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://gojs.net/latest/assets/css/style.css">

    <!-- Scripts -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script type="text/javascript" src="shape.js"></script>


        

</head>

<body>

    <!--navbar-->
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">


        <!--  Navbar -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">



            <!-- Authentication Links -->
            @guest
            @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <div id="app">
                
                    <div class="app-header">
                        <div class="app-header__logo">
                            <div class="logo-src"></div>
                        </div>
                    

                        <ul class="navbar-nav me-auto">

                            <div class="app-header__content">
                                <div class="app-header-left">
                                    <ul class="header-menu nav">


                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Menu
                                            </a>

                                        
                                            
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{route('profile.index')}}">Perfil</a></li>
                                                <li><a class="dropdown-item" href="{{route('proyectos.index')}}">Diagramas</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item" href="{{ route('notificaciones.index') }}">Notificaciones</a></li>
                                            </ul>
                                        </li>

                                     
                                    </ul>
                                </div>
                            </div>

                        </ul>

                        <div class="app-header__content app-header-right"></div>
                        <div class="app-header__content app-header-right"></div>
                        <div class="app-header__content app-header-right"></div>
                        <div class="app-header__content app-header-right"></div>
                        <div class="app-header__content app-header-right"></div>
                        <div class="app-header__content app-header-right"></div>
                        <div class="app-header__content app-header-right"></div>
                        <div class="app-header__content app-header-right"></div>
                        <div class="app-header__content app-header-right"></div>
                        <div class="app-header__content app-header-right"></div>
                        <div class="app-header__content app-header-right"></div>
                        <div class="app-header__content app-header-right"></div>
                        
                    
                        <!-- Right Side Of Navbar -->
                        <div class="app-header-right">
                            <div class="header-btn-lg pr-0">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="btn-group">
                                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                    class="p-0 btn">
                                                    <img width="42" class="rounded-circle"
                                                        src="https://robohash.org/63b675b5134d0493e44166a7bdeb3fb5?set=set4&bgset=&size=400x400"
                                                        alt>

                                                </a>
                                                <div tabindex="-1" role="menu" aria-hidden="true"
                                                    class="dropdown-menu dropdown-menu-right">
                                                    <button type="button" tabindex="0" class="dropdown-item">User
                                                        Account</button>
                                                    <button type="button" tabindex="0"
                                                        class="dropdown-item">Settings</button>
                                                    <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                                    <button type="button" tabindex="0"
                                                        class="dropdown-item">Actions</button>
                                                    <div tabindex="-1" class="dropdown-divider"></div>
                                                    <button type="button" tabindex="0"
                                                        class="dropdown-item">Dividers</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Right Side Of Navbar -->
                                        <div class="d-none d-md-flex">
                                        <div class="nav-item dropdown d-none d-md-flex me-3">
                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                        aria-label="Show notifications" title="Notificaciones">
                        <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                        </svg>
                        @if (count(Auth::user()->invitaciones()->where('leido', 0)->get()) > 0)
                            <span class="badge badge-pill bg-red"
                                style="font-size: 8px">{{ count(Auth::user()->invitaciones()->where('leido', 0)->get()) }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card"
                        style="width: 400px">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Notificacion de Solicitudes</h3>
                            </div>
                            <div class="list-group list-group-flush list-group-hoverable">
                                @if (count(Auth::user()->invitaciones()->where('leido', 0)->get()) > 0)
                                    @foreach (Auth::user()->invitaciones()->where('leido', 0)->where('user_id', Auth::user()->id)->take(5)->get() as $notificacion)
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col text-truncate">
                                                    <a href="#" class="text-body">Proyecto:
                                                        {{ $notificacion->proyecto->nombre }}</a>
                                                    <div class="text-muted text-truncate mt-n1">
                                                        {{ $notificacion->contenido }}
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <form
                                                                action="{{ route('notificaciones.leer', $notificacion->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('put')
                                                                <button type="submit" class="btn btn-info border-0"
                                                                    title="Marcar visto">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="icon icon-tabler icon-tabler-eye m-0"
                                                                        width="44" height="44"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="#ffffff" fill="none"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <circle cx="12" cy="12"
                                                                            r="2" />
                                                                        <path
                                                                            d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="list-group-item text-center">
                                        <div class="row align-items-center">
                                            <div class="col text-truncate">
                                                <span class="text-body">No tienes ninguna notificacion sin leer
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="list-group-item text-center">
                                    <div class="row align-items-center">
                                        <div class="col text-truncate">
                                            <a href="{{ route('notificaciones.index') }}" class="text-body">Ver todas
                                                las notificaciones
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                                        <li class="navbar-nav ms-auto">
                                            <div class="nav-item dropdown">
                                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" v-pre>
                                                    {{ Auth::user()->name }}
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                        {{ __('Logout') }}
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                        class="d-none">
                                                        @csrf
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                        @endguest
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </ul>
    </nav>


    <main class="py-5">
        @yield('content')
    </main>

    </div>
    <script>
            joint.setTheme('modern');
            app = new App.MainView({
                el: '#app'
            });
            themePicker = new App.ThemePicker({
                mainView: app
            });
            themePicker.render().$el.appendTo(document.body);
            window.addEventListener('load', function() {
                /* console.log(contenido.length) */
                if (contenido.length > 3) {
                    app.graph.fromJSON(JSON.parse(contenido));
                }
            });

            Echo.join(`diagramar.${diagrama_id}`).listen('DiagramaSent', (e) => {
                    app.graph.fromJSON(JSON.parse(e.diagrama.contenido));
                })
                .here(users => {
                    for (let index = 0; index < users.length; index++) {
                        if (users[index].id != auth_id) {
                            let id = `user_${users[index].id}`;
                            let claseU = document.getElementById(`${id}`);
                            claseU.className = 'badge bg-green';
                        }
                    }
                })
                .joining(user => {

                    let id = `user_${user.id}`;
                    let claseU = document.getElementById(id);
                    claseU.className = 'badge bg-green';

                })
                .leaving(user => {
                    let id = `user_${user.id}`;
                    let claseU = document.getElementById(id);
                    claseU.className = 'badge bg-red';
                });
        </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="https://demo.dashboardpack.com/architectui-html-free/assets/scripts/main.js">
    </script>



</body>

</html>