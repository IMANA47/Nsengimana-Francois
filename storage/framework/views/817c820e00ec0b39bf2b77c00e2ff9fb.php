<section id="skills" class="section-block">
    <div class="container reveal">
        <div class="text-center mb-5">
            <h2 class="text-brand display-6 fw-bold">Skills</h2>
            <p class="text-white">Mes compétences techniques</p>
        </div>
        <div class="row g-4">
            <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6">
                    <div class="card bg-dark border-secondary h-100">
                        <div class="card-body">
                            <h5 class="card-title text-brand mb-4">
                                <i class="bi bi-puzzle me-2"></i><?php echo e($category); ?>

                            </h5>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="text-white fw-bold"><?php echo e($skill->name); ?></span>
                                        <span class="text-brand fw-bold"><?php echo e($skill->proficiency); ?>%</span>
                                    </div>
                                    <div class="progress" style="height: 10px; background-color: #333;">
                                        <div class="progress-bar bg-brand" style="width: <?php echo e($skill->proficiency); ?>%"></div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH I:\Imana\Project\Imana-47\portfolio\resources\views/sections/skills.blade.php ENDPATH**/ ?>