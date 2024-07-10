@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0 ms-2">Regiões</h5>
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
                                    <form action="{{ route('regions.destroy', $region->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="" onclick="return confirm('Tem certeza que deseja excluir esta região?')">
                                            <i class="ph ph-trash delete-trash me-1"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @include('pages.actions.regions.modals.regions-add-modal')
                    @include('pages.actions.regions.modals.regions-edit-modal', ["id" => $region->id, "name" => $region->name])
                </div>
            </div>
        </div>
    </div>
@endsection
