@extends('layouts.app')

@section('title')
    Register
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger mb-4">
                                <ul class="mb-0 pb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{route("register-store")}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="mb-4">Registration</h3>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name*</label>
                                        <input type="text" name="first_name" class="form-control" id="first_name"
                                               maxlength="50" value="{{old("first_name")}}"
                                               required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" id="last_name"
                                               value="{{old("last_name")}}"
                                               maxlength="50">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email*</label>
                                        <input type="email" name="email" class="form-control" id="email" maxlength="50"
                                               value="{{old("email")}}"
                                               required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="mobile_number" class="form-label">Mobile Number*</label>
                                        <input type="text" name="mobile_number" class="form-control" id="mobile_number"
                                               maxlength="10" value="{{old("mobile_number")}}"
                                               required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password*</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                               maxlength="20"
                                               required>
                                        <small>One uppercase letter, one lowercase letter and special character</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm Password*</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                               id="password_confirmation" maxlength="20" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pan_card" class="form-label">Pan Card*</label>
                                        <input type="text" name="pan_card" class="form-control"
                                               id="pan_card" maxlength="10" value="{{old("pan_card")}}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="date_of_birth" class="form-label">Date of Birth*</label>
                                        <input type="date" name="date_of_birth" class="form-control"
                                               id="date_of_birth" min="{{$min_date_formatted}}"
                                               max="{{$max_date_formatted}}" value="{{old("date_of_birth")}}" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender*</label>
                                        <select name="gender" class="form-control" id="gender" required>
                                            <option value="" disabled selected>Select one</option>
                                            <option value="male" {{old("gender") == "male"?"selected":""}}>Male</option>
                                            <option value="female" {{old("gender") == "female"?"selected":""}}>Female
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea name="address" class="form-control" id="address"
                                                  maxlength="200">{{old("address")}}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="text-end">
                                        <button class="btn btn-primary">Register now</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
