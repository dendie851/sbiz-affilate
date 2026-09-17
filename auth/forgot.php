<?php ob_start(); ?>
    <!-- [ Content ] Start -->
    <div class="authentication-wrapper authentication-2 ui-bg-cover ui-bg-overlay-container px-4" >
        <div class="ui-bg-overlay bg-dark opacity-25"></div>
        <div class="authentication-inner py-5">

            <!-- [ Form ] Start -->
            <form class="card" action="<?php echo $globalUrl ?>auth/forgotSave" method="post">
                <input type="hidden" name="token" value="<?php echo auth::token() ?>">
                <div class="p-4 p-sm-5">
                    <!-- [ Logo ] Start -->
                    <div class="d-flex justify-content-center align-items-center pb-2 mb-4">
                        <div class="ui-w-140">
                            <div class="w-100 position-relative">
                                <img src="<?php echo $config['app']['assets'] ?>img/logo.png" alt="Brand Logo" class="img-fluid">
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <?php if(isset($msgError['email'])) : ?>
                        <div class="alert alert-dark-danger alert-dismissible fade show" style="height: 50px; padding: 5px; padding-top: 12px; text-align: center; border-radius: 10px">
                            <?php echo $msgError['email'] ?>
                        </div>
                    <?php endif ?>

                    <!-- [ Logo ] End -->
                    <h5 class="text-center text-muted font-weight-normal mb-4">Reset Password Anda</h5>
                    <hr class="mt-0 mb-4">
                    <p>Silakan masukan email Anda, dan kami akan reset Password Anda</p>
                    <div class="form-group">

                        <input name="email" required type="text" class="form-control" placeholder="Masukan email Anda">
                        <div class="clearfix"></div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Reset Password ke Email</button>
                </div>

                    <div class="card-footer py-3 px-4 px-sm-5">
                        <div class="text-center text-muted">
                            Belum memiliki account ?
                            <a href="<?php echo $globalUrl ?>">Registrasi</a>
                        </div>
                    </div>                    

            </form>
            <!-- [ Form ] End -->

        </div>
    </div>
    <!-- / Content -->

<?php $templateContent = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php include_once 'app/template/guest-register.php' ?>
