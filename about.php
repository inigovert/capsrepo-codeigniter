<div class="col-12">
    <!-- Full-Width Banner -->
    <div style="background-image: url('<?php echo validate_image($_settings->info('cover1')) ?>'); background-size: cover; background-position: center; height: 300px;">
        <div style="height: 100%; display: flex; justify-content: center; align-items: center; color: white; text-shadow: 1px 1px 5px rgba(0,0,0,0.7);">
           
        </div>
    </div>

    <!-- Main Content -->
    <div class="row my-5">
        <!-- About Section -->
        <div class="col-12">
            <div class="card rounded-0 card-outline card-warning shadow">
                <div class="card-body rounded-0">
                    <h2 class="text-center">About</h2>
                    <center><hr class="bg-navy border-navy w-25 border-2"></center>
                    <div>
                        <?= file_get_contents("about_us.html") ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Section -->
        <div class="col-12 mt-4">
            <div class="card card-outline card-warning rounded-0 shadow">
                <div class="card-header">
                    <h4 class="card-title">Contact</h4>
                </div>
                <div class="card-body rounded-0">
                    <dl>
                        <dt class="text-muted"><i class="fa fa-envelope"></i> Email</dt>
                        <dd class="pr-4"><?= $_settings->info('email') ?></dd>
                        <dt class="text-muted"><i class="fa fa-phone"></i> Contact #</dt>
                        <dd class="pr-4"><?= $_settings->info('contact') ?></dd>
                        <dt class="text-muted"><i class="fa fa-map-marked-alt"></i> Location</dt>
                        <dd class="pr-4"><?= $_settings->info('address') ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
