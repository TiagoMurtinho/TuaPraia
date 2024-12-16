@extends('layouts.app')

@section('content')

    <header class="custom-header text-center my-4">
        <h1 class="julee-regular">{{__('result.results_off')}} {{--{{ $query }}--}}</h1>
    </header>

    @include('components.search-filters')

    <div class="container custom-container mt-6">

        <section class="districts-section">
            <div class="row">
                @if($locals->isEmpty())
                    <p>{{__('result.no_result')}}</p>
                @else
                    @foreach($locals as $local)
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
                @endif
            </div>
        </section>
    </div>
@endsection
