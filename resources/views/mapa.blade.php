<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mapa de Interacciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="grid grid-cols-5 gap-4">
                    
                    <div class="col-span-2 rounded-t-lg overflow-hidden border-t border-l border-r border-gray-400 p-10 flex justify-center">
                        <form class="w-full max-w-sm" id="puntos-form" action="{{ route('buscar_puntos') }}" method="POST">
                            <div class="flex mb-4 ">
                                <div class="w-full text-center text-xl h-12">
                                    Busqueda de Interacciones
                                </div>
                            </div>
                            @csrf
                            
                            <div class="md:flex md:items-center mb-6">
                                <div class="md:w-1/3">
                                   <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-fecha">
                                        Fecha
                                    </label>
                                </div>
                                <div class="md:w-2/3">
                                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-fecha" type="date" value="{{ old("fecha")}}" name="fecha">
                                    @error('fecha')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="md:flex md:items-center mb-6">
                                <div class="md:w-1/3">
                                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-dias">
                                        Días
                                    </label>
                                </div>
                                <div class="md:w-2/3">
                                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-dias" type="number" step="1" min="0" max="15" placeholder="Días a registrar" value="{{old("dias")}}" name="dias">
                                    @error('dias')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="md:flex md:items-center mb-6">
                                <div class="md:w-1/3">
                                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-usuario">
                                        ID del usuario
                                    </label>
                                </div>
                                <div class="md:w-2/3">
                                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-usuario" type="number" step="1" min="0" placeholder="Identificador" name="usuario_id" value="{{old("usuario_id")}}">
                                    @error('usuario_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="md:flex md:items-center mb-6">
                                <div class="md:w-1/3">
                                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-distancia">
                                        Distancia
                                    </label>
                                </div>
                                <div class="md:w-2/3">
                                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-distancia" type="number" step="1" min="0" max="30" placeholder="Rango de busqueda" value="{{old("distancia")}}" name="distancia">
                                    @error('distancia')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="md:flex md:items-center mb-6">
                                <div class="md:w-1/3">
                                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-tiempo">
                                        Tiempo
                                    </label>
                                </div>
                                <div class="md:w-2/3">
                                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-tiempo" type="time"  value="{{old("tiempo")}}" placeholder="Rango de tiempo"  name="tiempo">
                                    @error('tiempo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="md:flex md:items-center">
                                <div class="md:w-1/3"></div>
                                <div class="md:w-2/3">
                                    <button class="shadow bg-gray-400 hover:bg-gray-800 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                                        Buscar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-span-3 ">
                       <div class="m-5" id="map" style="height: 550px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">
    var map;
    var marker;
    
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 19.4584130, lng: -99.1153370 },
          zoom: 17,
          mapTypeId: 'terrain',
          heading: 90,
          tilt: 45
        });
        @isset ($interacciones)
        @foreach ($interacciones as $key=>$interaccion)



            map.setCenter(new google.maps.LatLng({{$interaccion->punto_usuario->lat}}, {{$interaccion->punto_usuario->lng}}))
            var usuario_infowindow = new google.maps.InfoWindow();
            var interaccion_infowindow = new google.maps.InfoWindow();
            var line_infowindow = new google.maps.InfoWindow();
            {{-- expr --}}
            var usuario_marker_{{$key}} = new google.maps.Marker({
                position: new google.maps.LatLng({{$interaccion->punto_usuario->lat}}, {{$interaccion->punto_usuario->lng}}),
                map: map,
                scaledSize: new google.maps.Size(3, 3),
                icon : {
                    url: "{{$interaccion->punto_usuario->usuario_360() ? $interaccion->punto_usuario->usuario_360()['icon'] : "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png"}}", // url
                    scaledSize: new google.maps.Size(50, 50), // scaled size
                    // origin: new google.maps.Point(0,0), // origin
                    // anchor: new google.maps.Point(0, 0) // anchor
                }


            });
             google.maps.event.addListener(usuario_marker_{{$key}}, 'click', (function(usuario_marker_{{$key}}, i) {
                return function() {
                    usuario_infowindow.setContent(`<div class="flex items-center">
                      <div class="text-sm">
                        <p class="text-gray-900 leading-none"><strong>Usuario:</strong> {{$interaccion->punto_usuario->usuario_360() ? $interaccion->punto_usuario->usuario_360()['nombre']."  ".$interaccion->punto_usuario->usuario_360()['apellido_paterno']." ".$interaccion->punto_usuario->usuario_360()['apellido_paterno'] : $interaccion->punto_usuario->usuario_id}}</p>
                        <p class="text-gray-600"><strong>Fecha:</strong> {{$interaccion->punto_usuario->fecha}}</p>
                        <p class="text-gray-600"><strong>Hora:</strong> {{$interaccion->punto_usuario->hora}}</p>
                      </div>
                    </div>`);
                    usuario_infowindow.open(map, usuario_marker_{{$key}});
                }
            })(usuario_marker_{{$key}}, {{$key}}));

            var interaccion_marker_{{$key}} = new google.maps.Marker({
                position: new google.maps.LatLng({{$interaccion->punto_interaccion->lat}}, {{$interaccion->punto_interaccion->lng}}),
                map: map,
                icon : {
                    url: "{{$interaccion->punto_interaccion->usuario_360() ? $interaccion->punto_interaccion->usuario_360()['icon'] : "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png"}}", // url
                    scaledSize: new google.maps.Size(50, 50), // scaled size
                    // origin: new google.maps.Point(0,0), // origin
                    // anchor: new google.maps.Point(0, 0) // anchor
                }


            });
             google.maps.event.addListener(interaccion_marker_{{$key}}, 'click', (function(interaccion_marker_{{$key}}, i) {
                return function() {
                    interaccion_infowindow.setContent(`<div class="flex items-center">
                      <div class="text-sm">
                        <p class="text-gray-900 leading-none"><strong>ID:</strong> {{$interaccion->punto_interaccion->usuario_360() ? $interaccion->punto_interaccion->usuario_360()['nombre']."  ".$interaccion->punto_interaccion->usuario_360()['apellido_paterno']." ".$interaccion->punto_interaccion->usuario_360()['apellido_paterno'] : $interaccion->punto_interaccion->usuario_id}}</p>
                        <p class="text-gray-600"><strong>Fecha:</strong> {{$interaccion->punto_interaccion->fecha}}</p>
                        <p class="text-gray-600"><strong>Hora:</strong> {{$interaccion->punto_interaccion->hora}}</p>
                        <p class="text-gray-600"><strong>Rango:</strong> {{$interaccion->distancia}} metros</p>
                         <p class="text-gray-600"><strong>Tiempo:</strong> Hace {{$interaccion->hora}} horas</p>
                      </div>
                    </div>`);
                    interaccion_infowindow.open(map, interaccion_marker_{{$key}});
                }
            })(interaccion_marker_{{$key}}, {{$key}}));
            var line_{{$key}} = new google.maps.Polyline({
                path: [
                    new google.maps.LatLng({{$interaccion->punto_usuario->lat}}, {{$interaccion->punto_usuario->lng}}), 
                    new google.maps.LatLng({{$interaccion->punto_interaccion->lat}}, {{$interaccion->punto_interaccion->lng}})
                ],
                strokeColor: "#FF00FF",
                strokeOpacity: 1.0,
                strokeWeight: 5,
                map: map
            });
            google.maps.event.addListener(line_{{$key}}, 'click', (function(line_{{$key}}, i) {
                return function(event) {
                    line_infowindow.setContent(`<div class="flex items-center">
                      <div class="text-sm">
                         <p class="text-gray-600"><strong>Rango:</strong> {{$interaccion->distancia}} metros</p>
                         <p class="text-gray-600"><strong>Tiempo:</strong> Hace {{$interaccion->hora}} horas</p>
                      </div>
                    </div>`);
                    line_infowindow.setPosition(event.latLng);
                    line_infowindow.open(map);
                }
            })(line_{{$key}}, {{$key}}));
        @endforeach
    @endisset
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_KEY')}}&callback=initMap"
></script>