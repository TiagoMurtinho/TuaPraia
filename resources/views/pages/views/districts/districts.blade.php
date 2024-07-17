@extends('layouts.app')

@section('title', 'Locais do Distrito de ' . $district->name)

@section('content')
    <header class="district-header text-center my-4">
        <h1 class="julee-regular">Locais do Distrito de {{ $district->name }}</h1>
    </header>
    <div class="container district-container">

        <section class="districts-section">
            <h2 class="districts-section py-6 julee-regular">Beaches</h2>
            <div class="row">
                @foreach($beaches as $local)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="district-view-card h-100 position-relative">
                            @php
                                $mediaUrl = $local->getFirstMediaUrl('locals');
                            @endphp
                            @if($mediaUrl)
                                <img src="{{ $mediaUrl }}" alt="{{ $local->name }}" class="district-view-card-img-top">
                            @else
                                <div class="district-view-card-img-top no-image">{{ __('local.no_image') }}</div>
                            @endif
                            <div class="district-view-card-body">
                                <h5 class="district-view-card-title">{{ $local->name }}</h5>
                                <p class="district-view-card-text">{{ $local->description }}</p>
                                <a href="{{ route('locals.show', $local->id) }}" class="district-icon-link"><i class="ph ph-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="districts-section">
            <h2 class="districts-section py-6 julee-regular">Fluvials</h2>
            <div class="row">
                @foreach($fluvials as $local)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="district-view-card h-100 position-relative">
                            @php
                                $mediaUrl = $local->getFirstMediaUrl('locals') ?: $local->getMediaUrl();
                            @endphp
                            @if($mediaUrl)
                                <img src="{{ $mediaUrl }}" alt="{{ $local->name }}" class="district-view-card-img-top">
                            @else
                                <div class="district-view-card-img-top no-image">{{ __('local.no_image') }}</div>
                            @endif
                            <div class="district-view-card-body">
                                <h5 class="district-view-card-title">{{ $local->name }}</h5>
                                <p class="district-view-card-text">{{ $local->description }}</p>
                                <a href="{{ route('locals.show', $local->id) }}" class="district-icon-link"><i class="ph ph-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="districts-section">
            <h2 class="districts-section py-6 julee-regular">Cascades</h2>
            <div class="row">
                @foreach($cascades as $local)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="district-view-card h-100 position-relative">
                            @php
                                $mediaUrl = $local->getFirstMediaUrl('locals') ?: $local->getMediaUrl();
                            @endphp
                            @if($mediaUrl)
                                <img src="{{ $mediaUrl }}" alt="{{ $local->name }}" class="district-view-card-img-top">
                            @else
                                <div class="district-view-card-img-top no-image">{{ __('local.no_image') }}</div>
                            @endif
                            <div class="district-view-card-body">
                                <h5 class="district-view-card-title">{{ $local->name }}</h5>
                                <p class="district-view-card-text">{{ $local->description }}</p>
                                <a href="{{ route('locals.show', $local->id) }}" class="district-icon-link"><i class="ph ph-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

    </div>
@endsection
