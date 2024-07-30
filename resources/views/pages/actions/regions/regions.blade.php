@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="actions-card">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0 ms-2">{{ __('region.regions') }}</h5>
                    <button type="button" class="align-items-center" data-bs-toggle="modal" data-bs-target="#addRegionModal">
                        <i class="ph ph-plus-circle plus align-middle ms-1"></i>
                    </button>
                </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-transparent align-middle">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">{{ __('region.name') }}</th>
                            <th scope="col" class="text-center">{{ __('region.created_at') }}</th>
                            <th scope="col" class="text-center">{{ __('region.updated_at') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($regions as $region)
                            <tr>
                                <td class="align-middle text-center">{{ $region->name }}</td>
                                <td class="align-middle text-center">{{ $region->created_at }}</td>
                                <td class="align-middle text-center">{{ $region->updated_at }}</td>
                                <td class="align-middle">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editRegionModal{{ $region->id }}">
                                        <i class="ph ph-pencil-simple edit-pencil me-1"></i>
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteRegionModal{{ $region->id }}" onclick="confirmDelete('deleteRegionForm{{ $region->id }}','{{ route('regions.destroy', $region->id) }}')">
                                        <i class="ph ph-trash delete-trash me-1"></i>
                                    </a>
                                </td>
                            </tr>

                            @include('pages.actions.regions.modals.regions-delete-modal')
                        @endforeach
                        </tbody>
                    </table>
                    <div class="justify-content-end">
                        {{ $regions->links() }} <!-- Links de paginação -->
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('pages.actions.regions.modals.regions-edit-modal')
    @include('pages.actions.regions.modals.regions-add-modal')
@endsection
