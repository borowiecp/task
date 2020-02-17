<header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
    <div class="col-4 offset-4 text-center">
        <a class="blog-header-logo text-dark" href="/">Home</a>
    </div>
    <div class="col-4 d-flex justify-content-end align-items-center">
        @auth
            <a class="btn btn-sm btn-outline-secondary" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <a class="btn btn-sm btn-outline-secondary" href="{{ route('login') }}">Login</a>
            <a class="btn btn-sm btn-outline-secondary ml-2" href="{{ route('register') }}">Register</a>
        @endauth
    </div>
    </div>
</header>