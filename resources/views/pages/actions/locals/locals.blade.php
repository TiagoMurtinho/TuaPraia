@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="card">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0 ms-2">{{ __('local.locals') }}</h5>
                    <button type="button" class="align-items-center" data-bs-toggle="modal"
                            data-bs-target="#addLocalModal">
                        <i class="ph ph-plus-circle plus align-middle ms-1"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-transparent align-middle">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">{{ __('local.name') }}</th>
                                <th scope="col" class="text-center">{{ __('local.description') }}</th>
                                <th scope="col" class="text-center">{{ __('local.coordinates') }}</th>
                                <th scope="col" class="text-center">{{ __('local.type') }}</th>
                                <th scope="col" class="text-center">{{ __('region.created_at') }}</th>
                                <th scope="col" class="text-center">{{ __('region.updated_at') }}</th>
                                <th scope="col" class="text-center">{{ __('local.district') }}</th>
                                <th scope="col" class="text-center">{{ __('local.region') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($locals as $local)
                                <tr>
                                    <td class="align-middle text-center">{{ $local->name }}</td>
                                    <td class="align-middle text-center">{{ $local->description }}</td>
                                    <td class="align-middle text-center">{{ $local->coordinates }}</td>
                                    <td class="align-middle text-center">{{ $local->type }}</td>
                                    <td class="align-middle text-center">{{ $local->created_at }}</td>
                                    <td class="align-middle text-center">{{ $local->updated_at }}</td>
                                    <td class="align-middle text-center">{{ $local->district->name }}</td>
                                    <td class="align-middle text-center">{{ $local->region->name }}</td>
                                    <td class="align-middle">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#editLocalModal{{ $local->id }}">
                                            <i class="ph ph-pencil-simple edit-pencil me-1"></i>
                                        </a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#deleteLocalModal{{ $local->id }}" onclick="confirmDelete('deleteLocalForm{{ $local->id }}', '{{ route('locals.destroy', $local->id) }}')">
                                            <i class="ph ph-trash delete-trash me-1"></i>
                                        </a>
                                    </td>
                                </tr>
                                @include('pages.actions.locals.modals.locals-add-modal')
                                @include('pages.actions.locals.modals.locals-edit-modal', ['id' => $local->id])
                                @include('pages.actions.locals.modals.locals-delete-modal')
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
@endsection