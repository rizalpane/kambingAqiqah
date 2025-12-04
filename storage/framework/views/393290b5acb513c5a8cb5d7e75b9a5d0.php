<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $__env->yieldContent('title', 'SiKambing - Layanan Aqiqah Terpercaya'); ?></title>
  <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
  <style>
    /* Navbar Styling */
    .navbar-custom {
      background: rgba(255, 255, 255, 0.98);
      backdrop-filter: blur(10px);
      box-shadow: 0 2px 20px rgba(0,0,0,0.1);
      padding: 15px 0;
      transition: all 0.3s ease;
    }

    .navbar-custom.scrolled {
      padding: 10px 0;
      box-shadow: 0 5px 30px rgba(0,0,0,0.15);
    }

    .navbar-brand {
      font-size: 1.8rem;
      font-weight: 800;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 10px;
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
      color: white;
      font-size: 1.5rem;
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
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .navbar-brand:hover .brand-logo {
      transform: rotate(-10deg) scale(1.1);
      box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .brand-text {
      font-size: 1.5rem;
      font-weight: 800;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .navbar-custom .nav-link {
      color: #2c3e50;
      font-weight: 600;
      padding: 8px 20px;
      margin: 0 5px;
      border-radius: 50px;
      transition: all 0.3s ease;
      position: relative;
    }

    .navbar-custom .nav-link::after {
      content: '';
      position: absolute;
      bottom: 5px;
      left: 50%;
      transform: translateX(-50%);
      width: 0;
      height: 2px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      transition: width 0.3s ease;
    }

    .navbar-custom .nav-link:hover::after,
    .navbar-custom .nav-link.active::after {
      width: 60%;
    }

    .navbar-custom .nav-link:hover {
      color: #667eea;
    }

    .navbar-custom .nav-link.active {
      color: #667eea;
      background: rgba(102, 126, 234, 0.1);
    }

    .btn-nav-login {
      padding: 10px 25px;
      font-weight: 600;
      background: transparent;
      color: #667eea;
      border: 2px solid #667eea;
      border-radius: 50px;
      transition: all 0.3s ease;
    }

    .btn-nav-login:hover {
      background: #667eea;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-nav-register {
      padding: 10px 25px;
      font-weight: 600;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: none;
      border-radius: 50px;
      transition: all 0.3s ease;
    }

    .btn-nav-register:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
      color: white;
    }

    /* Mobile Menu */
    @media (max-width: 991px) {
      .navbar-custom .nav-link {
        margin: 5px 0;
      }

      .navbar-collapse {
        padding: 20px 0;
      }

      .btn-nav-login,
      .btn-nav-register {
        width: 100%;
        margin: 5px 0;
      }
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand" href="/">
        <div class="brand-logo">
          <span class="brand-letter">K</span>
        </div>
        <span class="brand-text">SiKambing</span>
      </a>
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link <?php echo e(request()->is('/') ? 'active' : ''); ?>" href="/">
              <i class="bi bi-house-door me-1"></i>Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo e(request()->is('produk*') ? 'active' : ''); ?>" href="/produk">
              <i class="bi bi-basket me-1"></i>Produk
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo e(request()->is('kontak*') ? 'active' : ''); ?>" href="/kontak">
              <i class="bi bi-telephone me-1"></i>Kontak
            </a>
          </li>
        </ul>
        <div class="d-flex gap-2 flex-column flex-lg-row">
          <?php if(auth()->guard()->check()): ?>
            <?php if(auth()->user()->role === 'admin'): ?>
              <a class="btn btn-nav-register" href="<?php echo e(route('admin.dashboard')); ?>" role="button">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard Admin
              </a>
            <?php else: ?>
              <a class="btn btn-nav-register" href="<?php echo e(route('user.dashboard')); ?>" role="button">
                <i class="bi bi-house-door me-2"></i>Dashboard
              </a>
            <?php endif; ?>
          <?php else: ?>
          <a class="btn btn-nav-login" href="/login" role="button">
            <i class="bi bi-box-arrow-in-right me-2"></i>Login
          </a>
          <a class="btn btn-nav-register" href="/register" role="button">
            <i class="bi bi-person-plus me-2"></i>Register
          </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>

  <div style="padding-top: 80px;">
    <?php echo $__env->yieldContent('content'); ?>
  </div>

  <script>
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
      const navbar = document.querySelector('.navbar-custom');
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });
  </script>

</body>

</html><?php /**PATH C:\xampp\htdocs\laravelProject\resources\views/layouts/layoutMain.blade.php ENDPATH**/ ?>