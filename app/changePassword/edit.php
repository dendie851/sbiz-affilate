<?php ob_start(); ?>      
    <?php include_once 'editRead.php' ?>

    <form action="<?php echo $globalUrl ?>changePassword/editSave" method="post" id="validation-form" >
    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                  <div class="col-md-4">                                                      
                        <h4 class="font-weight-bold py-3 mb-0">Ubah Password</h4>   
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dashboard"><i class="fa fa-home"></i></a></li> 
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>changePassword/edit">Home</a></li>
                            </ol>
                        </div>                               
                  </div>
                  <div class="col-md-4" style="padding-top:30px;">&nbsp;</div>  

                  <div class="col-md-4" style="text-align:right; padding-top:30px; padding-right:20px; padding-bottom: 10px">
                        <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modals-edit">Simpan Password Baru</button>
                  </div>    
            </div>      

            <?php if(isset($_GET['msg'])): ?>    
                <?php if($_GET['msg'] == 'addSuccess'): ?>    
                    <div class="alert alert-dark-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="danger">×</button>
                        Data berhasil disimpan
                    </div>   
                <?php endif; ?>    

                <?php if($_GET['msg'] == 'addFailed'): ?>    
                    <div class="alert alert-dark-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="danger">×</button>
                        <?php echo base64_decode($_GET['messageError']) ?>
                    </div>   
                <?php endif; ?>    
            <?php endif; ?>

             
            <div class="row">
                    <div class="col-md-12">
                        <div class="card d-flex w-100 mb-4">
                                <div class="d-flex col-md-12 align-items-top">                             
                                    <div class="card-body">  
                                        <div class="form-group">
                                            <label class="form-label">Password Sekarang</label>
                                            <input required type="password" name="password" value="" class="form-control" >
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Password Baru</label>
                                            <input required type="password" name="newPassword" value=""  class="form-control" >
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Konfirmasi Password Baru</label>
                                            <input required type="password" name="confPassword" class="form-control">
                                        </div>
                                    </div> 
                                </div>    
                            </div>
                        </div>
                    </div>
            </div>
        <!-- [ content ] End -->
        </div>
    </div>  
    </form>   

   
<?php $templateContent = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php include_once 'app/template/main.php' ?>
