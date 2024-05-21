<!-- resources/views/partials/header.blade.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Brand Name -->
        <a class="navbar-brand" href="{{ url('/') }}">
            BlogPoster
        </a>
          <div class="navbar-nav ml-auto">
            @auth
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('img/dbzprofile.webp') }}" class="profile-picture" alt="Profile Picture">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <p class="dropdown-item">{{auth()->user()->name}}</p>
                        <a class="dropdown-item" href="{{ url('/add-blog') }}">Add Blog</a>
                        <a class="dropdown-item" href="{{ url('/profile') }}">My Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Log Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            @else
                <a class="nav-link" >
                    <img src="{{ asset('img/dbzprofile.webp') }}" class="profile-picture" id="profilepiclogin" alt="Profile Picture">
                </a>
            @endauth
        </div>
    </div>
</nav>
