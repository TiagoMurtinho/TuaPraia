@extends('layouts.app')



@section('content')
    <header class="district-header text-center my-4">
        <h1 class="julee-regular">{{ $local->name }}</h1>
    </header>
    <div class="container local-container">

        <!-- Distrito e País -->
        <div class="icon-text-container">
            <i class="ph ph-map-pin-area place_icon"></i><p>Distrito,Portugal</p>
        </div>

        <!-- Secção com imagem e descrição -->
        <div class="image-description-container mt-4 mb-5">
            <!-- Imagem -->
            <div class="local-image-container mt-4">
                <img src="{{ asset('assets/img/place.png') }}" alt="Imagem do Local" class="local-image">
            </div>

            <!-- Descrição -->
            <div class="description-container">
                <h2 class="julee-regular local-subtitle">Descrição</h2>
                <p class="mt-5">{{ $local->description }}</p>
                <div class="icon-text-container local_description_info">
                    <div class="local_description_info_row"><i class="ph ph-tag description_icon"></i><p>{{ $local->type }}</p></div>
                    <div class="local_description_info_row"><i class="ph ph-gps description_icon"></i><p>Coordenadas: {{ $local->coordinates }}</p></div>


                </div>
            </div>
        </div>

        <!-- Tabela com listagem dos atributos -->
        <h2 class="julee-regular local-subtitle mb-5">Serviços existentes</h2>
        <table class="mb-5">
            <tr>
                <td>Icon</td>
                <td>Atributo</td>
            </tr>
            <tr>
                <td>Icon 2</td>
                <td>Atributo 2</td>
            </tr>
        </table>

        <!-- Integração com Google Maps -->
        <div class="map-container mt-4 mb-4">
            @if($latitude && $longitude)
                @php
                    $mapUrl = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12248.057348026508!2d{$longitude}!3d{$latitude}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2z{$latitude},{$longitude}!5e0!3m2!1sen!2s!4v1600000000000!5m2!1sen!2s";
                @endphp
                <iframe src="{{ $mapUrl }}" width="1000" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            @else
                <p>Coordenadas inválidas. Mapa não disponível.</p>
            @endif
        </div>
    </div>



@endsection
