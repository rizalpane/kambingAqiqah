<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | SiKambing</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
        }

        .error-container {
            text-align: center;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        .error-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 20s infinite ease-in-out;
        }

        .circle:nth-child(1) {
            width: 300px;
            height: 300px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .circle:nth-child(2) {
            width: 200px;
            height: 200px;
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .circle:nth-child(3) {
            width: 150px;
            height: 150px;
            bottom: 10%;
            left: 20%;
            animation-delay: 4s;
        }

        .circle:nth-child(4) {
            width: 250px;
            height: 250px;
            top: 30%;
            right: 10%;
            animation-delay: 1s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-50px) rotate(180deg);
            }
        }

        .error-code {
            font-size: 12rem;
            font-weight: 900;
            color: white;
            text-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            margin: 0;
            line-height: 1;
            animation: bounce 2s infinite;
            position: relative;
        }

        .error-code::before {
            content: '404';
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            color: rgba(255, 255, 255, 0.1);
            z-index: -1;
            animation: glitch 3s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-30px);
            }
            60% {
                transform: translateY(-15px);
            }
        }

        @keyframes glitch {
            0%, 100% {
                transform: translate(0);
            }
            20% {
                transform: translate(-5px, 5px);
            }
            40% {
                transform: translate(-5px, -5px);
            }
            60% {
                transform: translate(5px, 5px);
            }
            80% {
                transform: translate(5px, -5px);
            }
        }

        .error-icon {
            font-size: 8rem;
            color: white;
            margin-bottom: 2rem;
            animation: shake 3s infinite;
            display: inline-block;
        }

        @keyframes shake {
            0%, 100% {
                transform: rotate(0deg);
            }
            10%, 30%, 50%, 70%, 90% {
                transform: rotate(-10deg);
            }
            20%, 40%, 60%, 80% {
                transform: rotate(10deg);
            }
        }

        .error-title {
            font-size: 3rem;
            font-weight: 800;
            color: white;
            margin: 2rem 0 1rem 0;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 1s ease;
        }

        .error-message {
            font-size: 1.3rem;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 3rem;
            font-weight: 600;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1.2s ease;
        }

        .error-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUp 1.4s ease;
        }

        .btn-error {
            padding: 1.2rem 2.5rem;
            font-weight: 700;
            font-size: 1.1rem;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            border: none;
            cursor: pointer;
        }

        .btn-home {
            background: white;
            color: #667eea;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-home:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            color: #667eea;
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.35);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            color: white;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-suggestions {
            margin-top: 3rem;
            animation: fadeInUp 1.6s ease;
        }

        .error-suggestions h3 {
            color: white;
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
        }

        .suggestions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .suggestion-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 1.5rem;
            text-decoration: none;
            color: white;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .suggestion-card:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-5px);
            color: white;
        }

        .suggestion-card i {
            font-size: 2.5rem;
        }

        .suggestion-card span {
            font-weight: 700;
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .error-code {
                font-size: 8rem;
            }

            .error-icon {
                font-size: 5rem;
            }

            .error-title {
                font-size: 2rem;
            }

            .error-message {
                font-size: 1rem;
            }

            .btn-error {
                padding: 1rem 2rem;
                font-size: 1rem;
            }

            .suggestions-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Background Circles -->
    <div class="error-bg">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>

    <!-- Error Content -->
    <div class="error-container">
        <div class="error-icon">
            <i class="bi bi-emoji-frown"></i>
        </div>
        
        <h1 class="error-code">404</h1>
        
        <h2 class="error-title">Oops! Halaman Tidak Ditemukan</h2>
        
        <p class="error-message">
            Maaf, halaman yang Anda cari tidak dapat ditemukan. 
            Halaman mungkin telah dipindahkan atau tidak pernah ada.
        </p>

        <div class="error-buttons">
            <a href="/" class="btn-error btn-home">
                <i class="bi bi-house-door"></i>
                <span>Kembali ke Beranda</span>
            </a>
            <button onclick="history.back()" class="btn-error btn-back">
                <i class="bi bi-arrow-left"></i>
                <span>Halaman Sebelumnya</span>
            </button>
        </div>

        <!-- Suggestions -->
        <div class="error-suggestions">
            <h3>Atau kunjungi halaman lain:</h3>
            <div class="suggestions-grid">
                <a href="/" class="suggestion-card">
                    <i class="bi bi-house-door"></i>
                    <span>Beranda</span>
                </a>
                <a href="/produk" class="suggestion-card">
                    <i class="bi bi-basket"></i>
                    <span>Produk</span>
                </a>
                <a href="/kontak" class="suggestion-card">
                    <i class="bi bi-telephone"></i>
                    <span>Kontak</span>
                </a>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="suggestion-card">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="suggestion-card">
                            <i class="bi bi-person"></i>
                            <span>Dashboard</span>
                        </a>
                    @endif
                @else
                    <a href="/login" class="suggestion-card">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span>Login</span>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</body>
</html>
