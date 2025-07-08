@extends('admin.layouts.admin')

@section('title', 'Manage Admins')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Manage Admins</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('admin.admins.create') }}" class="btn btn-primary">Add New Admin</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Store</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->store_name }}</td>
                                    <td>{{ $admin->is_active ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <a href="{{ route('admin.admins.edit', $admin->id) }}"
                                            class="btn btn-info btn-sm">Edit</a>
                                        <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $admins->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection