<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SiKambing - Aqiqah Terpercaya')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .navbar-custom {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(102, 126, 234, 0.1);
            padding: 1rem 0;
            position: relative;
            z-index: 10;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            position: relative;
            z-index: 20;
            cursor: pointer;
            text-decoration: none;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
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
            transition: all 0.3s ease;
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
    </style>
</head>

<body>

    <nav class="navbar navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <div class="brand-logo">
                    <span class="brand-letter">K</span>
                </div>
                <span class="brand-text">SiKambing</span>
            </a>
        </div>
    </nav>


    @yield('content')

</body>

</html>