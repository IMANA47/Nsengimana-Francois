<section id="certificates" class="section-block">
    <div class="container reveal">
        <div class="text-center mb-5">
            <h2 class="text-brand display-6 fw-bold">Certificates</h2>
            <p class="text-white">Mes certifications professionnelles</p>
        </div>
        <div class="row g-4">
            <?php $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $certificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <div class="card bg-dark border-secondary h-100 certificate-card">
                        <?php if($certificate->image_path): ?>
                            <img src="<?php echo e(asset('storage/' . $certificate->image_path)); ?>" class="card-img-top" alt="<?php echo e($certificate->name); ?>" style="height: 180px; object-fit: cover;">
                        <?php else: ?>
                            <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 180px;">
                                <i class="bi bi-award-fill text-brand fs-1"></i>
                            </div>
                        <?php endif; ?>
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold text-white"><?php echo e($certificate->name); ?></h5>
                            <p class="text-white mb-2"><?php echo e($certificate->organization); ?></p>
                            <?php if($certificate->issued_at): ?>
                                <p class="small text-white mb-3">
                                    <i class="bi bi-calendar me-1"></i><?php echo e(is_string($certificate->issued_at) ? \Carbon\Carbon::parse($certificate->issued_at)->format('F Y') : $certificate->issued_at->format('F Y')); ?>

                                </p>
                            <?php endif; ?>
                            <?php if($certificate->verification_url): ?>
                                <a class="btn btn-sm btn-brand" href="<?php echo e($certificate->verification_url); ?>" target="_blank">
                                    <i class="bi bi-link-45deg me-1"></i>Vérifier
                                </a>
                            <?php endif; ?>
                            <?php if($certificate->file_path): ?>
                                <a class="btn btn-sm btn-outline-light mt-2" href="<?php echo e(asset('storage/' . $certificate->file_path)); ?>" target="_blank">
                                    <i class="bi bi-file-earmark-pdf me-1"></i>Télécharger
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH I:\Imana\Project\Imana-47\portfolio\resources\views/sections/certificates.blade.php ENDPATH**/ ?>