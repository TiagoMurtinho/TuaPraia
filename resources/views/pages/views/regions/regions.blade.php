@extends('layouts.app')

@section('title', 'Locais da Região ' . $region->name)

@section('content')
    <header class="custom-header text-center my-4">
        <h1 class="julee-regular">{{__('region.local_region')}} {{ $region->name }}</h1>
    </header>
    <div class="container custom-container">

        @include('components.search-filters', ['regionId' => $region->id])

        @foreach($region->districts as $district)
            <section class="custom-section">
                <h2 class="py-6 julee-regular">{{__('region.district_region')}} {{ $district->name }}</h2>

                <!-- Beaches -->
                <h3 class="py-6 julee-regular">{{__('region.beach')}}</h3>
                <div class="row">
                    @foreach($district->locals->filter(function ($local) use ($locals) {
                        return $locals->contains('id', $local->id) && $local->type === 'beach';
                    }) as $local)
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

                <!-- Fluvials -->
                <h3 class="py-6 julee-regular">{{__('region.fluvial')}}</h3>
                <div class="row">
                    @foreach($district->locals->filter(function ($local) use ($locals) {
                        return $locals->contains('id', $local->id) && $local->type === 'fluvial';
                    }) as $local)
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

                <!-- Cascades -->
                <h3 class="py-6 julee-regular">{{__('region.cascade')}}</h3>
                <div class="row">
                    @foreach($district->locals->filter(function ($local) use ($locals) {
                        return $locals->contains('id', $local->id) && $local->type === 'cascade';
                    }) as $local)
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
        @endforeach
    </div>
@endsection
