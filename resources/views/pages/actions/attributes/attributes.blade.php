@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="mb-0 ms-2">{{ __('attribute.title') }}</h5>
                <a href="{{ route('attributes.create') }}" class="align-items-center">
                    <i class="ph ph-plus-circle plus align-middle ms-1"></i>
                </a>
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
                                    <a href="{{ route('attributes.edit', $attribute->id) }}" class="">
                                        <i class="ph ph-pencil-simple edit-pencil me-1"></i>
                                    </a>
                                    <form action="{{ route('attributes.destroy', $attribute->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="" onclick="return confirm('Are you sure you want to delete this attribute??')">
                                            <i class="ph ph-trash delete-trash me-1"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
