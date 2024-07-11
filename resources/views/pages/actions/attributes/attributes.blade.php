@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0 ms-2">{{ __('attribute.title') }}</h5>
                    <button type="button" class="align-items-center" data-bs-toggle="modal" data-bs-target="#addAttributeModal">
                        <i class="ph ph-plus-circle plus align-middle ms-1"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-transparent align-middle">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">{{ __('attribute.name') }}</th>
                                <th scope="col" class="text-center">{{ __('attribute.created_at') }}</th>
                                <th scope="col" class="text-center">{{ __('attribute.updated_at') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($attributes as $attribute)
                                <tr>
                                    <td class="align-middle text-center">{{ $attribute->name }}</td>
                                    <td class="align-middle text-center">{{ $attribute->created_at }}</td>
                                    <td class="align-middle text-center">{{ $attribute->updated_at }}</td>
                                    <td class="align-middle">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#editAttributeModal{{ $attribute->id }}">
                                            <i class="ph ph-pencil-simple edit-pencil me-1"></i>
                                        </a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#deleteAttributeModal" onclick="confirmDelete('deleteAttributeForm', '{{ route('attributes.destroy', $attribute->id) }}')">
                                            <i class="ph ph-trash delete-trash me-1"></i>
                                        </a>
                                    </td>
                                </tr>
                                @include('pages.actions.attributes.modals.add-attributes')
                                @include('pages.actions.attributes.modals.edit-attributes', ["id" => $attribute->id, "name" => $attribute->name])
                                @include('pages.actions.attributes.modals.delete-attributes')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
