@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Resultados da Pesquisa para: "{{ $query }}"</h1>

        @if($locals->isEmpty())
            <p>Nenhum resultado encontrado.</p>
        @else
            <ul class="list-group">
                @foreach($locals as $local)
                    <li class="list-group-item"><a href="{{ url('/locals/' . $local->id) }}">{{ $local->name }}</a></li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
