<?php ob_start(); ?>
    <?php include_once 'editBankRead.php' ?>

    <form action="<?php echo $globalUrl ?>profile/editBankSave" method="post" id="validation-form" >
    <input type="hidden" name="id" value="<?php echo $data['id'] ?>">        
    <div class="layout-content">
      <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                  <div class="col-md-4">                                                      
                        <h4 class="font-weight-bold py-3 mb-0">Rekening Bank</h4>   
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dashboard"><i class="fa fa-home"></i></a></li> 
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>profile/profile">Profil</a></li>
                                <li class="breadcrumb-item">Rekening Bank</li>
                            </ol>
                        </div>                               
                  </div>
                  <div class="col-md-4" style="padding-top:30px;">&nbsp;</div>
                  <div class="col-md-4" style="text-align:right; padding-top:30px; padding-right:20px; padding-bottom: 10px">
                        <button type="button" class="btn btn-default" onclick="window.location='<?php echo $globalUrl ?>profile/profile'">Batal</button>                    
                        <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>    
            </div>     

            <?php if(isset($_GET['msg'])): ?>    
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
                            <div class="row no-gutters row-bordered row-border-light h-100">
                                <div class="d-flex col-md-12 align-items-center">                             
                                    <div class="card-body">  
                                        <div class="form-group">
                                            <label class="form-label">Nama Bank</label> 
                                            <input name="bankName" required type="text" class="form-control" value="<?php echo isset($data['bank_name']) ? $data['bank_name'] : ''  ?>"  >
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Nama Pemilik Rekening</label>
                                            <input name="accountName" required type="text" class="form-control" value="<?php echo isset($data['account_name']) ? $data['account_name'] : ''  ?>"  >
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Nomor Rekening</label>
                                            <input name="accountNumber" required type="text" class="form-control" value="<?php echo isset($data['account_number']) ? $data['account_number'] : ''  ?>"  >
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

<?php $templateContent = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php include_once 'app/template/main.php' ?>
