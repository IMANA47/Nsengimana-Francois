<section id="testimonials" class="section-block">
    <div class="container reveal">
        <div class="text-center mb-5">
            <h2 class="text-brand display-6 fw-bold">Testimonials</h2>
            <p class="text-white">Ce que mes clients disent</p>
        </div>
        <div class="row g-4">
            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6">
                    <div class="card bg-dark border-secondary h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="bi bi-quote text-brand fs-2"></i>
                            </div>
                            <p class="card-text text-white fst-italic">"<?php echo e($testimonial->content); ?>"</p>
                            <div class="mt-4">
                                <h6 class="fw-bold text-white"><?php echo e($testimonial->client_name); ?></h6>
                                <p class="small text-brand mb-0"><?php echo e($testimonial->client_role); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH I:\Imana\Project\Imana-47\portfolio\resources\views/sections/testimonials.blade.php ENDPATH**/ ?>