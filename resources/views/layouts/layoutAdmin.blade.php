<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel 10 App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <nav class="navbar navbar-light bg-light fixed-top">
        <div class="container ">
            <a class="navbar-brand" href="#"><img class="image-fluid" src="{{ asset('images/logo.png') }}" width="140" height="70" alt=""></a>

            <div class="d-flex">
                <div>
                    <a class="me-5" href="/"><i class="bi bi-envelope fs-4 text-secondary"></i></a>
                    <a class="me-5" href="/"><i class="bi bi-bell fs-4 text-secondary"></i></a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="offcanvas offcanvas-end text-bg-light" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">

                <div class="offcanvas-header">
                    <div class="offcanvas-title d-flex align-items-center">
                        <img class="image-fluid" src="{{ asset('images/logo.png') }}" width="140" height="70" alt="">
                        <div class="display-6">Sikambing</div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="offcanvas-body d-flex flex-column">
                    <ul class="navbar-nav justify-content-start pe-3">
                        <li class="nav-item p-3 card mb-3 btn-hover-light">
                            <a class="nav-link active" aria-current="page" href="/admin/dashboard"> <i class="bi bi-columns-gap"></i> Dashboard</a>
                        </li>
                        <li class="nav-item p-3 card mb-3 btn-hover-light">
                            <a class="nav-link" href="/admin/order"><i class="bi bi-file-earmark-spreadsheet"></i> Pesanan </a>
                        </li>
                        <li class="nav-item p-3 card mb-3 btn-hover-light">
                            <a class="nav-link" href="/admin/history"><i class="bi bi-clock-history"></i> Riwayat </a>
                        </li>
                        <li class="nav-item p-3 card mb-3 btn-hover-light">
                            <a class="nav-link" href="/admin/users"><i class="bi bi-people-fill"></i> Pengguna </a>
                        </li>
                        <li class="nav-item p-3 card btn-hover-light">
                            <a class="nav-link" href="/admin/setting"><i class="bi bi-gear"></i> Setting</a>
                        </li>
                    </ul>
                    <div class="flex-grow-1"></div>
                    <div class="mt-3 w-100">
                        <form action="{{ route('auth.logout') }}" method="POST" class="w-100">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger w-100 text-secondary btn-hover-light">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <main class="with-fixed-navbar">
        @yield('content')
    </main>

    @stack('scripts')

</body>

</html>