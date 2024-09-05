@extends('layouts.app')

@section('title', 'Locais do Distrito de ' . $district->name)

@section('content')
    <header class="custom-header text-center my-4">
        <h1 class="julee-regular">{{ __('district.local_district') }} {{ $district->name }}</h1>
    </header>
    <div class="container custom-container">

        @include('components.search-filters', ['districtId' => $district->id])

        <section class="custom-section">
            <h2 class="py-6 julee-regular">{{ __('district.beach') }}</h2>
            <div class="row">
                @foreach($locals->where('type', 'beach') as $local)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="view-card h-100 position-relative">
                            @php
                                $mediaUrl = $local->getFirstMediaUrl('locals');
                            @endphp
                            @if($mediaUrl)
                                <img src="{{ $mediaUrl }}" alt="{{ $local->name }}" class="view-card-img-top">
                            @else
                                <div class="view-card-img-top no-image">{{ __('local.no_image') }}</div>
                            @endif
                            <div class="view-card-body">
                                <h5 class="view-card-title">{{ $local->name }}</h5>
                                <p class="view-card-text">{{ $local->description }}</p>
                                <a href="{{ route('locals.show', $local->id) }}" class="custom-icon-link"><i class="ph ph-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="custom-section">
            <h2 class="py-6 julee-regular">{{ __('district.fluvial') }}</h2>
            <div class="row">
                @foreach($locals->where('type', 'fluvial') as $local)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="view-card h-100 position-relative">
                            @php
                                $mediaUrl = $local->getFirstMediaUrl('locals');
                            @endphp
                            @if($mediaUrl)
                                <img src="{{ $mediaUrl }}" alt="{{ $local->name }}" class="view-card-img-top">
                            @else
                                <div class="view-card-img-top no-image">{{ __('local.no_image') }}</div>
                            @endif
                            <div class="view-card-body">
                                <h5 class="view-card-title">{{ $local->name }}</h5>
                                <p class="view-card-text">{{ $local->description }}</p>
                                <a href="{{ route('locals.show', $local->id) }}" class="custom-icon-link"><i class="ph ph-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="custom-section">
            <h2 class="py-6 julee-regular">{{ __('district.cascade') }}</h2>
            <div class="row">
                @foreach($locals->where('type', 'cascade') as $local)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="view-card h-100 position-relative">
                            @php
                                $mediaUrl = $local->getFirstMediaUrl('locals');
                            @endphp
                            @if($mediaUrl)
                                <img src="{{ $mediaUrl }}" alt="{{ $local->name }}" class="view-card-img-top">
                            @else
                                <div class="view-card-img-top no-image">{{ __('local.no_image') }}</div>
                            @endif
                            <div class="view-card-body">
                                <h5 class="view-card-title">{{ $local->name }}</h5>
                                <p class="view-card-text">{{ $local->description }}</p>
                                <a href="{{ route('locals.show', $local->id) }}" class="custom-icon-link"><i class="ph ph-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

    </div>
@endsection
