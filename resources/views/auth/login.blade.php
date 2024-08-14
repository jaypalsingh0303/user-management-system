@extends('layouts.app')

@section('title')
    Login
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
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

                        <form action="{{route("login-submit")}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email*</label>
                                <input type="email" name="email" class="form-control" id="email"
                                       maxlength="50" value="{{old("email")}}"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password*</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" value="true"
                                           id="remember">
                                    <label class="form-check-label" for="remember">
                                        Remember me
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="text-end">
                                    <button class="btn btn-primary">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
