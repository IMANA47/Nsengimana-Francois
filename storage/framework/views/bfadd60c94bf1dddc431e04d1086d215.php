<section id="experience" class="section-block">
    <div class="container reveal">
        <div class="text-center mb-5">
            <h2 class="text-brand display-6 fw-bold">Experience</h2>
            <p class="text-white">Mon parcours professionnel</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php $__currentLoopData = $experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card bg-dark border-secondary mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="me-3">
                                    <div class="bg-brand rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="bi bi-briefcase-fill text-dark fs-5"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="card-title fw-bold text-white"><?php echo e($experience->role); ?></h5>
                                    <p class="text-brand mb-2"><?php echo e($experience->company); ?></p>
                                    <?php if($experience->start_date): ?>
                                        <p class="small text-white mb-2">
                                            <i class="bi bi-calendar me-1"></i><?php echo e(is_string($experience->start_date) ? \Carbon\Carbon::parse($experience->start_date)->format('F Y') : $experience->start_date->format('F Y')); ?>

                                            <?php if($experience->end_date): ?>
                                                - <?php echo e(is_string($experience->end_date) ? \Carbon\Carbon::parse($experience->end_date)->format('F Y') : $experience->end_date->format('F Y')); ?>

                                            <?php else: ?>
                                                - Présent
                                            <?php endif; ?>
                                        </p>
                                    <?php endif; ?>
                                    <p class="card-text text-white"><?php echo e($experience->summary); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php /**PATH I:\Imana\Project\Imana-47\portfolio\resources\views/sections/experience.blade.php ENDPATH**/ ?>