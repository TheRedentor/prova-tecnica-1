<style type="text/css">
    #map {
      height: 400px;
    }
</style>
@extends('main')
@section('title', 'Mapa')
@section('content')
<body>
    <div class="container mt-5">
        <div id="map"></div>
    </div>
    @if($place == null)
      <script type="text/javascript">
          function initMap() {
            const myLatLng = { lat: 41.155693369294134, lng: 1.1064982692085346 };
            const map = new google.maps.Map(document.getElementById("map"), {
              zoom: 5,
              center: myLatLng,
            });
    
            new google.maps.Marker({
              position: myLatLng,
              map,
              title: "¡Estamos aqui!",
            });
          }
    
          window.initMap = initMap;
      </script>
    @else
      <script type="text/javascript">
        var latitude = {!! json_encode($place->latitude) !!};
        var longitude = {!! json_encode($place->longitude) !!}
        var name = {!! json_encode($place->name) !!}
        function initMap() {
          const myLatLng = { lat: Number(latitude), lng: Number(longitude) };
          const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 5,
            center: myLatLng,
          });

          new google.maps.Marker({
            position: myLatLng,
            map,
            title: name,
          });
        }

        window.initMap = initMap;
      </script>
    @endif
    <a href="{{ route('sitio-nuevo') }}" class="btn btn-primary">Añadir sitio</a>
    <br>
    <br>
    <h3>Sitios guardados</h3>
    @foreach($sitios as $sitio)
      <p>{{ $sitio->name }}: {{ $sitio->latitude }}, {{ $sitio->longitude }} <a href="{{ route('mapa', [$sitio->id]) }}">Mostrar</a> <a href="{{ route('sitio-eliminar', [$sitio->id]) }}">X</a></p>
    @endforeach
  
    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap" ></script>
</body>
@endsection