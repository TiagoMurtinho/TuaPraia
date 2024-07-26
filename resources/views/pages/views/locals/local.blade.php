@extends('layouts.app')



@section('content')
    <header class="district-header text-center my-4">
        <h1 class="julee-regular">{{ $local->name }}</h1>
    </header>
    <div class="local-container">

        <!-- Distrito e País -->
        <div class="icon-text-container">
            <i class="ph ph-map-pin-area place_icon"></i><p>{{ $local->district->name }}, {{ __('local.portugal') }}</p>
        </div>

        <!-- Secção com imagem e ícones-->
        <div class="image-description-container mt-4 mb-5">

            <!-- Imagem -->
            <div class="local-image-container mt-4">
                @php
                    $mediaUrl = $local->getFirstMediaUrl('locals');
                @endphp
                @if($mediaUrl)
                    <img src="{{ $mediaUrl }}" alt="{{ $local->name }}" class="local-image">
                @else
                    <div class="no-image-local">{{ __('local.no_image') }}</div>
                @endif
            </div>

            <!-- Atributos destacados -->
            <div class="description-container">

                @if($local->attributes->contains('name', 'Blue Flag') || $local->attributes->contains('name', 'Parking'))
                    <div class="icon-text-container local_description_info">
                        @if($local->attributes->contains('name', 'Blue Flag'))
                            <div class="special_attr_info_row">
                                <img src="{{ asset('assets/img/bandeira_azul.png') }}" alt="Blue Flag" class="attr-image">
                                <p>{{ __('local.blue_flag') }}</p>
                            </div>
                        @endif
                        @if($local->attributes->contains('name', 'Parking'))
                            <div class="local_description_info_row">
                                <i class="ph ph-letter-circle-p description_icon"></i>
                                <p>{{ __('local.parking') }}</p>
                            </div>
                        @endif
                    </div>
                @else
                    <p>{{ __('local.no_special_attributes') }}</p>
                @endif

            </div>
        </div>

        <!-- Listagem dos atributos -->
        <div class="services-container">
            <h2 class="julee-regular local-subtitle mb-5">{{ __('local.existing_services') }}</h2>
            <div class="attributes-container">
                @foreach($local->attributes->chunk(2) as $chunk) <!-- chunk serve para agrupar, neste caso em pares -->
                    <div class="attribute-pair">
                        @foreach($chunk as $attribute)
                            <div class="local_description_info_row">
                                @if($attribute->name == 'Disabled Mobility Access')
                                    <i class="ph ph-wheelchair description_icon"></i>
                                @elseif($attribute->name == 'Parking')
                                    <i class="ph ph-letter-circle-p description_icon"></i>
                                @elseif($attribute->name == 'Shower')
                                    <i class="ph ph-shower description_icon"></i>
                                @elseif($attribute->name == 'WC')
                                    <i class="ph ph-toilet description_icon"></i>
                                @elseif($attribute->name == 'Lifeguard')
                                    <i class="ph ph-binoculars description_icon"></i>
                                @elseif($attribute->name == 'Blue Flag')
                                    <i class="ph ph-flag description_icon"></i>
                                @elseif($attribute->name == 'Restaurants')
                                    <i class="ph ph-fork-knife description_icon"></i>
                                @elseif($attribute->name == 'Activities')
                                    <i class="ph ph-person-simple-swim description_icon"></i>
                                @else
                                    <i class="ph ph-smiley-sad description_icon"></i>
                                @endif
                                <p>{{ $attribute->name == 'local.no_info' ? __('local.no_info') : $attribute->name }}</p>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Integração com Google Maps -->
        <div class="map-container mt-4 mb-4">
            @if($latitude && $longitude)
                @php
                    $mapUrl = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12248.057348026508!2d{$longitude}!3d{$latitude}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2z{$latitude},{$longitude}!5e0!3m2!1sen!2s!4v1600000000000!5m2!1sen!2s";
                @endphp
                <iframe src="{{ $mapUrl }}" width="1000" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            @else
                <p>{{ __('local.invalid_coordinates') }}</p>
            @endif
        </div>

        <!-- Coordenadas -->
        <div class="icon-text-container local_description_info">
            <div class="local_description_info_row"><i class="ph ph-tag description_icon"></i><p>{{ ucfirst($local->type) }}</p></div>
            <div class="local_description_info_row"><i class="ph ph-gps description_icon"></i><p>{{ __('local.coordinates') }}: {{ $local->coordinates }}</p></div>


        </div>
    </div>



@endsection
