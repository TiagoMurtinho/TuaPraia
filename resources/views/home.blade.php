@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <header class="homepage-header text-center my-4">
        <h1 class="homepage-title julee-regular">Descubra as maravilhas de Portugal</h1>
    </header>

    <section class="hero-section">
        <div class="hero-image">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h2 class="hero-title">Encontre o local perfeito para a sua próxima aventura</h2>
                <form class="search-form">
                    <input type="search" class="search-input" placeholder="Pesquise por praias, cascatas, e muito mais...">
                    <button type="submit" class="search-button">Pesquisar</button>
                </form>
            </div>
        </div>
    </section>

    <div class="container homepage-container">

        <!-- Seção para Praias com Bandeira Azul -->
        <section class="homepage-section">
            <h2 class="section-title py-6 julee-regular">Praias com Bandeira Azul</h2>
            <div class="row">
                @foreach($blueFlag as $local)
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

        <!-- Seção para Praias com Zero Poluição -->
        <section class="homepage-section">
            <h2 class="section-title py-6 julee-regular">Praias com Zero Poluição</h2>
            <div class="row">
                @foreach($zeroPollution as $local)
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

        <!-- Seção para Praias Fluiviais -->
        <section class="homepage-section">
            <h2 class="section-title py-6 julee-regular">Praias Fluiviais</h2>
            <div class="row">
                @foreach($fluvials as $local)
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

        <!-- Seção para Cascatas -->
        <section class="homepage-section">
            <h2 class="section-title py-6 julee-regular">Cascatas</h2>
            <div class="row">
                @foreach($cascades as $local)
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

    </div>
@endsection
