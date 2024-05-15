@extends('layouts.default')
@section('title') User Create @endsection

@section('content')
    <h1 class="mt-4">New User</h1>
    <div class="row mb-10">
        <div class="col-10">
            <p class="card-description">
                Create a new user
            </p>
        </div>

        <div class="col-2">
            <a href="{{ route('users.grid') }}" class="btn btn-primary"><i class="list-item"></i> User List</a>
        </div>
        <br><br><br>
    </div>
    <form enctype="multipart/form-data" method="post" action="{{ route('users.store') }}">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-floating">
                    <select class="form-control" id="prefixName" name="prefixname">
                        <option value="Mr" {{ old('prefixname') == 'Mr' ? 'selected' : '' }}>Mr</option>
                        <option value="Mrs" {{ old('prefixname') == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                        <option value="Ms" {{ old('prefixname') == 'Ms' ? 'selected' : '' }}>Ms</option>
                    </select>
                    <label for="prefixName">Prefix Name</label>
                    @error('prefixname')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control" id="middlename" name="middlename" type="text" value="{{ old('middlename') }}" placeholder="Enter middle name" />
                    <label for="middlename">Middle Name</label>
                    @error('middlename')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="inputFirstName" name="firstname" type="text"
                           placeholder="Enter your first name" value="{{ old('firstname') }}" required="required" />
                    <label for="inputFirstName">First Name <span class="text-danger">*</span></label>
                    @error('firstname')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control" id="inputLastName" name="lastname" type="text"
                           placeholder="Enter last name" value="{{ old('lastname') }}" required="required" />
                    <label for="inputLastName">Last Name <span class="text-danger">*</span></label>
                    @error('lastname')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="username" value="{{ old('username') }}" name="username" type="text"
                           placeholder="Enter username" required="required" />
                    <label for="username">Username <span class="text-danger">*</span></label>
                    @error('username')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control" id="inputEmail" name="email" type="email"
                           placeholder="Enter email address" value="{{ old('email') }}" required="required" />
                    <label for="inputEmail">Email Address <span class="text-danger">*</span></label>
                    @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="inputPassword" name="password" type="password"
                           placeholder="Create a password" required="required" />
                    <label for="inputPassword">Password <span class="text-danger">*</span></label>
                    @error('password')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="inputPasswordConfirm" type="password"
                           placeholder="Confirm password" name="password_confirmation" required="required" />
                    <label for="inputPasswordConfirm">Confirm Password <span class="text-danger">*</span></label>
                    @error('password')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label>User Photo <span class="text-danger">*</span></label>
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
@endsection
