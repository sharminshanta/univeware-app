@extends('layouts.default')
@section('title') Users @endsection

@section('content')
    <h1 class="mt-4">Users</h1>
    <div class="card-body">
        @if (Session::get('error'))
            <div class="alert alert-danger">
                <ul>
                    @foreach (Session::get('error') as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (Session::get('success'))
            <div class="alert alert-success">
                <ul>
                    @foreach (Session::get('success') as $success)
                        <li>{!! $success !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row mb-10">
            <div class="col-10">
                <p class="card-description">
                    A list of users
                </p>
            </div>

            <div class="col-2">
                <a href="{{ route('users.grid') }}" class="btn btn-primary">+ Add New</a>
            </div>
            <br><br><br>
        </div>

        <table id="datatablesSimple">
            <thead>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Username</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Username</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th>{{ $user->firstname }}</th>
                    <th>{{ $user->lastname }}</th>
                    <th>{{ $user->username }}</th>
                    <th>{{ $user->email }}</th>
                    <th>{{ $user->created_at }}</th>
                    <th>{{ $user->updated_at }}</th>
                    <th>
                        <a href="#" class="btn btn-sm btn-info" title="User Details"> View</a>
                        <a href="#" class="btn btn-sm btn-primary" title="Edit User"> Edit</a>
                        <a href="#" class="btn btn-sm btn-danger" title="Delete User"> Delete</a>
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
