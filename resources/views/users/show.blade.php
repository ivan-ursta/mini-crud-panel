<!-- resources/views/users/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>User Details</h1>

        <div class="card">
            <div class="card-header">
                {{ $user->name }}
            </div>
            <div class="card-body">
                <h5 class="card-title">Email: {{ $user->email }}</h5>
                <p class="card-text">Role: {{ ucfirst($user->role) }}</p>
                @if ($user->mentor)
                    <p class="card-text">Mentor: {{ $user->mentor->name }}</p>
                @endif
                <p class="card-text">Joined: {{ $user->created_at->format('d M Y') }}</p>
                <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>

        @if($user->role === 'team_lead')
            <div class="mt-4">
                <h2>Mentees</h2>
                @if ($mentees && $mentees->count() > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($mentees as $mentee)
                            <tr>
                                <td>{{ $mentee->id }}</td>
                                <td>{{ $mentee->name }}</td>
                                <td>{{ $mentee->email }}</td>
                                <td>
                                    <a href="{{ route('users.show', $mentee) }}" class="btn btn-info">View</a>
                                    <form action="{{ route('users.destroy', $mentee) }}" method="POST"
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h4>No mentees yet</h4>
                @endif
            </div>
        @endif

        @if($user->role === 'buyer')
            <div class="mt-4">
                <h2>Entities</h2>
                @if ($entities && $entities->count() > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <td>Description</td>
                            <td>User</td>
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
                                    <form action="{{ route('entities.destroy', $entity) }}" method="POST"
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETED')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h4>No entities yet</h4>
                @endif
            </div>
        @endif
    </div>
@endsection
