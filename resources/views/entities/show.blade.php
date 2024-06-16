<!-- resources/views/entities/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Entity Details</h1>

        <div class="card">
            <div class="card-header">
                {{ $entity->name }}
            </div>
            <div class="card-body">
                <h5 class="card-title">Description</h5>
                <p class="card-text">{{ $entity->description }}</p>
                <p class="card-text"><small class="text-muted">Created by: {{ $entity->user->name }}</small></p>
                <a href="{{ route('entities.edit', $entity) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('entities.destroy', $entity) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
