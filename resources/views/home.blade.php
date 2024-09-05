@extends('layouts.app')

@section('title', 'Homepage')

@section('content')

    @php
        $messageKey = request()->query('message_key');
    @endphp

    @if($messageKey)
        <div class="alert alert-success">
            {{ __('success.' . $messageKey) }}
        </div>
    @endif

    <header class="homepage-header text-center my-4">
        <h1 class="homepage-title julee-regular">{{__('home.title')}}</h1>
    </header>

    <section class="hero-section">
        <div class="hero-image">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h2 class="hero-title">{{__('home.hero_title')}}</h2>
                <form id="searchForm2" class="search-form">
                    <input class="search-input form-control" type="search" id="search2" placeholder="{{__('home.search_placeholder')}}" aria-label="Search" autocomplete="off" data-url="{{ route('locals.autocomplete') }}">
                    <button type="submit" class="search-button">{{__('home.search')}}</button>
                </form>
                <ul id="search-results2" class="list-group position-absolute w-100 mt-2"></ul>
            </div>
        </div>
    </section>

    <div class="container custom-container">

        <!-- Seção para Praias com Bandeira Azul -->
        <section class="homepage-section mt-5">
            <h2 class="section-title py-6 julee-regular">{{__('home.blueflag')}}</h2>
            <div class="row">
                @foreach($blueFlag->take(3) as $local)
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

        <!-- Seção para Praias com Zero Poluição -->
        <section class="homepage-section mt-5">
            <h2 class="section-title py-6 julee-regular">{{__('home.zero_pollution')}}</h2>
            <div class="row">
                @foreach($zeroPollution->take(3) as $local)
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

        <!-- Seção para Qualidade de Ouro -->
        <section class="homepage-section mt-5">
            <h2 class="section-title py-6 julee-regular">{{__('home.or_quality')}}</h2>
            <div class="row">
                @foreach($orQuality->take(3) as $local)
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
    @include('auth.reset-password')

@endsection
