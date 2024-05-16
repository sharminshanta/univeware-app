@extends('layouts.default')
@section('title') Action Log @endsection

@section('content')
    <h1 class="mt-4">User Action Log</h1>
    <div class="card-body">
        <div class="row mb-10">
            <div class="col-10">
                <p class="card-description">
                    A list of user action
                </p>
            </div>
        </div>

        <table id="datatablesSimple">
            <thead>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Username</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Action</th>
                <th>Value</th>
                <th>Created At</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Username</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Action</th>
                <th>Value</th>
                <th>Created At</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($actionLog as $log)
                <tr>
                    <th>{{ $log->user->firstname }}</th>
                    <th>{{ $log->user->lastname }}</th>
                    <th>{{ $log->user->username }}</th>
                    <th>{{ $log->user->email}}</th>
                    <th>
                        @if($log->user->prefixname == 'Mr')
                            Male
                        @else
                            Female
                        @endif
                    </th>
                    <th>{{ $log->key }}</th>
                    <th>{{ $log->value }}</th>
                    <th>{{ $log->created_at }}</th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

