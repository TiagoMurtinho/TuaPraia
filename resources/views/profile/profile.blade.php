@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <!-- Card da fotografia -->
        <div class="card col-auto">
            <div class="card-body">
                    <div class="text-center">
                        @php
                            $mediaUrl = $user->getMediaUrl();
                        @endphp
                        @if($mediaUrl)
                            <img src="{{ $mediaUrl }}" alt="{{ $user->name }}" class="img-fluid rounded-circle">
                        @else
                            <span>{{ __('profile.no_image') }}</span>
                        @endif
                    </div>
            </div>
        </div>
            <!-- Card das informações -->
            <div class="card col-auto">
                <div class="card-header">
                    <h2>{{ __('profile.profile_of') }} {{ $user->name }}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 d-flex ">
                            <div class="flex-grow-1">
                                <h1>{{ $user->name }}</h1><a href="#" data-bs-toggle="modal" data-bs-target="#editProfileInfoModal">
                                    <i class="ph ph-pencil-simple edit-pencil me-1"></i>
                                <p><strong>{{ __('profile.email') }}:</strong> {{ $user->email }}</p><a href="#" data-bs-toggle="modal" data-bs-target="#editProfileEmailModal">
                                    <i class="ph ph-pencil-simple edit-pencil me-1"></i>
                                </a>
                                <p><strong>{{ __('profile.password') }}:</strong> * * * * * *</p><a href="#" data-bs-toggle="modal" data-bs-target="#editProfilePasswordModal">
                                    <i class="ph ph-pencil-simple edit-pencil me-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('profile.modals.uptade-profile-name-modal')
    @include('profile.modals.update-profile-email-modal')
    @include('profile.modals.update-profile-password-modal')
    @include('profile.edit')

@endsection
