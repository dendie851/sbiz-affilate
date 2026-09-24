<?php ob_start(); ?>      
    <?php include_once 'profileRead.php' ?>

    <form action="<?php echo $globalUrl ?>employee/editSave" method="post" id="validation-form" enctype="multipart/form-data" >
    <input type="hidden" name="id" value="<?php echo $data['id'] ?>">    
    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                  <div class="col-md-8">                                                      
                        <h4 class="font-weight-bold py-3 mb-0"> Profil </h4>   
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dashboard"><i class="fa fa-home"></i></a></li> 
                                <li class="breadcrumb-item">Profil </li>
                            </ol>
                        </div>                               
                  </div>
                  <div class="col-md-4" style="text-align:right; padding-top:30px; padding-right:20px; padding-bottom: 10px">
                        <!--
                        <button type="button" class="btn btn-primary" onclick="window.location='<?php echo $globalUrl ?>employee/index'">Kembali</button>  
                        -->                  
                  </div>    
            </div>      

            <div class="row">
                <div class="col">

                    <!-- Info -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-6">

                                    <h6 class="my-3"><i class="fa fa-user "></i> Profil</h6>

                                    <div class="row mb-2">
                                        <div class="col-md-5 text-muted">Nama</div>
                                        <div class="col-md-7">
                                            <a href="javascript:void(0)" class="text-dark"><?php echo $data['name'] ?></a>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-md-5 text-muted">No Handphone</div>
                                        <div class="col-md-7">
                                            <a href="javascript:void(0)" class="text-dark">
                                                <?php echo $data['country_code'] ?> <?php echo $data['phone_number'] ?>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-md-5 text-muted">Email</div>
                                        <div class="col-md-7">
                                            <a href="javascript:void(0)" class="text-dark">
                                                <?php echo $data['email'] ?>
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-2">
                                        <div class="col-md-5 text-muted">Kota</div>
                                        <div class="col-md-7">
                                            <a href="javascript:void(0)" class="text-dark">
                                                <?php echo $data['city'] ?>
                                            </a>
                                        </div>
                                    </div>   
                                    
                                    <div class="row mb-2">
                                        <div class="col-md-5 text-muted">Username</div>
                                        <div class="col-md-7">
                                            <a href="javascript:void(0)" class="text-dark">
                                               <?php echo $data['username'] ?>
                                            </a>
                                        </div>
                                    </div>                                    
                                </div>    
                            </div>    

                            </div>
                        </div>    
                    </div>
                    <!-- / Info -->
                </div>
            </div>
        <!-- [ content ] End -->
        </div>
    </div>     

   
<?php $templateContent = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php ob_start(); ?>
<script type="text/javascript">
    $(function() {
      $('.select2-demo').each(function() {
        $(this)
          .wrap('<div class="position-relative"></div>')
          .select2({
            placeholder: 'Select value',
            dropdownParent: $(this).parent()
          });
      })
    });        
</script>
<?php $embedCssJS = ob_get_contents(); ?>
<?php ob_end_clean(); ?>



<?php include_once 'app/template/main.php' ?>
