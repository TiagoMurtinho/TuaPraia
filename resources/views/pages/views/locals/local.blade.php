@extends('layouts.app')



@section('content')
    <header class="district-header text-center my-4">
        <h1 class="julee-regular">{{ $local->name }}</h1>
    </header>
    <div class="container">

        <!-- Distrito e País -->
        <div class="icon-text-container">
            <i class="ph ph-map-pin-area place_icon"></i><p>Distrito,Portugal</p>
        </div>

        <!-- Secção com imagem e descrição -->
        <div class="image-description-container mt-4">
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
        <table>
            <tr>
                <td>Icon</td>
                <td>Atributo</td>
            </tr>
        </table>
    </div>
@endsection
