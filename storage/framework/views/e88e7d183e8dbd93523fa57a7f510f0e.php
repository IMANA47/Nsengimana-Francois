<?php $__env->startSection('content'); ?>
    <h1 class="mb-4">Admin - Projects</h1>
    
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card bg-dark border-warning-subtle mb-4">
        <div class="card-header">
            <h5 class="mb-0">Ajouter un projet</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="<?php echo e(url('admin/projects')); ?>" enctype="multipart/form-data" class="row g-3">
                <?php echo csrf_field(); ?>
                <div class="col-md-6">
                    <label class="form-label text-warning">Titre *</label>
                    <input class="form-control bg-black text-white border-secondary" name="title" placeholder="Titre" value="<?php echo e(old('title')); ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-warning">Stack *</label>
                    <input class="form-control bg-black text-white border-secondary" name="stack" placeholder="Ex: Laravel, Vue, MySQL" value="<?php echo e(old('stack')); ?>" required>
                </div>
                <div class="col-12">
                    <label class="form-label text-warning">Description *</label>
                    <textarea class="form-control bg-black text-white border-secondary" name="description" placeholder="Description du projet" rows="3" required><?php echo e(old('description')); ?></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-warning">GitHub URL</label>
                    <input class="form-control bg-black text-white border-secondary" name="github_url" placeholder="https://github.com/..." value="<?php echo e(old('github_url')); ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label text-warning">Demo URL</label>
                    <input class="form-control bg-black text-white border-secondary" name="demo_url" placeholder="https://..." value="<?php echo e(old('demo_url')); ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label text-warning">Image</label>
                    <input class="form-control bg-black text-white border-secondary" name="image" type="file" accept="image/*">
                </div>
                <div class="col-md-6">
                    <label class="form-label text-warning">Featured</label>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1">
                        <label class="form-check-label">Mettre en avant</label>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-brand">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-dark table-striped">
        <tr><th>Titre</th><th>Stack</th><th>Actions</th></tr>
        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($project->title); ?></td>
                <td><?php echo e($project->stack); ?></td>
                <td>
                    <a href="<?php echo e(url('admin/projects/'.$project->id.'/edit')); ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                    <form method="POST" action="<?php echo e(url('admin/projects/'.$project->id)); ?>" class="d-inline">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
    <?php echo e($projects->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', ['title' => 'Admin Projects'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH I:\Imana\Project\Imana-47\portfolio\resources\views/admin/projects/index.blade.php ENDPATH**/ ?>