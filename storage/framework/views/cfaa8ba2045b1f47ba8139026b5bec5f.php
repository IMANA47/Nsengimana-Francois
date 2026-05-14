<?php $__env->startSection('content'); ?>
        <h1 class="mb-3">Dashboard Admin</h1>
        <div class="d-flex gap-2 flex-wrap">
            <a class="btn btn-warning" href="<?php echo e(url('admin/projects')); ?>">Gerer Projects</a>
            <a class="btn btn-warning" href="<?php echo e(url('admin/certificates')); ?>">Gerer Certificates</a>
            <a class="btn btn-warning" href="<?php echo e(url('admin/testimonials')); ?>">Gerer Testimonials</a>
            <a class="btn btn-outline-light" href="<?php echo e(route('messages.index')); ?>">Messages Contact</a>
            <a class="btn btn-outline-light" href="<?php echo e(route('home')); ?>">Voir le site</a>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', ['title' => 'Admin Dashboard'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH I:\Imana\Project\Imana-47\portfolio\resources\views/dashboard.blade.php ENDPATH**/ ?>