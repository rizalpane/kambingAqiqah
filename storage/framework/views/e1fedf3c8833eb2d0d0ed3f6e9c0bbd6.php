<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'SiKambing - Admin Panel'); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
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

        .offcanvas-title h5 {
            color: white;
        }

        .nav-icon {
            color: #667eea;
            transition: all 0.3s ease;
        }

        .nav-icon:hover {
            color: #764ba2;
            transform: scale(1.1);
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
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
            color: white;
        }

        /* Notification Styles */
        .nav-icon {
            position: relative;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            font-size: 0.65rem;
            font-weight: 700;
            min-width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .notification-dropdown {
            width: 380px;
            max-height: 500px;
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            border-radius: 20px;
            overflow: hidden;
            margin-top: 10px;
        }

        .notification-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1rem 1.25rem;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification-header h6 {
            font-weight: 700;
            font-size: 1rem;
        }

        .notification-header .btn-link {
            padding: 0;
            font-size: 0.85rem;
            text-decoration: none;
        }

        .notification-body {
            max-height: 350px;
            overflow-y: auto;
            background: #f8f9fa;
        }

        .notification-item {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #e9ecef;
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            gap: 0.75rem;
            background: white;
        }

        .notification-item:hover {
            background: linear-gradient(135deg, #f0f4ff 0%, #f5f0ff 100%);
        }

        .notification-item.unread {
            background: linear-gradient(135deg, #eef2ff 0%, #f3f0ff 100%);
            border-left: 4px solid #667eea;
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .notification-content {
            flex: 1;
        }

        .notification-message {
            font-size: 0.9rem;
            color: #1f2937;
            margin-bottom: 0.25rem;
            font-weight: 500;
        }

        .notification-time {
            font-size: 0.8rem;
            color: #6b7280;
        }

        .notification-footer {
            padding: 0.75rem 1.25rem;
            background: white;
            border-top: 1px solid #e9ecef;
        }

        .notification-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .notification-footer a:hover {
            color: #764ba2;
        }

        .notification-empty {
            text-align: center;
            padding: 2rem 1.25rem;
            color: #9ca3af;
        }

        .notification-empty i {
            font-size: 3rem;
            margin-bottom: 0.5rem;
            display: block;
            opacity: 0.5;
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

            <div class="d-flex align-items-center gap-3">
                <!-- Order Notifications (Envelope) -->
                <div class="dropdown">
                    <a class="nav-icon position-relative" href="#" id="orderNotifications" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-envelope fs-4"></i>
                        <span class="notification-badge" id="orderBadge" style="display: none;"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="orderNotifications">
                        <div class="notification-header">
                            <h6 class="mb-0"><i class="bi bi-bag-check me-2"></i>Pesanan Masuk</h6>
                            <button class="btn btn-sm btn-link text-white" onclick="markAllAsRead('order')">Tandai Semua</button>
                        </div>
                        <div class="notification-body" id="orderNotificationsList">
                            <div class="text-center py-4">
                                <div class="spinner-border spinner-border-sm text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                        <div class="notification-footer">
                            <a href="<?php echo e(route('admin.order')); ?>" class="text-center d-block">Lihat Semua Pesanan</a>
                        </div>
                    </div>
                </div>

                <!-- System Notifications (Bell) -->
                <div class="dropdown">
                    <a class="nav-icon position-relative" href="#" id="systemNotifications" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-bell fs-4"></i>
                        <span class="notification-badge" id="systemBadge" style="display: none;"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="systemNotifications">
                        <div class="notification-header">
                            <h6 class="mb-0"><i class="bi bi-bell me-2"></i>Log Aktivitas</h6>
                            <button class="btn btn-sm btn-link text-white" onclick="markAllAsRead('system')">Tandai Semua</button>
                        </div>
                        <div class="notification-body" id="systemNotificationsList">
                            <div class="text-center py-4">
                                <div class="spinner-border spinner-border-sm text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                        <div class="notification-footer">
                            <a href="<?php echo e(route('admin.history')); ?>" class="text-center d-block">Lihat Riwayat</a>
                        </div>
                    </div>
                </div>

                <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">

                <div class="offcanvas-header">
                    <div class="offcanvas-title d-flex align-items-center">
                        <div class="brand-logo me-2">
                            <span class="brand-letter">K</span>
                        </div>
                        <h5 class="mb-0" id="offcanvasDarkNavbarLabel">Admin Panel</h5>
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
                        <form action="<?php echo e(route('auth.logout')); ?>" method="POST" class="w-100">
                            <?php echo csrf_field(); ?>
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
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <script>
        // Fetch Order Notifications
        function fetchOrderNotifications() {
            fetch('<?php echo e(route("admin.notifications.orders")); ?>')
                .then(response => response.json())
                .then(data => {
                    const list = document.getElementById('orderNotificationsList');
                    const badge = document.getElementById('orderBadge');
                    
                    if (data.unread_count > 0) {
                        badge.textContent = data.unread_count > 9 ? '9+' : data.unread_count;
                        badge.style.display = 'flex';
                    } else {
                        badge.style.display = 'none';
                    }
                    
                    if (data.notifications.length === 0) {
                        list.innerHTML = `
                            <div class="notification-empty">
                                <i class="bi bi-inbox"></i>
                                <p class="mb-0">Tidak ada notifikasi pesanan</p>
                            </div>
                        `;
                    } else {
                        list.innerHTML = data.notifications.map(notif => `
                            <div class="notification-item ${notif.is_read ? '' : 'unread'}" onclick="markAsReadAndRedirect(${notif.id}, '/admin/order')">
                                <div class="notification-icon">
                                    <i class="${notif.icon}"></i>
                                </div>
                                <div class="notification-content">
                                    <div class="notification-message">${notif.message}</div>
                                    <div class="notification-time">${notif.time}</div>
                                </div>
                            </div>
                        `).join('');
                    }
                })
                .catch(error => console.error('Error fetching order notifications:', error));
        }

        // Fetch System Notifications
        function fetchSystemNotifications() {
            fetch('<?php echo e(route("admin.notifications.system")); ?>')
                .then(response => response.json())
                .then(data => {
                    const list = document.getElementById('systemNotificationsList');
                    const badge = document.getElementById('systemBadge');
                    
                    if (data.unread_count > 0) {
                        badge.textContent = data.unread_count > 9 ? '9+' : data.unread_count;
                        badge.style.display = 'flex';
                    } else {
                        badge.style.display = 'none';
                    }
                    
                    if (data.notifications.length === 0) {
                        list.innerHTML = `
                            <div class="notification-empty">
                                <i class="bi bi-bell-slash"></i>
                                <p class="mb-0">Tidak ada log aktivitas</p>
                            </div>
                        `;
                    } else {
                        list.innerHTML = data.notifications.map(notif => `
                            <div class="notification-item ${notif.is_read ? '' : 'unread'}" onclick="markAsRead(${notif.id})">
                                <div class="notification-icon">
                                    <i class="${notif.icon}"></i>
                                </div>
                                <div class="notification-content">
                                    <div class="notification-message">${notif.message}</div>
                                    <div class="notification-time">${notif.time}</div>
                                </div>
                            </div>
                        `).join('');
                    }
                })
                .catch(error => console.error('Error fetching system notifications:', error));
        }

        // Mark single notification as read
        function markAsRead(id) {
            fetch('<?php echo e(route("admin.notifications.mark-read")); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({ id: id })
            }).then(() => {
                fetchOrderNotifications();
                fetchSystemNotifications();
            });
        }

        // Mark as read and redirect
        function markAsReadAndRedirect(id, url) {
            fetch('<?php echo e(route("admin.notifications.mark-read")); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({ id: id })
            }).then(() => {
                window.location.href = url;
            });
        }

        // Mark all as read
        function markAllAsRead(type) {
            fetch('<?php echo e(route("admin.notifications.mark-all-read")); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({ type: type })
            }).then(() => {
                if (type === 'order') {
                    fetchOrderNotifications();
                } else {
                    fetchSystemNotifications();
                }
            });
        }

        // Fetch notifications on dropdown show
        document.getElementById('orderNotifications').addEventListener('click', function(e) {
            e.preventDefault();
            fetchOrderNotifications();
        });

        document.getElementById('systemNotifications').addEventListener('click', function(e) {
            e.preventDefault();
            fetchSystemNotifications();
        });

        // Initial fetch and auto-refresh every 30 seconds
        fetchOrderNotifications();
        fetchSystemNotifications();
        setInterval(() => {
            fetchOrderNotifications();
            fetchSystemNotifications();
        }, 30000);
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>

</body>

</html><?php /**PATH C:\xampp\htdocs\laravelProject\resources\views/layouts/layoutAdmin.blade.php ENDPATH**/ ?>