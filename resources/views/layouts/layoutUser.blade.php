<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SiKambing - Dashboard User')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .navbar-custom {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(102, 126, 234, 0.1);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .brand-logo {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .brand-letter {
            font-size: 24px;
            font-weight: 800;
            color: white !important;
            line-height: 1;
        }

        .brand-text {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .offcanvas {
            height: 100vh !important;
        }

        .offcanvas-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .offcanvas-body {
            background: #f8f9fa;
            min-height: 100%;
        }

        .offcanvas-title h3 {
            color: white;
            margin: 0;
        }

        .nav-item.card {
            border: 2px solid transparent;
            transition: all 0.3s ease;
            background: white;
        }

        .nav-item.card:hover {
            border-color: #667eea;
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
        }

        .nav-link {
            color: #333;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #667eea;
        }

        .nav-link.active {
            color: #667eea;
        }

        .btn-logout {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            color: white;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <div class="brand-logo">
                    <span class="brand-letter">K</span>
                </div>
                <span class="brand-text">SiKambing</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">

                <div class="offcanvas-header">
                    <div class="offcanvas-title d-flex align-items-center">
                        <div class="brand-logo me-2">
                            <span class="brand-letter">K</span>
                        </div>
                        <h3 class="fs-3 mb-0">SiKambing</h3>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="offcanvas-body d-flex flex-column">
                    <ul class="navbar-nav justify-content-start pe-3">
                        <li class="nav-item p-3 card mb-3">
                            <a class="nav-link active" aria-current="page" href="/user/dashboard"> <i class="bi bi-columns-gap"></i> Dashboard</a>
                        </li>
                        <li class="nav-item p-3 card mb-3">
                            <a class="nav-link" href="/user/history"><i class="bi bi-clock-history"></i> Riwayat Transaksi</a>
                        </li>
                        <li class="nav-item p-3 card">
                            <a class="nav-link" href="/user/profile"><i class="bi bi-person-fill"></i> Profil</a>
                        </li>
                    </ul>
                    <div class="flex-grow-1"></div>
                    <div class="mt-3 w-100">
                        <form action="{{ route('auth.logout') }}" method="POST" class="w-100">
                            @csrf
                            <button type="submit" class="btn btn-logout w-100">
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