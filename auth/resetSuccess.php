<?php ob_start(); ?>
    <div class="authentication-wrapper authentication-2 ui-bg-cover ui-bg-overlay-container px-4">
        <div class="ui-bg-overlay bg-dark opacity-25"></div>

        <div class="authentication-inner py-12">

            <div class="card">
                <div class="p-6 p-sm-12">
                    <!-- [ Logo ] Start -->
                    <div class="d-flex justify-content-center align-items-center pb-2 mb-4">
                        <div class="ui-w-140" style="margin-bottom: 20px; padding-top: 20px">
                            <div class="w-100 position-relative">
                                <img src="<?php echo $config['app']['assets'] ?>img/logo.png" alt="Brand Logo" class="img-fluid">
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- [ Logo ] End -->

                    <h5 class="text-center text-muted font-weight-normal mb-4" style="margin-top: -30px; color: black">Password Baru</h5>

                    <div class="alert alert-dark-success alert-dismissible fade show" style="text-align: justify; padding: 20px">
                        Password baru anda telah berhasil di kirim ke email Anda <?php echo $email ?>                         
                    </div>                    
                </div>
                <div class="card-footer py-3 px-4 px-sm-5">
                    <div class="text-center text-muted">
                        <a href="<?php echo $globalUrl ?>">DIGIVO</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- / Content --> 

<?php $templateContent = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php include_once 'app/template/guest-register.php' ?>
