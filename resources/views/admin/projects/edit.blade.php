@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="text-center py-5">Edit Project</h1>

        @include('partials.errors')

        <form action="{{ route('admin.projects.update', ['project' => $project->slug]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $project->title) }}">
            </div>
            <div class="mb-3">
                <label for="type_id">Type</label>
                <select id="type_id" name="type_id" class="form-control">
                    <option value="">Select a type</option>
                    @foreach ($types as $type)
                        <option @selected($project->type?->id === $type->id) value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-5 mb-3">
                <h6>Technology selection</h6>

                <ul class="list-group">
                    @foreach ($technologies as $technology)
                        <ul class="list-group">
                            <li class="list-group-item">
                                @if (old('technologies') !== null)
                                    <input @checked(in_array($technology->id, old('technologies', []))) name="technologies[]" class="form-check-input me-1"
                                        type="checkbox" value="{{ $technology->id }}" id="accessory-{{ $technology->id }}">
                                @else
                                    <input @checked($project->technologies->contains($technology)) name="technologies[]" class="form-check-input me-1"
                                        type="checkbox" value="{{ $technology->id }}" id="accessory-{{ $technology->id }}">
                                @endif
                                <label class="form-check-label"
                                    for="accessory-{{ $technology->id }}">{{ $technology->name }}</label>
                            </li>
                        </ul>
                    @endforeach
                </ul>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-primary" title="Indietro"><i
                        class="fa-solid fa-square-caret-left"></i></a>
            </div>

        </form>
    </div>
@endsection
