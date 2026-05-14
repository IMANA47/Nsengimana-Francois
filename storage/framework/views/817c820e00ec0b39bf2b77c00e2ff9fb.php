<section id="skills" class="section-block">
    <div class="container reveal">
        <div class="text-center mb-5">
            <h2 class="text-brand display-6 display-md-5 fw-bold">Skills</h2>
            <p class="text-white fs-5 fs-md-4">Mes compétences techniques</p>
        </div>
        <div class="row g-4 g-md-5">
            <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-6 col-lg-4">
                    <div class="card bg-dark border-secondary h-100 skill-card">
                        <div class="card-body p-4">
                            <h5 class="card-title text-brand mb-4 d-flex align-items-center">
                                <i class="bi bi-puzzle me-2 fs-5"></i>
                                <span class="skill-category"><?php echo e($category); ?></span>
                            </h5>
                            <div class="skills-list">
                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="skill-item mb-4">
                                        <div class="skill-header d-flex justify-content-between align-items-center mb-2">
                                            <span class="skill-name text-white fw-bold fs-6"><?php echo e($skill->name); ?></span>
                                            <span class="skill-percentage text-brand fw-bold fs-6"><?php echo e($skill->proficiency); ?>%</span>
                                        </div>
                                        <div class="skill-progress">
                                            <div class="progress" style="height: 8px; background-color: rgba(255, 255, 255, 0.1);">
                                                <div class="progress-bar bg-brand skill-progress-bar" style="width: <?php echo e($skill->proficiency); ?>%"></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH I:\Imana\Project\Imana-47\portfolio\resources\views/sections/skills.blade.php ENDPATH**/ ?>