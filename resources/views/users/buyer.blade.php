<!-- resources/views/users/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Entities</h1>
    <a href="{{ route('entities.create') }}" class="btn btn-primary">Create Entities</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>User</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entities as $entity)
            <tr>
                <td>{{ $entity->id }}</td>
                <td>{{ $entity->name }}</td>
                <td>{{ $entity->description }}</td>
                <td>{{ $entity->user->name }}</td>
                <td>
                    <a href="{{ route('entities.show', $entity) }}" class="btn btn-info">View</a>
                    <form action="{{ route('entities.destroy', $entity) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
