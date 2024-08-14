<nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{url("")}}">User Management System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            </ul>
            <div class="d-flex" role="search">
                @if(auth()->check())
                    <a href="{{route("dashboard.profile")}}" class="btn btn-outline-primary me-2">{{auth()->user()->name}}</a>
                    <a href="{{route("logout")}}" class="btn btn-outline-danger">Logout</a>
                @else
                    <a href="{{route("login")}}" class="btn btn-outline-primary me-2">Login</a>
                    <a href="{{route("register")}}" class="btn btn-outline-primary">Register</a>
                @endif
            </div>
        </div>
    </div>
</nav>
