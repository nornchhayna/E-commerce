@extends('users.app')
@section('content')
    <div class="container">
        <h2>Edit User</h2>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password (leave blank to keep current)</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" class="form-control">
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
@endsection