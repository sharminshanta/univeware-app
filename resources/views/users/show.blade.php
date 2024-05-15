@extends('layouts.default')
@section('title') User Details @endsection

@section('content')
    <div class="container-xl px-4 mt-4">
        <h1 class="mt-4">User Profile</h1>

        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="{{ route('users.grid') }}" target="__blank">User List</a>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <img class="rounded-circle mt-5" width="150px"
                             src="{{ asset('storage/' . $userDetails->photo) }}"
                             onerror="this.onerror=null;this.src='{{ asset('storage/uploads/profile.png') }}';" >
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form>
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Username (how username will appear to other users on the site)</label>
                                <input  readonly="readonly" class="form-control" id="inputUsername" name="username" type="text" placeholder="Enter username"
                                       value="{{ $userDetails->username ?? old('username') }}">
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputFirstName">First name</label>
                                    <input class="form-control" name="firstname" id="inputFirstName" type="text" placeholder="Enter first name"
                                           value="{{ $userDetails->firstname ?? old('firstname') }}">
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Last name</label>
                                    <input class="form-control" name="lastname" id="inputLastName" type="text" placeholder="Enter last name"
                                           value="{{ $userDetails->lastname ?? old('lastname') }}">
                                </div>
                            </div>
                            <!-- Form Row        -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (organization name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputOrgName">Prefix name</label>
                                    <input class="form-control" name="prefixname" id="inputOrgName" type="text" placeholder="Enter prefix name"
                                           value="{{ $userDetails->prefixname ?? old('prefixname') }}">
                                </div>
                                <!-- Form Group (location)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLocation">Suffix name</label>
                                    <input class="form-control" name="suffixname" id="inputLocation" type="text" placeholder="Enter suffix name"
                                           value="{{ $userDetails->suffixname ?? old('suffixname') }}">
                                </div>
                            </div>
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                <input readonly="readonly" class="form-control" id="inputEmailAddress" type="email" placeholder="Enter email address"
                                       value="{{ $userDetails->email ?? old('email') }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
