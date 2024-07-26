@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="actions-card">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0 ms-2">{{ __('district.title') }}</h5>
                    <button type="button" class="align-items-center" data-bs-toggle="modal" data-bs-target="#addDistrictModal">
                        <i class="ph ph-plus-circle plus align-middle ms-1"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-transparent align-middle">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">{{ __('district.name') }}</th>
                                <th scope="col" class="text-center">{{ __('district.region') }}</th>
                                <th scope="col" class="text-center">{{ __('district.created_at') }}</th>
                                <th scope="col" class="text-center">{{ __('district.updated_at') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($districts as $district)
                                <tr>
                                    <td class="align-middle text-center">{{ $district->name }}</td>
                                    <td class="align-middle text-center">{{ $district->region->name }}</td>
                                    <td class="align-middle text-center">{{ $district->created_at }}</td>
                                    <td class="align-middle text-center">{{ $district->updated_at }}</td>
                                    <td class="align-middle">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#editDistrictModal{{ $district->id }}">
                                            <i class="ph ph-pencil-simple edit-pencil me-1"></i>
                                        </a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#deleteDistrictModal" onclick="confirmDelete('deleteDistrictForm{{ $district->id }}', '{{ route('districts.destroy', $district->id) }}')">
                                            <i class="ph ph-trash delete-trash me-1"></i>
                                        </a>
                                    </td>
                                </tr>

                                @include('pages.actions.districts.modals.delete-districts')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @include('pages.actions.districts.modals.edit-districts')
    @include('pages.actions.districts.modals.add-districts', ['regions'=>$regions])
@endsection
