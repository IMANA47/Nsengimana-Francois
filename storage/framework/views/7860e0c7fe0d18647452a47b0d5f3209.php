<section id="projects" class="section-block">
    <div class="container reveal">
        <div class="text-center mb-5">
            <h2 class="text-brand display-6 fw-bold">Projects</h2>
            <p class="text-white">Mes réalisations récentes</p>
        </div>
        <div class="row g-4">
            <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 bg-dark text-white border-secondary shadow-lg project-card">
                        <?php if($project->image_path): ?>
                            <img src="<?php echo e(asset('storage/' . $project->image_path)); ?>" class="card-img-top project-image" alt="<?php echo e($project->title); ?>" style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                                <span class="text-white fs-1">📁</span>
                            </div>
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-white"><?php echo e($project->title); ?></h5>
                            <p class="small badge bg-brand text-dark mb-2"><?php echo e($project->stack); ?></p>
                            <p class="card-text text-white flex-grow-1"><?php echo e(\Illuminate\Support\Str::limit($project->description, 150)); ?></p>
                            <div class="mt-3 d-flex gap-2 flex-wrap">
                                <?php if($project->github_url): ?>
                                    <a href="<?php echo e($project->github_url); ?>" target="_blank" class="btn btn-sm btn-outline-light flex-grow-1">
                                        <i class="bi bi-github"></i> GitHub
                                    </a>
                                <?php endif; ?>
                                <?php if($project->demo_url): ?>
                                    <a href="<?php echo e($project->demo_url); ?>" target="_blank" class="btn btn-sm btn-brand flex-grow-1">
                                        <i class="bi bi-eye"></i> Demo
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH I:\Imana\Project\Imana-47\portfolio\resources\views/sections/projects.blade.php ENDPATH**/ ?>