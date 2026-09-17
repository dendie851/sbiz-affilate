<?php include_once 'indexRead.php' ?>

<?php ob_start(); ?>

<div class="layout-content">  
    <!-- [ content ] Start -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-0">Dashboard</h4>
        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dasboard"><i class="fa fa-home"></i></a></li> 
                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dashboard">Home</a></li>
                <li class="breadcrumb-item active">Dashboard    </li>
            </ol>
        </div>
    <div class="row">
        <!-- Staustic card 10 Start -->
        <div class="col-xl-3 col-md-6">
           <a href="<?php echo $globalUrl ?>salesPreOrder/index" /> 
           <div class="card bg-primary text-white ui-hover-icon mb-4 bg-pattern-3">
               <div class="card-body text-center">
                   <h2><?php echo $dataEmployeeMen['total'] ?> Orang</h2>
                   <h6 class="mb-0">Jumlah Karyawan Pria</h6>
                   <i class="fa fa-male hov-icon"></i>
               </div>
           </div>
           </a>
        </div>
        <div class="col-xl-3 col-md-6">
           <a href="<?php echo $globalUrl ?>salesOrder/index" /> 
           <div class="card bg-success text-white ui-hover-icon mb-4 bg-pattern-3">
               <div class="card-body text-center">
                   <h2><?php echo $dataEmployeeWomen['total'] ?> Orang</h2>
                   <h6 class="mb-0">Jumlah Karyawan Wanita</h6>
                   <i class="fa fa-female hov-icon"></i>
               </div>
           </div>
           </a>
        </div>
        <div class="col-xl-3 col-md-6">
           <a href="<?php echo $globalUrl ?>salesPayment/index" /> 
           <div class="card bg-danger text-white ui-hover-icon mb-4 bg-pattern-3">
               <div class="card-body text-center">
                   <h2><?php echo $dataAsset['total'] ?> Unit</h2>
                   <h6 class="mb-0">Jumlah Barang Asset</h6>
                   <i class="fa fa-laptop hov-icon"></i>
               </div>
           </div>
           </a>
        </div>
        <div class="col-xl-3 col-md-6">
           <a href="<?php echo $globalUrl ?>salesReceivable/index" /> 
           <div class="card bg-warning text-white ui-hover-icon mb-4 bg-pattern-3">
               <div class="card-body text-center">
                   <h2>Rp. <?php echo number_format($dataAssetNilai['total'],0,0,'.') ?></h2>
                   <h6 class="mb-0">Jumlah Nilai Asset</h6>
                   <i class="fa fa-laptop hov-icon"></i>
               </div>
           </div>
           </a>
        </div>
    </div>   

</div>    
<!-- [ Layout container ] End -->

<?php $templateContent = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php ob_start(); ?>
       

<?php $embedCssJS = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php include_once 'app/template/main.php' ?>
