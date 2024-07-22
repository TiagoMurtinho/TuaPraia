@extends('layouts.app')



@section('content')
    <header class="district-header text-center my-4">
        <h1 class="julee-regular">{{ $local->name }}</h1>
    </header>
    <div class="container local-container">

        <!-- Distrito e País -->
        <div class="icon-text-container">
            <i class="ph ph-map-pin-area place_icon"></i><p>{{ $local->district->name }}, {{ __('local.portugal') }}</p>
        </div>

        <!-- Secção com imagem e descrição -->
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

            <!-- Descrição -->
            <div class="description-container">
                <h2 class="julee-regular local-subtitle">{{ __('local.description') }}</h2>
                <p class="mt-5">{{ $local->description }}</p>
                <div class="icon-text-container local_description_info">
                    <div class="local_description_info_row"><i class="ph ph-tag description_icon"></i><p>{{ ucfirst($local->type) }}</p></div>
                    <div class="local_description_info_row"><i class="ph ph-gps description_icon"></i><p>{{ __('local.coordinates') }}: {{ $local->coordinates }}</p></div>


                </div>
            </div>
        </div>

        <!-- Listagem dos atributos -->
        <div>
            <h2 class="julee-regular local-subtitle mb-5">{{ __('local.existing_services') }}</h2>
            <ul>
                @foreach($local->attributes as $attribute)
                    @if($attribute->name == 'Disabled Mobility Access')
                        <div class="local_description_info_row"><i class="ph ph-wheelchair description_icon"></i><p>{{ $attribute->name }}</p></div>
                    @elseif($attribute->name == 'Parking')
                        <div class="local_description_info_row"><i class="ph ph-letter-circle-p description_icon"></i><p>{{ $attribute->name }}</p></div>
                    @elseif($attribute->name == 'Shower')
                        <div class="local_description_info_row"><i class="ph ph-shower description_icon"></i><p>{{ $attribute->name }}</p></div>
                    @elseif($attribute->name == 'WC')
                        <div class="local_description_info_row"><i class="ph ph-toilet description_icon"></i><p>{{ $attribute->name }}</p></div>
                    @elseif($attribute->name == 'Lifeguard')
                        <div class="local_description_info_row"><i class="ph ph-binoculars description_icon"></i><p>{{ $attribute->name }}</p></div>
                    @elseif($attribute->name == 'Blue Flag')
                        <div class="local_description_info_row"><i class="ph ph-flag description_icon"></i><p>{{ $attribute->name }}</p></div>
                    @elseif($attribute->name == 'Restaurants')
                        <div class="local_description_info_row"><i class="ph ph-fork-knife description_icon"></i><p>{{ $attribute->name }}</p></div>
                    @elseif($attribute->name == 'Activities')
                        <div class="local_description_info_row"><i class="ph ph-person-simple-swim description_icon"></i><p>{{ $attribute->name }}</p></div>
                    @else
                        <div class="local_description_info_row"><i class="ph ph-smiley-sad description_icon"></i><p>{{ __('local.no_info') }}</p></div>
                    @endif
                @endforeach
            </ul>
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
    </div>



@endsection
