<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mapa de Interacciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="grid grid-cols-4 gap-4">
                    
                    <div class="col-span-2 rounded-t-lg overflow-hidden border-t border-l border-r border-b border-gray-400 p-10 flex justify-center">
                        <div class="grid">
                            
                            <form class="w-full" id="puntos-form" action="{{ route('buscar_puntos') }}" method="POST">
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

                    </div>
                    <div class="col-span-2 rounded-t-lg overflow-hidden border-t border-l border-r border-b border-gray-400 p-2" >
                        <div class="w-full mt-2 w-full lg:max-w-full lg:flex">
                            <div class="w-screen p-4 flex flex-col justify-between leading-normal text-gray-700 p-4 overscroll-none overflow-auto " style="height: 33rem !important;">
                                <div class="flex mb-4 items-stretch">
                                    <div class="flex-1 text-center text-xl h-12">
                                        Busqueda de Interacciones
                                    </div>
                                    <div class="flex-1 text-center">
                                        @isset ($interacciones)
                                            <button class="modal-button-all bg-purple-300 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-full">
                                                Notificar a todos
                                            </button>
                                        @endisset
                                    </div>
                                </div>
                                @isset ($interacciones)
                                    @foreach ($interacciones as $key=>$interaccion)
                                        <div class="w-full flex mt-2 mb-2 items-center punto " style="cursor: pointer;"  onclick="setCenter({{$interaccion->id}},{{$distancia}},'{{$tiempo}}')">
                                            <div class="w-full grid grid-flow-row grid-cols-3 grid-rows-1 gap-4">
                                                <div>
                                                    <div class="flex items-center ">
                                                        <img class="w-10 h-10 rounded-full mr-4" src="{{$interaccion->info_usuario360 ? $interaccion->info_usuario360['image'] : asset("images/user.png") }}" alt="avatar">
                                                        <div class="text-sm">
                                                            <p class="text-gray-900 leading-none">{{$interaccion->info_usuario360 ? $interaccion->info_usuario360['nombre']."  ".$interaccion->info_usuario360['apellido_paterno']." ".$interaccion->info_usuario360['apellido_materno'] : $interaccion->usuario_id}}</p>
                                                            <p class="text-gray-600"><strong>Fecha:</strong> {{$interaccion->fecha}}</p>
                                                        </div>
                                                    </div>
                                                  
                                                   
                                                </div>
                                                <div>
                                                    <div class="flex items-center">
                                                        <img class="w-10 h-10 rounded-full mr-4" src="{{$interaccion->info_interaccion360 ? $interaccion->info_interaccion360['image'] : asset("images/user.png") }}" alt="avatar">
                                                        <div class="text-sm">
                                                            <p class="text-gray-900 leading-none">{{$interaccion->info_interaccion360 ? $interaccion->info_interaccion360['nombre']."  ".$interaccion->info_interaccion360['apellido_paterno']." ".$interaccion->info_interaccion360['apellido_materno'] : $interaccion->interaccion_id}}</p>
                                                            <p class="text-gray-600"><strong>Tiempo de interaccion:</strong> {{$interaccion->tiempo}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="text-center">
                                                        <button class="bg-purple-300 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-full" onclick="showModal({{$interaccion->interaccion_id}})">
                                                          Notificar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    @endforeach
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="m-5" id="map" style="height: 550px;"></div>
            </div>
        </div>
    </div>

    <div class="modal-all opacity-0 pointer-events-none absolute w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay-all fixed w-full h-full bg-black opacity-25 top-0 left-0 cursor-pointer"></div>
        <div class="absolute w-1/2 h-auto bg-white rounded-sm shadow-lg flex text-2xl">
            <div class="container mx-auto">
                <div class="flex-auto text-gray-700 text-center bg-gray-200 px-4 pt-2 pb-2">
                    <h3>
                        Notificar
                        
                    </h3>
                    <span class="absolute top-0 right-0 m-3" onclick="toggleModal()">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
                @isset ($interacciones)
                    @foreach ($interacciones->unique("interaccion_id") as $key=>$interaccion)
                    <div class="flex">
                        <div class="flex-1 text-gray-700 text-center px-4 py-2 m-2">
                            <div class="flex items-center ">
                                <img class="w-10 h-10 rounded-full mr-4" src="{{$interaccion->info_interaccion360 ? $interaccion->info_interaccion360['image'] : asset("images/user.png") }}" alt="avatar">
                                <div class="text-sm">
                                    <p class="text-gray-900 leading-none">{{$interaccion->info_interaccion360 ? $interaccion->info_interaccion360['nombre']."  ".$interaccion->info_interaccion360['apellido_paterno']." ".$interaccion->info_interaccion360['apellido_materno'] : $interaccion->interaccion_id}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex-4 text-gray-700 text-center px-4 py-2 m-2">
                            <input type="checkbox">
                        </div>
                    </div>
                    @endforeach
                @endisset
                <div class="flex">
                    <textarea class="py-2 m-2 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" placeholder="Mensaje a los usuario"></textarea>
                </div>
                <div class="text-center m-2">
                    <button class="bg-purple-300 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-full">
                        Enviar
                    </button>
                </div>
            </div>
        </div>
    </div>

    @isset ($interacciones)
        @foreach ($interacciones as $key=>$interaccion)
            <div class="modal-{{$interaccion->interaccion_id}} opacity-0 pointer-events-none absolute w-full h-full top-0 left-0 flex items-center justify-center">
                <div class="modal-overlay-all fixed w-full h-full bg-black opacity-25 top-0 left-0 cursor-pointer"></div>
                <div class="absolute w-1/2 h-auto bg-white rounded-sm shadow-lg flex text-2xl">
                    <div class="container mx-auto">
                        <div class="flex-auto text-gray-700 text-center bg-gray-200 px-4 pt-2 pb-2">
                            <h3>
                                Notificar
                                
                            </h3>
                            <span class="absolute top-0 right-0 m-3" onclick="showModal({{$interaccion->interaccion_id}})">
                                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                            </span>
                        </div>
                        <div class="flex">
                            <div class="text-gray-700 text-center px-4 py-2 m-2">
                                <div class="flex items-center ">
                                    <img class="w-10 h-10 rounded-full mr-4" src="{{$interaccion->info_interaccion360 ? $interaccion->info_interaccion360['image'] : asset("images/user.png") }}" alt="avatar">
                                    <div class="text-sm">
                                        <p class="text-gray-900 leading-none">{{$interaccion->info_interaccion360 ? $interaccion->info_interaccion360['nombre']."  ".$interaccion->info_interaccion360['apellido_paterno']." ".$interaccion->info_interaccion360['apellido_materno'] : $interaccion->interaccion_id}}</p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="flex">
                            <textarea class="py-2 m-2 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" placeholder="Mensaje a los usuario"></textarea>
                        </div>
                        <div class="text-center m-2">
                            <button class="bg-purple-300 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-full">
                                Enviar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endisset

</x-app-layout>

{{-- Modal --}}
<script type="text/javascript">
    const button = document.querySelector('.modal-button-all')
    button.addEventListener('click', toggleModal)


    function toggleModal () {
        const modal = document.querySelector('.modal-all')
        modal.classList.toggle('opacity-0')
        modal.classList.toggle('pointer-events-none')
    }

    function showModal(id){
        const modal = document.querySelector('.modal-'+id)
          modal.classList.toggle('opacity-0')
          modal.classList.toggle('pointer-events-none')
    }

</script>

<script type="text/javascript">
    var map;
    let markers = [];
    var lines = [];
    var poly_usuario;
    
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 19.4584130, lng: -99.1153370 },
          zoom: 17,
          mapTypeId: 'terrain',
          heading: 90,
          tilt: 45
        });

        poly_usuario = new google.maps.Polyline({
            strokeColor: "#000000",
            strokeOpacity: 1.0,
            strokeWeight: 3,
        });
        poly_usuario.setMap(map);
        
        
        

    }
    function setCenter(interaccion_id,distancia,$tiempo){
        
        fetch("{{ url('api/web-interaccion') }}"+`/${interaccion_id}`)
            .then(response => response.json())
            .then(data => {
                clearMarkers()
                console.log(data);
                poly_usuario.setMap(null)
                poly_usuario = new google.maps.Polyline({
                    strokeColor: "#000000",
                    strokeOpacity: 1.0,
                    strokeWeight: 3,
                });
                poly_usuario.setMap(map);
                puntos = data.puntos;
                puntos.forEach(function(punto,key){
                    if (punto.distancia <= distancia) {
                        var usuario_infowindow = new google.maps.InfoWindow();
                        var interaccion_infowindow = new google.maps.InfoWindow();
                        var line_infowindow = new google.maps.InfoWindow();

                        var usuario_marker = new google.maps.Marker({
                            position : new google.maps.LatLng(punto.punto_usuario.lat,punto.punto_usuario.lng),
                            map : map,
                            icon : {
                                url:(data.info_usuario ? data.info_usuario.icon : "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png"),
                                scaledSize: new google.maps.Size(50, 50),
                                // origin: new google.maps.Point(0,0), // origin
                                // anchor: new google.maps.Point(0, 0) // anchor
                            }
                        });
                        markers.push(usuario_marker);

                        google.maps.event.addListener(usuario_marker, 'click', (function(usuario_marker, i) {
                                return function() {
                                    usuario_infowindow.setContent(`<div class="flex items-center">
                                      <div class="text-sm">
                                        <p class="text-gray-900 leading-none"><strong>Usuario:</strong>${(data.info_usuario ? data.info_usuario.nombre+" "+data.info_usuario.apellido_paterno+" "+data.info_usuario.apellido_materno : data.interaccion.usuario_id)}</p>
                                        <p class="text-gray-600"><strong>Fecha:</strong> ${punto.punto_usuario.fecha}</p>
                                        <p class="text-gray-600"><strong>Hora:</strong> ${punto.punto_usuario.hora}</p>
                                        <p class="text-gray-600"><strong>Distancia:</strong> ${punto.distancia} metros</p>
                                        <p class="text-gray-600"><strong>Rango de tiempo:</strong> ${punto.tiempo}</p>
                                      </div>
                                    </div>`);
                                    usuario_infowindow.open(map, usuario_marker);
                                }
                            })(usuario_marker, key));
                        
                        var interaccion_marker = new google.maps.Marker({
                            position : new google.maps.LatLng(punto.punto_interaccion.lat,punto.punto_interaccion.lng),
                            map : map,
                            icon : {
                                url : (data.info_interaccion ? data.info_interaccion.icon : "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png"),
                                scaledSize: new google.maps.Size(50, 50), 
                                // origin: new google.maps.Point(0,0), // origin
                                // anchor: new google.maps.Point(0, 0) // anchor
                            }
                        })

                        markers.push(interaccion_marker);
                        google.maps.event.addListener(interaccion_marker, 'click', (function(interaccion_marker, i) {
                                return function() {
                                    usuario_infowindow.setContent(`<div class="flex items-center">
                                      <div class="text-sm">
                                        <p class="text-gray-900 leading-none"><strong>Usuario:</strong>${(data.info_interaccion ? data.info_interaccion.nombre+" "+data.info_interaccion.apellido_paterno+" "+data.info_interaccion.apellido_materno : data.interaccion.usuario_id)}</p>
                                        <p class="text-gray-600"><strong>Fecha:</strong> ${punto.punto_interaccion.fecha}</p>
                                        <p class="text-gray-600"><strong>Hora:</strong> ${punto.punto_interaccion.hora}</p>
                                        <p class="text-gray-600"><strong>Distancia:</strong> ${punto.distancia} metros</p>
                                        <p class="text-gray-600"><strong>Rango de tiempo:</strong> ${punto.tiempo}</p>
                                      </div>
                                    </div>`);
                                    usuario_infowindow.open(map, interaccion_marker);
                                }
                            })(interaccion_marker, key));
                        var line = new google.maps.Polyline({
                            path: [
                                new google.maps.LatLng(punto.punto_usuario.lat,punto.punto_usuario.lng), 
                                new google.maps.LatLng(punto.punto_interaccion.lat,punto.punto_interaccion.lng)
                            ],
                            strokeColor: "#FF00FF",
                            strokeOpacity: 1.0,
                            strokeWeight: 2.5,
                            map: map
                        });
                        lines.push(line);
                            google.maps.event.addListener(line, 'click', function(event) {
                                // infowindow.content = content;
                                line_infowindow.setContent(`<div class="flex items-center">
                                      <div class="text-sm">
                                        <p class="text-gray-600"><strong>Distancia:</strong> ${punto.distancia} metros</p>
                                        <p class="text-gray-600"><strong>Rango de tiempo:</strong> ${punto.tiempo}</p>
                                      </div>
                                    </div>`);

                                // line_infowindow.position = event.latLng;
                                line_infowindow.setPosition(event.latLng);
                                line_infowindow.open(map);
                            });
                        
                        const path_usuario = poly_usuario.getPath();
                        path_usuario.push(new google.maps.LatLng(punto.punto_usuario.lat,punto.punto_usuario.lng))

                        map.setCenter(new google.maps.LatLng(punto.punto_interaccion.lat,punto.punto_interaccion.lng));
                        
                    }
                });
            });
    }

    // Sets the map on all markers in the array.
    function setMapOnAll(map) {
        for (let i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
        for (let i = 0; i < lines.length; i++) {
            lines[i].setMap(map);
        }
    }

    // Removes the markers from the map, but keeps them in the array.
    function clearMarkers() {
        setMapOnAll(null);
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_KEY')}}&callback=initMap"
></script>