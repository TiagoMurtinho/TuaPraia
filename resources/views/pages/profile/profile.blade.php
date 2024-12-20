@extends('layouts.app')

@section('title', 'Perfil de ' . $user->name)

@section('content')

    @include('components.success-message')

    <header class="custom-header text-center">
        <h1 class="julee-regular">{{ __('profile.profile_of') }} {{ $user->name }}</h1>
    </header>

    <div class="container profile-container">
        <div class="row justify-content-center">
            <!-- Card da fotografia -->
            <div class="col-md-3">
                <div class="card profile-view-card">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        @php
                            $mediaUrl = $user->getFirstMediaUrl('users');
                        @endphp
                        @if($mediaUrl)
                            <img src="{{ $mediaUrl }}" alt="{{ $user->name }}" class="img-fluid rounded-circle">
                        @else
                            <img src="{{ $user->avatar_url }}" alt="Avatar de {{ $user->name }}">
                        @endif
                        <div class="mt-3">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#editProfilePhotoModal" class="text-decoration-none profile-icon-link">
                                <i class="ph ph-upload-simple text-primary"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card das informações -->
            <div class="col-md-8">
                <div class="card h-100 custom-profile-card">
                    <div class="card-header">
                        <h2>{{ $user->name }}</h2>
                    </div>
                    <div class="card-body">
                        <p>
                            <strong>{{ __('profile.name') }}:</strong>
                            <span>{{ $user->name }}</span>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#editProfileInfoModal" class="text-decoration-none profile-icon-link ms-2">
                                <i class="ph ph-gear text-primary"></i>
                            </a>
                        </p>
                        <p>
                            <strong>{{ __('profile.email') }}:</strong>
                            <span>{{ $user->email }}</span>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#editProfileEmailModal" class="text-decoration-none profile-icon-link ms-2">
                                <i class="ph ph-gear text-primary"></i>
                            </a>
                        </p>
                        <p>
                            <strong>{{ __('profile.password') }}:</strong>
                            <span>{{ maskPassword($user->password) }}</span>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#editProfilePasswordModal" class="text-decoration-none profile-icon-link ms-2">
                                <i class="ph ph-gear text-primary"></i>
                            </a>
                        </p>
                        <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#deleteProfileModal">{{ __('profile.delete_account') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('pages.profile.modals.update-profile-photo-modal')
    @include('pages.profile.modals.update-profile-name-modal')
    @include('pages.profile.modals.update-profile-email-modal')
    @include('pages.profile.modals.update-profile-password-modal')
    @include('pages.profile.modals.delete-profile-modal')

@endsection
