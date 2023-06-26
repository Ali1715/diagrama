@extends('layouts.app2')
@extends('layouts.sidebar')
<x-guest-layout>
@section('title', 'Perfil')
@section('content2')
  
            <!-- Page body -->
          

                            <div class="col d-flex flex-column">

                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Notificaciones</h3>
                                        </div>
                                        <div class="card-body">
                                            @if (count($notificaciones) > 0)
                                                @foreach ($notificaciones as $notificacion)
                                                    <div class="row g-3">
                                                        <div class="col-8">
                                                            <div class="row g-3 align-items-center">
                                                                <a href="#" class="col-auto">
                                                                    <span><img width="42" class="rounded-circle"
                                                        src="https://robohash.org/63b675b5134d0493e44166a7bdeb3fb5?set=set4&bgset=&size=400x400"
                                                        alt>
                                                                        <span class="badge bg-red"></span></span>
                                                                </a>
                                                                <div class="col">
                                                                    <a href="#"
                                                                        class="text-reset d-block text-truncate">Proyecto:
                                                                        {{ $notificacion->proyecto->nombre }}</a>
                                                                    <div class="text-muted mt-n1">
                                                                        {{ $notificacion->contenido }}
                                                                    </div>
                                                                </div>
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
                                                                        <button type="submit"
                                                                            class="btn btn-info border-0"
                                                                            title="Marcar visto">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="red" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                             <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                                 <path d="M5 12l5 5l10 -10" />
                                                                                </svg>

                                                                        </button>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                No tienes notificaciones sin leer
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
@endsection