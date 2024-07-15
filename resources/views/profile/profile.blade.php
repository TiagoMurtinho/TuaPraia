@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>{{ __('profile.profile_of') }} {{ $user->name }}</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ $user->profile_photo }}" alt="{{ __('profile.user_picture') }}" class="img-fluid rounded-circle">
                    </div>
                    <div class="col-md-8 d-flex">
                        <div class="flex-grow-1">
                            <h3>{{ $user->name }}</h3>
                            <p><strong>{{ __('profile.email') }}:</strong> {{ $user->email }}</p>
                            <p><strong>{{ __('profile.created_at') }}:</strong> {{ $user->created_at->format('d/m/Y H:i:s') }}</p>
                            <p><strong>{{ __('profile.last_updated_on') }}:</strong> {{ $user->updated_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                        <div class="ms-3 align-self-start">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                <i class="ph ph-pencil-simple edit-pencil me-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('profile.edit')

@endsection
