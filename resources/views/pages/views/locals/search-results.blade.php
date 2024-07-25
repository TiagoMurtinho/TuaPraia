@extends('layouts.app')

@section('content')
    <div class="container district-container">
        <header class="district-header text-center my-4">
            <h1 class="julee-regular">Resultados da Pesquisa para: {{ $query }}</h1>
        </header>

        <section class="districts-section">
            <div class="row">

                @if($locals->isEmpty())
                    <p>Nenhum resultado encontrado.</p>
                @else
                    <ul class="list-group">
                        @foreach($locals as $local)

                            <!-- Linhas da outra view -->
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
                    </ul>
                @endif
            </div>
        </section>
    </div>
@endsection
