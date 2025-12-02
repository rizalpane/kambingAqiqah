<?php $__env->startSection('title', 'Halaman Dashboard User'); ?>

<?php $__env->startSection('content'); ?>

<div class="container mt-5 p-5 card">
    <div>
        <h3 class="mb-5 display-6">Produk Kami</h3>
    </div>
    <div class="row row-cols-1 row-cols-md-4 g-4 ">
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col">
                <div class="card p-3 h-100 d-flex flex-column">

                    <span class="badge bg-secondary w-25"><?php echo e($product->category); ?></span>

                    <?php if($product->image): ?>
                        <img src="<?php echo e(asset($product->image)); ?>" class="card-img-top" alt="<?php echo e($product->name); ?>" style="height: 200px; object-fit: cover;">
                    <?php else: ?>
                        <img src="<?php echo e(asset('images/goat.png')); ?>" class="card-img-top" alt="default">
                    <?php endif; ?>

                    <div class="card-body d-flex flex-column">

                        <!-- Bagian atas yang fleksibel -->
                        <div class="flex-grow-1">
                            <p class="card-title"><?php echo e($product->name); ?></p>
                            <p class="h6">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></p>
                        </div>

                        <!-- Bagian tombol -->
                        <div class="d-flex mb-2">
                            <a class="btn btn-primary btn-sm me-3" href="<?php echo e(route('user.checkout', $product->id)); ?>">Beli Sekarang</a>
                            <a class="btn btn-outline-primary btn-sm" href="#">Detail</a>
                        </div>

                        <!-- Bagian bawah tetap -->
                        <p class="mb-0"><small><?php echo e($product->location); ?></small></p>
                        <p class="text-secondary">Tersedia : <?php echo e($product->stock); ?> Ekor </p>

                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <div class="alert alert-info text-center" role="alert">
                    <p class="mb-0">Belum ada produk tersedia. Silakan kembali lagi nanti.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layoutUser', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelProject\resources\views/user/dashboard.blade.php ENDPATH**/ ?>