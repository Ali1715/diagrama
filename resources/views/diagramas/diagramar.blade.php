@section('title', 'Diagramar')
<x-app-layout>
    <div class="page-wrapper">
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Proyecto: {{ $proyecto->nombre }}
                        </h2>
                        <p style="font-size: 10px">Diagrama: {{ $diagrama->nombre }}</p>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-13 col-md-auto ms-auto">
                        <div class="row">
                            <div class="col-auto mx-0 px-2">
                                <div class="datagrid-title">Lista de Usuarios</div>
                                <div class="datagrid-content">
                                    @if (count($diagrama->usuarios) > 1)
                                        <div class="avatar-list">
                                            @foreach ($diagrama->usuarios as $usuario)
                                                @if (auth()->user()->id != $usuario->id)
                                                    @if ($usuario->url)
                                                        <span class="avatar avatar-xs avatar-rounded cursor-help"
                                                            style="background-image: url({{ asset('storage/' . $usuario->url) }}); box-shadow: 0 0 0 2px #597e8d;"
                                                            data-bs-toggle="popover" data-bs-placement="top"
                                                            data-bs-html="true"
                                                            data-bs-content="<p class='mb-0'>{{ $usuario->name }} - Participante</p><p class='mb-0'><a href='#'>{{ $usuario->email }}</a></p>">
                                                            <span id="user_{{ $usuario->id }}"
                                                                class="badge bg-red"></span></span>
                                                    @else
                                                        <span class="avatar avatar-xs avatar-rounded cursor-help"
                                                            data-bs-toggle="popover" data-bs-placement="top"
                                                            data-bs-html="true"
                                                            data-bs-content="<p class='mb-0'>{{ $usuario->name }} - Participante</p>
                                                        <p class='mb-0'><a href='#'>{{ $usuario->email }}</a></p>
                                                        ">{{ Str::substr($usuario->name, 0, 2) }}<span
                                                                id="user_{{ $usuario->id }}"
                                                                class="badge bg-red"></span></span>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <h6>Estas solit@</h6>
                                    @endif
                                </div>
                            </div>

                            <div class="col-auto mx-0 px-1 pt-2">
                                <a href="{{ route('diagramas.index', $diagrama->proyecto_id) }}"
                                    class="btn btn-secondary">
                                    Volver
                                </a>
                            </div>
                            <div class="col-auto mx-0 px-1 pt-2" id='descargar'>
                                <a href="{{ route('diagramas.descargar', $diagrama->proyecto_id) }}"
                                    class="btn btn-secondary">
                                    Script<>
                                </a>
                            </div>
                          
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div id="app">
       
        <div class="app-body">
            <!--<div class="stencil-container"></div>
            <div class="paper-container"></div>
            <div class="inspector-container" style="background-color: rgba(23,67,122,255)"></div>
            <div class="navigator-container"></div>
-->


<div class="app" class="joint-app joint-theme-modern" style="overflow-y:auto">


    <div class="col-12 col-md-auto ms-auto">
        <div class="canvas " style="left:10px; background-color:darkblue">
            <div style="width: 0%;height:200px; display: flex; justify-content: space-between;">
            <div style="width: 110px; height:20px;">
            <!--<select id="linkType">
  <option value="uml.Generalization">Generalization</option>
  <option value="uml.Association">Association</option>
  <option value="uml.Composition">Composition</option>-->
  <!-- Agrega más opciones según tus necesidades -->
<!--</select>-->
<input type="text" id="linkTypeInput" placeholder="Ingrese el tipo de enlace">
<button onclick="changeDefaultLinkType()">Cambiar Tipo de Enlace</button>

</div>
            <div id="diagram"><div class="inspector-container" style="background-color: rgba(23,67,122,255)"></div></div>
            <div id="diagram"><div class="inspector-container2" style="background-color: rgba(23,67,122,255)"></div></div>
                <div id="myPaletteDiv"
                    style="width: 35%; margin-right: 2px; background-color: whitesmoke; border: 1px solid black; position: relative; -webkit-tap-highlight-color: rgba(255, 255, 255, 0); cursor: auto;">



         
              
                    
                        
<div class="stencil-container"></div>

 
                   

        
               
                    <div class="container" style=" border: 1px solid black;cursor: auto">
               
                        </div>
                
                </div>
                
            </div>
         
            <div style="width: 100%;height:460px; display:-webkit-inline-box; justify-content: space-between">
                <div id="myPaletteDiv"
                    style="width: 100%; margin-right: 2px; background-color: whitesmoke; border: 1px solid black; position: relative; -webkit-tap-highlight-color: rgba(255, 255, 255, 0); cursor: auto;">



                    <div class="joint-stencil joint-theme-modern searchable collapsible"
                        data-text-no-matches-found="No matches found">



                        <div class="content" style="top: 5px">

                        <div class="paper-container"></div>
                   

                            <div class="group" data-name="uml">

                                <div class="elements joint-paper joint-theme-modern"
                                    style="width: 240px; height: 10px;">
                                    <div class="joint-paper-background" joint-selector="background"></div>
                                    <div class="joint-paper-grid" joint-selector="grid"></div>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- <div id="diagram"
            style="flex-grow: 1; height: 620px; border: 1px solid black; position: relative; -webkit-tap-highlight-color: rgba(255, 255, 255, 0); cursor: auto;">
            <canvas tabindex="0" width="1190" height="1236"
                style="position: absolute; top: 0px; left: 0px; z-index: 2; user-select: none; touch-action: none; width: 595px; height: 618px; cursor: auto;">

            </canvas>
            <div style="position: absolute; overflow: auto; width: 595px; height: 618px; z-index: 1;">
                <div style="position: absolute; width: 1px; height: 1px;"></div>
            </div>
        </div>-->
<!--<div id="diagram" style="width: max-width; height:400px; margin: 100px; background-color:antiquewhite "></div>

</div>-->
        </div>
    </div>

    
    <textarea id="contenido" hidden cols="30" rows="10">{{ $diagrama->contenido }}</textarea>
    <input name="diagrama_id" type="text" value="{{ $diagrama->id }}" hidden>
    <input name="permiso" type="text" value="{{ $permiso }}" hidden>

    <input name="persona" type="text" value="{{ asset('assets/image-person.svg') }}" hidden>
    <input name="persona2" type="text" value="{{ asset('assets/image-person-2.svg') }}" hidden>
    <input name="cylinder_horizontal" type="text" value="{{ asset('assets/image-cylinder-horizontal.svg') }}"
        hidden>
    <input name="data_container" type="text" value="{{ asset('assets/image-data-container.svg') }}" hidden>
    <input name="hexagon" type="text" value="{{ asset('assets/image-hexagon.svg') }}" hidden>
    <input name="web_browser" type="text" value="{{ asset('assets/image-web-browser.svg') }}" hidden>
    <input name="transparent_icon" type="text" value="{{ asset('assets/transparent-icon.svg') }}" hidden>
    <input name="no_color_icon" type="text" value="{{ asset('assets/no-color-icon.svg') }}" hidden>
    <input name="auth_id" type="text" value="{{ Auth::user()->id }}" hidden>
    @push('scripts')
        <script>
            var diagrama_id = $("input[name=diagrama_id]").val();
            var contenido = document.getElementById("contenido").value;
            var permiso = $("input[name=permiso]").val()
            var person = $("input[name=persona]").val();
            var person2 = $("input[name=persona2]").val();
            var cylinder_horizontal = $("input[name=cylinder_horizontal]").val();
            var data_container = $("input[name=data_container]").val();
            var hexagon = $("input[name=hexagon]").val();
            var web_browser = $("input[name=web_browser]").val();
            var transparent_icon = $("input[name=transparent_icon]").val();
            var no_color_icon = $("input[name=no_color_icon]").val();

            var auth_id = $("input[name=auth_id]").val();
            // console.log(contenido)

            // console.log(window.location.pathname.substr(11));

            function guardar(paper) {
                axios.post("/diagramas/guardar", {
                        id: diagrama_id,
                        contenido: paper
                    })
                    .then((res) => {
                        /* console.log(res.data) */
                    })
                    .catch((error) => {
                        console.log(error);
                        Swal.fire(`Ocurrió un problema, por favor inténtalo más tarde.`)
                    });
            };
        </script>
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/lodash.js') }}"></script>
        <script src="{{ asset('js/backbone.js') }}"></script>
        <script src="{{ asset('js/graphlib.core.js') }}"></script>
        <script src="{{ asset('js/dagre.core.js') }}"></script>
        <script src="{{ asset('js/rappid.js') }}"></script>

        <script src="{{ asset('js/config/halo.js') }}"></script>
        <script src="{{ asset('js/config/selection.js') }}"></script>
        <script src="{{ asset('js/config/inspector.js') }}"></script>
        <script src="{{ asset('js/config/stencil.js') }}"></script>
        <script src="{{ asset('js/config/toolbar.js') }}"></script>
        <script src="{{ asset('js/config/sample-graphs.js') }}"></script>
        <script src="{{ asset('js/views/main.js') }}"></script>
        <script src="{{ asset('js/views/theme-picker.js') }}"></script>
        <script src="{{ asset('js/models/joint.shapes.app.js') }}"></script>
        <script src="{{ asset('js/views/navigator.js') }}"></script>
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

        <!-- Local file warning: -->
        <div id="message-fs" style="display: none;">
            <p>The application was open locally using the file protocol. It is recommended to access it trough a <b>Web
                    server</b>.</p>
            <p>Please see <a href="README.md">instructions</a>.</p>
        </div>
        <script>
            (function() {
                var fs = (document.location.protocol === 'file:');
                var ff = (navigator.userAgent.toLowerCase().indexOf('firefox') !== -1);
                if (fs && !ff) {
                    (new joint.ui.Dialog({
                        width: 300,
                        type: 'alert',
                        title: 'Local File',
                        content: $('#message-fs').show()
                    })).open();
                }
            })();
        </script>
         <script>
    const Class = {!! json_encode($Class) !!};
    </script>
    @endpush
</x-app-layout>
