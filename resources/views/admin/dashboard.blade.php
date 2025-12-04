@extends('layouts.layoutAdmin')

@section('title', 'Admin Dashboard')

@section('content')

<style>
    .admin-dashboard {
        background: #f8f9fa;
        min-height: 100vh;
        padding: 2rem 0;
    }

    .hero-admin {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 3rem 2rem;
        border-radius: 25px;
        margin-bottom: 3rem;
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
    }

    .hero-admin::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .hero-admin::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
    }

    .hero-content {
        position: relative;
        z-index: 1;
    }

    .hero-title {
        color: white;
        font-weight: 900;
        font-size: 3rem;
        margin-bottom: 1rem;
        text-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        animation: fadeInUp 0.8s ease;
    }

    .hero-subtitle {
        color: rgba(255, 255, 255, 0.95);
        font-size: 1.3rem;
        font-weight: 600;
        margin: 0;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        animation: fadeInUp 1s ease;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
        padding: 0.8rem 1.5rem;
        border-radius: 30px;
        color: white;
        font-weight: 700;
        margin-top: 1.5rem;
        border: 2px solid rgba(255, 255, 255, 0.3);
        animation: fadeInUp 1.2s ease;
    }

    .hero-badge i {
        font-size: 1.3rem;
    }

    .btn-logout {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        color: white;
        font-weight: 700;
        padding: 0.8rem 1.8rem;
        border-radius: 30px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        margin-top: 1.5rem;
        margin-left: 1rem;
        text-decoration: none;
        animation: fadeInUp 1.4s ease;
    }

    .btn-logout:hover {
        background: rgba(255, 255, 255, 0.35);
        border-color: rgba(255, 255, 255, 0.5);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .section-title {
        color: #333;
        font-weight: 800;
        font-size: 1.8rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .section-title i {
        color: #667eea;
        font-size: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 2px solid transparent;
        text-decoration: none;
        display: block;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .stat-card:hover::before {
        transform: scaleX(1);
    }

    .stat-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.25);
        border-color: #667eea;
    }

    .stat-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
        position: relative;
        transition: all 0.3s ease;
    }

    .stat-card:hover .stat-icon {
        transform: rotate(10deg) scale(1.1);
    }

    .stat-icon-users {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.15) 0%, rgba(118, 75, 162, 0.15) 100%);
        color: #667eea;
    }

    .stat-icon-orders {
        background: linear-gradient(135deg, rgba(255, 193, 7, 0.15) 0%, rgba(255, 152, 0, 0.15) 100%);
        color: #ffc107;
    }

    .stat-icon-products {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.15) 0%, rgba(32, 201, 151, 0.15) 100%);
        color: #28a745;
    }

    .stat-icon-revenue {
        background: linear-gradient(135deg, rgba(220, 53, 69, 0.15) 0%, rgba(200, 35, 51, 0.15) 100%);
        color: #dc3545;
    }

    .stat-content {
        flex: 1;
    }

    .stat-label {
        color: #6c757d;
        font-weight: 600;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.8rem;
    }

    .stat-value {
        color: #333;
        font-weight: 800;
        font-size: 2.2rem;
        margin-bottom: 0.5rem;
        line-height: 1;
    }

    .stat-description {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .stat-arrow {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        margin-top: 1rem;
    }

    .stat-card:hover .stat-arrow {
        background: #667eea;
        color: white;
        transform: translateX(5px);
    }

    .quick-actions {
        margin-top: 3rem;
    }

    .action-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        text-align: center;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        text-decoration: none;
        display: block;
    }

    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
        border-color: #667eea;
    }

    .action-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 1rem;
        border-radius: 15px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
    }

    .action-title {
        color: #333;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }

    .action-desc {
        color: #6c757d;
        font-size: 0.9rem;
        margin: 0;
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }

        .hero-subtitle {
            font-size: 1rem;
        }

        .stat-value {
            font-size: 1.8rem;
        }

        .section-title {
            font-size: 1.4rem;
        }
    }
</style>

<div class="admin-dashboard">
    <div class="container">
        <!-- Hero Section -->
        <div class="hero-admin">
            <div class="hero-content">
                <h1 class="hero-title">
                    <i class="bi bi-speedometer2 me-3"></i>Hi, Admin!
                </h1>
                <p class="hero-subtitle">
                    Apakah Kamu Siap Melakukan Sesuatu Hari Ini?
                </p>
                <div class="hero-badge">
                    <i class="bi bi-calendar-check"></i>
                    <span id="realTimeClock">Loading...</span>
                </div>
                <a href="{{ route('auth.logout') }}" class="btn-logout" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <!-- Stats Overview Section -->
        <h2 class="section-title">
            <i class="bi bi-graph-up-arrow"></i>
            Overview Statistik
        </h2>

        <div class="row g-4 mb-5">
            <!-- Users Card -->
            <div class="col-lg-3 col-md-6">
                <a href="{{ route('admin.users.index') }}" class="stat-card">
                    <div class="stat-icon stat-icon-users">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Total Pengguna</div>
                        <div class="stat-value">{{ $totalUsers }}</div>
                        <div class="stat-description">
                            <i class="bi bi-person-check"></i>
                            Pengguna Terdaftar
                        </div>
                    </div>
                    <div class="stat-arrow">
                        <i class="bi bi-arrow-right"></i>
                    </div>
                </a>
            </div>

            <!-- Orders Card -->
            <div class="col-lg-3 col-md-6">
                <a href="{{ route('admin.order') }}" class="stat-card">
                    <div class="stat-icon stat-icon-orders">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Total Pesanan</div>
                        <div class="stat-value">{{ $totalOrders }}</div>
                        <div class="stat-description">
                            <i class="bi bi-cart-check"></i>
                            Pesanan Masuk
                        </div>
                    </div>
                    <div class="stat-arrow">
                        <i class="bi bi-arrow-right"></i>
                    </div>
                </a>
            </div>

            <!-- Products Card -->
            <div class="col-lg-3 col-md-6">
                <a href="{{ route('admin.products.index') }}" class="stat-card">
                    <div class="stat-icon stat-icon-products">
                        <i class="bi bi-cart4"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Total Produk</div>
                        <div class="stat-value">{{ $totalProducts }}</div>
                        <div class="stat-description">
                            <i class="bi bi-bag-check"></i>
                            Produk Tersedia
                        </div>
                    </div>
                    <div class="stat-arrow">
                        <i class="bi bi-arrow-right"></i>
                    </div>
                </a>
            </div>

            <!-- Revenue Card -->
            <div class="col-lg-3 col-md-6">
                <a href="{{ route('admin.history') }}" class="stat-card">
                    <div class="stat-icon stat-icon-revenue">
                        <i class="bi bi-credit-card-2-front"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Pendapatan</div>
                        <div class="stat-value" style="font-size: 1.5rem;">Rp {{ number_format($totalRevenue / 1000000, 1) }}Jt</div>
                        <div class="stat-description">
                            <i class="bi bi-cash-stack"></i>
                            Total Revenue
                        </div>
                    </div>
                    <div class="stat-arrow">
                        <i class="bi bi-arrow-right"></i>
                    </div>
                </a>
            </div>
        </div>

        <!-- Quick Actions Section -->
        <div class="quick-actions">
            <h2 class="section-title">
                <i class="bi bi-lightning-charge"></i>
                Quick Actions
            </h2>

            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('admin.products.create') }}" class="action-card">
                        <div class="action-icon">
                            <i class="bi bi-plus-circle"></i>
                        </div>
                        <div class="action-title">Tambah Produk</div>
                        <p class="action-desc">Tambahkan produk kambing baru</p>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('admin.order') }}" class="action-card">
                        <div class="action-icon">
                            <i class="bi bi-list-check"></i>
                        </div>
                        <div class="action-title">Kelola Pesanan</div>
                        <p class="action-desc">Kelola dan proses pesanan</p>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('admin.users.index') }}" class="action-card">
                        <div class="action-icon">
                            <i class="bi bi-person-gear"></i>
                        </div>
                        <div class="action-title">Kelola Pengguna</div>
                        <p class="action-desc">Lihat dan kelola pengguna</p>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('admin.setting') }}" class="action-card">
                        <div class="action-icon">
                            <i class="bi bi-gear"></i>
                        </div>
                        <div class="action-title">Pengaturan</div>
                        <p class="action-desc">Konfigurasi sistem</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Real-time clock with date and time (including seconds)
    function updateClock() {
        const now = new Date();
        
        // Day names in Indonesian
        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const dayName = days[now.getDay()];
        
        // Month names in Indonesian
        const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                       'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        const monthName = months[now.getMonth()];
        
        // Format date
        const date = now.getDate();
        const year = now.getFullYear();
        
        // Format time with leading zeros
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        
        // Combine all
        const formattedDateTime = `${dayName}, ${date} ${monthName} ${year} - ${hours}:${minutes}:${seconds}`;
        
        // Update the element
        document.getElementById('realTimeClock').textContent = formattedDateTime;
    }
    
    // Update clock immediately
    updateClock();
    
    // Update clock every second
    setInterval(updateClock, 1000);
</script>

@endsection