<?php $__env->startSection('content'); ?>
<h1>Messages de contact</h1>
<table class="table table-dark table-striped">
<tr><th>Nom</th><th>Email</th><th>Sujet</th><th>Message</th></tr>
<?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr><td><?php echo e($message->name); ?></td><td><?php echo e($message->email); ?></td><td><?php echo e($message->subject); ?></td><td><?php echo e($message->message); ?></td></tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
<?php echo e($messages->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', ['title' => 'Messages'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH I:\Imana\Project\Imana-47\portfolio\resources\views/admin/messages/index.blade.php ENDPATH**/ ?>