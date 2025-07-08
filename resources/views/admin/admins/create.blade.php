@extends('layouts.admin')

@section('title', 'Add New Admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Add New Admin</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.admins.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="store_name">Store Name</label>
                    <input type="text" name="store_name" id="store_name" class="form-control">
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" checked>
                        <label for="is_active" class="form-check-label">Active</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create Admin</button>
            </form>
        </div>
    </div>
</div>
@endsection
