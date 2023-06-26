@section('title', 'Home')
<x-app-layout>
  

    @extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                  
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div class="list-group list-group-transparent">
                                    <a href="{{route('profile.index')}}"
                                        class="list-group-item list-group-item-action d-flex align-items-center ">Mi
                                        Cuenta</a>
                                    <a href="{{ route('notificaciones.index') }}"
                                        class="list-group-item list-group-item-action d-flex align-items-center">Mis
                                        Notificaciones</a>
                                        <a href="{{route('proyectos.index')}}"
                                        class="list-group-item list-group-item-action d-flex align-items-center">Mis
                                        Diagramas</a>
                                </div>
                                
            </div>
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
    <iframe src="https://giphy.com/embed/wwg1suUiTbCY8H8vIA"class="d-block w-100" alt="..." width="480" height="480" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p><a href="https://giphy.com/gifs/glitch-matrix-cat-wwg1suUiTbCY8H8vIA">via GIPHY</a></p>

    </div>
    <div class="carousel-item">
    <iframe src="https://giphy.com/embed/aeGl0oWfiIyJO"class="d-block w-100" width="480" height="480" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p><a href="https://giphy.com/gifs/cat-cute-aeGl0oWfiIyJO">via GIPHY</a></p>
    </div>
    <div class="carousel-item">
    <iframe src="https://giphy.com/embed/7Jrz5kRxqwR5S"class="d-block w-100" width="480" height="480" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p><a href="https://giphy.com/gifs/cat-sailor-moon-7Jrz5kRxqwR5S">via GIPHY</a></p>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
        </div>
    </div>
</div>
@endsection

    @push('scripts')
    <script>
        function favorito(proyecto_id) {
                $.ajax({
                    type: "POST",
                    url: "{{ url('proyectos/favorito') }}",
                    data: {
                        id: proyecto_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'JSON',
                    success: function() {
                    },
                });
            };
    </script>
    @endpush
</x-app-layout>
