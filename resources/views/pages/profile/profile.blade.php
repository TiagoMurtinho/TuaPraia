@extends('layouts.app')

@section('content')

    <header class="profile-header text-center my-4">
        <h1 class="julee-regular">{{ __('profile.profile_of') }} {{ $user->name }}</h1>
    </header>
    <div class="container profile-container">
        <div class="row g-3">
            <!-- Card da fotografia -->
            <div class="col-md-4">
                <div class="card h-100 profile-view-card">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                        <div class="text-center mb-3">
                            @php
                                $mediaUrl = $user->getFirstMediaUrl();
                            @endphp
                            @if($mediaUrl)
                                <img src="{{ $mediaUrl }}" alt="{{ $user->name }}" class="img-fluid rounded-circle profile-view-card-img-top">
                            @else
                                <span class="profile-view-card-img-top no-image">{{ __('profile.no_image') }}</span>
                            @endif
                        </div>
                        <div class="text-end mt-auto">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#editProfilePhotoModal" class="text-decoration-none">
                                <i class="ph ph-upload-simple text-primary"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card das informações -->
            <div class="col-md-8">
                <div class="card h-100">
                    <div class="card-header bg-primary text-white">
                        <h2>{{ $user->name }}</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    <strong>{{ __('profile.email') }}:</strong>
                                    <span>{{ $user->email }}</span>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editProfileInfoModal" class="text-decoration-none">
                                        <i class="ph ph-gear text-primary ms-2"></i>
                                    </a>
                                </p>
                                <p>
                                    <strong>{{ __('profile.password') }}:</strong>
                                    <span>* * * * * *</span>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editProfilePasswordModal" class="text-decoration-none">
                                        <i class="ph ph-gear text-primary ms-2"></i>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('pages.profile.modals.uptade-profile-name-modal')
    @include('pages.profile.modals.update-profile-email-modal')
    @include('pages.profile.modals.update-profile-password-modal')
    @include('pages.profile.edit')

@endsection
