<section id="contact" class="section-block">
    <div class="container reveal">
        <div class="text-center mb-5">
            <h2 class="text-brand display-6 display-md-5 fw-bold">Contact</h2>
            <p class="text-white fs-5 fs-md-4">Travaillons ensemble</p>
        </div>
        
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <div class="row g-4 g-md-5 align-items-stretch">
            <div class="col-lg-5 col-xl-4">
                <div class="contact-info">
                    <div class="card bg-dark border-secondary mb-4 contact-card">
                        <div class="card-body p-4">
                            <h5 class="card-title text-brand mb-4 d-flex align-items-center">
                                <i class="bi bi-envelope me-2 fs-5"></i>Contactez-moi
                            </h5>
                            <div class="contact-list">
                                <div class="contact-item mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-envelope text-brand me-3 fs-5 contact-icon"></i>
                                        <span class="text-white contact-text"><?php echo e(config('portfolio.profile.email')); ?></span>
                                    </div>
                                </div>
                                <div class="contact-item mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-geo-alt text-brand me-3 fs-5 contact-icon"></i>
                                        <span class="text-white contact-text">Brazzaville, République du Congo</span>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-telephone text-brand me-3 fs-5 contact-icon"></i>
                                        <span class="text-white contact-text">(+242) 06 948 51 54</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card bg-dark border-secondary mb-4 contact-card">
                        <div class="card-body p-4">
                            <h5 class="card-title text-brand mb-3 d-flex align-items-center">
                                <i class="bi bi-share me-2 fs-5"></i>Réseaux sociaux
                            </h5>
                            <div class="social-links d-flex flex-wrap gap-3">
                                <a href="https://www.linkedin.com/in/francois-nsengimana/" class="social-link text-white" aria-label="LinkedIn">
                                    <i class="bi bi-linkedin fs-4"></i>
                                </a>
                                <a href="https://github.com/IMANA47" class="social-link text-white" aria-label="GitHub">
                                    <i class="bi bi-github fs-4"></i>
                                </a>
                                <a href="https://www.youtube.com/@IMANA47" class="social-link text-white" aria-label="Youtube">
                                    <i class="bi bi-youtube fs-4"></i>
                                </a>
                                <a href="#" class="social-link text-white" aria-label="Facebook">
                                    <i class="bi bi-facebook fs-4"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card bg-dark border-secondary contact-card">
                        <div class="card-body p-4">
                            <h5 class="card-title text-brand mb-3 d-flex align-items-center">
                                <i class="bi bi-clock me-2 fs-5"></i>Disponibilité
                            </h5>
                            <p class="card-text text-white small availability-text">
                                Je suis disponible pour contribuer à divers besoins numériques et techniques.<br>
                                Je réponds généralement sous 48 heures.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-7 col-xl-8">
                <div class="contact-form-wrapper">
                    <div class="card bg-dark border-secondary">
                        <div class="card-body p-4 p-md-5">
                            <?php if($errors->any()): ?>
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            
                            <form method="POST" action="<?php echo e(route('contact.store')); ?>" class="contact-form">
                                <?php echo csrf_field(); ?>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label text-warning">Nom complet *</label>
                                            <input id="name" name="name" class="form-control" placeholder="Votre nom" value="<?php echo e(old('name')); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subject" class="form-label text-warning">Type de projet *</label>
                                            <input id="subject" name="subject" class="form-control" placeholder="Type de projet" value="<?php echo e(old('subject')); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="budget" class="form-label text-warning">Budget</label>
                                            <input id="budget" name="budget" class="form-control" placeholder="Budget estimé" value="<?php echo e(old('budget')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label text-warning">Email *</label>
                                            <input id="email" type="email" name="email" class="form-control" placeholder="Votre email" value="<?php echo e(old('email')); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="message" class="form-label text-warning">Message *</label>
                                            <textarea id="message" name="message" class="form-control" rows="5" placeholder="Votre message" required><?php echo e(old('message')); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-brand w-100 fw-bold btn-lg">
                                            <i class="bi bi-send me-2"></i>Envoyer
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><?php /**PATH I:\Imana\Project\Imana-47\portfolio\resources\views/sections/contact.blade.php ENDPATH**/ ?>