@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Perfil do Usuário</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ $user->profile_photo }}" alt="Fotografia do usuário" class="img-fluid rounded-circle">
                    </div>
                    <div class="col-md-8">
                        <h3>{{ $user->name }}</h3>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Data de Criação:</strong> {{ $user->created_at->format('d/m/Y H:i:s') }}</p>
                        <p><strong>Última Atualização:</strong> {{ $user->updated_at->format('d/m/Y H:i:s') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
