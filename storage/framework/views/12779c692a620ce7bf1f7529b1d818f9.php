<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($title ?? 'Admin'); ?> - Portfolio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css']); ?>
</head>
<body class="bg-dark text-white">
    <nav class="navbar navbar-dark sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand text-brand fw-bold" href="<?php echo e(route('dashboard')); ?>">
                <i class="bi bi-gear me-2"></i>Admin Panel
            </a>
            <div class="d-flex gap-2 flex-wrap">
                <a class="btn btn-brand btn-sm" href="<?php echo e(route('dashboard')); ?>">
                    <i class="bi bi-speedometer2 me-1"></i>Dashboard
                </a>
                <a class="btn btn-outline-light btn-sm" href="<?php echo e(url('admin/projects')); ?>">
                    <i class="bi bi-folder me-1"></i>Projects
                </a>
                <a class="btn btn-outline-light btn-sm" href="<?php echo e(url('admin/certificates')); ?>">
                    <i class="bi bi-award me-1"></i>Certificates
                </a>
                <a class="btn btn-outline-light btn-sm" href="<?php echo e(url('admin/testimonials')); ?>">
                    <i class="bi bi-chat-quote me-1"></i>Testimonials
                </a>
                <a class="btn btn-outline-light btn-sm" href="<?php echo e(route('messages.index')); ?>">
                    <i class="bi bi-envelope me-1"></i>Messages
                </a>
                <a class="btn btn-outline-light btn-sm" href="<?php echo e(route('home')); ?>">
                    <i class="bi bi-eye me-1"></i>Site
                </a>
                <form method="POST" action="<?php echo e(route('logout')); ?>" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH I:\Imana\Project\Imana-47\portfolio\resources\views/admin/layout.blade.php ENDPATH**/ ?>