<!-- resources/views/users/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit User</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password (leave blank to keep current password)</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
            </div>

            @if ($authUser->role === 'admin' && $user->role == 'buyer')
                <div class="form-group">
                    <label for="mentor_id">Mentor</label>
                    <select name="mentor_id" class="form-control" id="mentor_id">
                        <option value="">Select Mentor</option>
                        @foreach(App\Models\User::where('role', 'team_lead')->get() as $mentor)
                            <option value="{{ $mentor->id }}" {{ old('mentor_id', $user->mentor_id) == $mentor->id ? 'selected' : '' }}>{{ $mentor->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
@endsection
