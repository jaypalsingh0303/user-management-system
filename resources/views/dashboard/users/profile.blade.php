@extends('layouts.app')

@section('title')
    Profile
@endsection

@section('content')
    <style>
        .profile-container {
            width: 360px;
            height: 360px;
            overflow: hidden;
            margin-bottom: 20px;
            border: 1px solid #eee;
            border-radius: 5px;
            position: relative;
        }

        .profile-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-container .upload-icon {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: gray;
            position: absolute;
            top: 10px;
            right: 10px;
            color: #ffff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-container .delete-icon {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: red;
            position: absolute;
            top: 10px;
            right: 50px;
            color: #ffff;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
        }
    </style>

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

                        @if(session()->has("success"))
                            <div class="alert alert-success mb-4">
                                <ul class="mb-0 pb-0">
                                    <li>{{ session()->get("success") }}</li>
                                </ul>
                            </div>
                        @endif

                        @if(session()->has("error"))
                            <div class="alert alert-danger mb-4">
                                <ul class="mb-0 pb-0">
                                    <li>{{ session()->get("error") }}</li>
                                </ul>
                            </div>
                        @endif

                        <form action="{{route("dashboard.profile.update")}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="mb-4">Profile</h3>
                                </div>

                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">
                                        <div class="profile-container">
                                            @if($user->profile)
                                                <img
                                                    src="{{asset("storage/$user->profile")}}"
                                                    alt="profile">
                                            @else
                                                <img
                                                    src="{{asset("uploads/profile/profile.png")}}"
                                                    alt="profile">
                                            @endif

                                            @if($user->profile)
                                                <a href="{{route("dashboard.profile.delete")}}" class="delete-icon">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            @endif

                                            <label for="profile" class="upload-icon">
                                                <i class="fa fa-edit"></i>
                                                <input type="file" hidden name="profile" class="form-control"
                                                       id="profile"
                                                       accept=".jpeg, .jpg, .png">
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name*</label>
                                        <input type="text" name="first_name" class="form-control" id="first_name"
                                               maxlength="50" value="{{$user->first_name}}"
                                               required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" id="last_name"
                                               value="{{$user->last_name}}"
                                               maxlength="50">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email*</label>
                                        <input type="email" name="email" class="form-control" id="email" maxlength="50"
                                               value="{{$user->email}}"
                                               required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="mobile_number" class="form-label">Mobile Number*</label>
                                        <input type="text" name="mobile_number" class="form-control" id="mobile_number"
                                               maxlength="10" value="{{$user->mobile_number}}"
                                               required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password*</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                               maxlength="20">
                                        <small>One uppercase letter, one lowercase letter and special character</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm Password*</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                               id="password_confirmation" maxlength="20">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pan_card" class="form-label">Pan Card*</label>
                                        <input type="text" name="pan_card" class="form-control"
                                               id="pan_card" maxlength="10" value="{{$user->pan_card}}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="date_of_birth" class="form-label">Date of Birth*</label>
                                        <input type="date" name="date_of_birth" class="form-control"
                                               id="date_of_birth" min="{{$min_date_formatted}}"
                                               max="{{$max_date_formatted}}" value="{{$user->date_of_birth}}" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender*</label>
                                        <select name="gender" class="form-control" id="gender" required>
                                            <option value="" disabled selected>Select one</option>
                                            <option value="male" {{$user->gender == "male"?"selected":""}}>Male</option>
                                            <option value="female" {{$user->gender == "female"?"selected":""}}>Female
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea name="address" class="form-control" id="address"
                                                  maxlength="200">{{$user->address}}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="text-end">
                                        <button class="btn btn-primary">Save</button>
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
