@extends('layouts/app')
@include('auth.login')
@include('auth.register')

@section('content')

    @foreach($locals as $local)
        <div class="local">
            <h2>{{ $local->name }}</h2>
            <p>{{ $local->description }}</p>
            @php
                $mediaUrl = $local->getMediaUrl();
            @endphp
            @if($mediaUrl)
                <img src="{{ $mediaUrl }}" alt="{{ $local->name }}">
            @else
                <p>Imagem não disponível.</p>
            @endif
        </div>
    @endforeach


@endsection
