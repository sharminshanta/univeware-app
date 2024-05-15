@extends('layouts.default')
@section('title') User Edit @endsection

@section('content')
    <div class="container-xl px-4 mt-4">
        <h1 class="mt-4">Edit User</h1>

        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="{{ route('users.grid') }}" target="__blank">User List</a>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="post" action="{{ route('users.update', ['id' => $userDetails->id]) }}">
                            @csrf
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Username (how username will appear to other users on the site)</label>
                                <input class="form-control" id="inputUsername" name="username" type="text" placeholder="Enter username"
                                    readonly="readonly" value="{{ $userDetails->username ?? old('username') }}">
                                @error('username')
                                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputFirstName">First name</label>
                                    <input class="form-control" name="firstname" id="inputFirstName" type="text" placeholder="Enter first name"
                                           value="{{ $userDetails->firstname ?? old('firstname') }}">
                                    @error('firstname')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Last name</label>
                                    <input class="form-control" name="lastname" id="inputLastName" type="text" placeholder="Enter last name"
                                           value="{{ $userDetails->lastname ?? old('lastname') }}">
                                    @error('lastname')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form Row        -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (organization name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputOrgName">Prefix name</label>
                                    <input class="form-control" name="prefixname" id="inputOrgName" type="text" placeholder="Enter prefix name"
                                           value="{{ $userDetails->prefixname ?? old('prefixname') }}">
                                    @error('prefixname')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- Form Group (location)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLocation">Suffix name</label>
                                    <input class="form-control" name="suffixname" id="inputLocation" type="text" placeholder="Enter suffix name"
                                           value="{{ $userDetails->suffixname ?? old('suffixname') }}">
                                    @error('suffixname')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                <input class="form-control" name="email" id="inputEmailAddress" type="email" placeholder="Enter email address"
                                  readonly="readonly" value="{{ $userDetails->email ?? old('email') }}">
                                @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputUserPhoto">User photo</label>
                                    <input type="file" name="photo" class="form-control" placeholder="User Photo" />
                                    @error('photo')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4 mb-0">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
