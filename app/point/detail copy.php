<?php ob_start(); ?>
    <?php include_once 'detailRead.php' ?>

    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                  <div class="col-md-8">                                                      
                        <h4 class="font-weight-bold py-3 mb-0">Detail Komisi</h4>   
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dashboard"><i class="fa fa-home"></i></a></li> 
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>commission/index">Komisi</a></li>
                                <li class="breadcrumb-item">Detail Komisi</li>
                            </ol>
                        </div>                               
                  </div>
                  <div class="col-md-4" style="text-align:right; padding-top:30px; padding-right:20px; padding-bottom: 10px">
                        <button type="button" class="btn btn-default" onclick="window.location='<?php echo $globalUrl ?>commission/index'">Kembali</button>                    
                  </div>    
            </div>      


            <div class="row">
                    <div class="col-md-12">
                        <div class="card d-flex w-100 mb-4">
                            <div class="row no-gutters row-bordered row-border-light h-100">
                                <div class="d-flex col-md-12 align-items-center">                             
                                    <div class="card-body">  
                                        <h6 class="my-3"><i class="fa fa-coins"></i> Informasi Pencairan</h6>
                                        <div class="row mb-2">
                                            <div class="col-md-3 text-muted">No Pembayaran</div>
                                            <div class="col-md-9">
                                                <a href="javascript:void(0)" class="text-dark"><?php echo $data['no_payment'] ?></a>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 text-muted">Tanggal Transfer</div>
                                            <div class="col-md-9">
                                                <a href="javascript:void(0)" class="text-dark"><?php echo $data['date_transfer'] ?></a>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 text-muted">Tanggal Input</div>
                                            <div class="col-md-9">
                                                <a href="javascript:void(0)" class="text-dark"><?php echo $data['date_input'] ?></a>
                                            </div>
                                        </div>
                                         <div class="row mb-2">
                                            <div class="col-md-3 text-muted">PENGIRIM</div>
                                            <div class="col-md-9">
                                                <a href="javascript:void(0)" class="text-dark"><?php echo $data['from_bank'] ?></a>
                                            </div>
                                        </div>                                       
                                        <div class="row mb-2">
                                            <div class="col-md-3 text-muted">Bank Tujuan</div>
                                            <div class="col-md-9">
                                                <a href="javascript:void(0)" class="text-dark">
                                                    <?php echo $data['bank_name'] ?> - <?php echo $data['account_number'] ?> a/n <?php echo $data['account_name'] ?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 text-muted">Total Pencairan</div>
                                            <div class="col-md-9">
                                                <a href="javascript:void(0)" class="text-dark font-weight-bold"><?php echo number_format($data['total_withdraw'], 0, ',', '.') ?></a>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <?php if(mysqli_num_rows($dataDetail) < 1) : ?>
                    <div class="alert alert-dark-warning alert-dismissible fade show">
                        Belum ada data
                    </div>   
            <?php else: ?>    
                <div class="card">
                    <div class="card-datatable table-responsive" style="padding: 20px 10px 10px 10px">
                    <table  id="datatables" class="table table-striped table-bordered" data-toolbar="#bootstrap-table-toolbar" data-search="true" data-show-columns="true" data-show-export="true" data-detail-view="false" data-minimum-count-columns="3"
                        data-show-pagination-switch="false" data-pagination="true" data-id-field="id" >
                        <thead>
                            <tr>
                                <th width="5%" style="text-align: center"><b>NO</b></th>
                                <th style="text-align: center"><b>NO SALES ORDER</b></th>
                                <th style="text-align: center"><b>NAMA PEMBELI</b></th>
                                <th style="text-align: center"><b>TANGGAL ORDER</b></th>
                                <th style="text-align: center"><b>KOMISI</b></th>
                                <th width="5%" style="text-align: center"><b>DETAIL</b></th>
                            </tr>                                               
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php $totalFee = 0 ?>
                            <?php while($val = $dataDetail->fetch_array()): ?>
                                <tr style="cursor: pointer;">
                                    <td align="center"><?php echo $i ?></td>
                                    <td><a href="<?php echo $globalUrl ?>commission/print?salesOrderId=<?php echo $val['sales_order_id'] ?>">
                                        <?php echo $val['sales_order_number'] ?>
                                    </td>
                                    <td><?php echo $val['name'] ?></td>
                                    <td align="center"><?php echo $val['date_order'] ?></td>
                                    <td align="right"><?php echo number_format($val['amount_fee_affiliate'], 0, ',', '.') ?></td>
                                </tr>
                            <?php $totalFee = $totalFee + $val['amount_fee_affiliate'] ?>
                            <?php $i++ ?>    
                            <?php endwhile; ?>                          
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" style="text-align: right"><b>TOTAL</b></th>
                                <th style="text-align: right"><b><?php echo number_format($totalFee, 0, ',', '.') ?></b></th>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
            <?php endif; ?>    
        </div>    
    </div>     

<?php $templateContent = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php ob_start(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatables').DataTable({
            "paging": false,
            "searching": false
        });
    });  
</script>
<?php $embedCssJS = ob_get_contents(); ?>
<?php ob_end_clean(); ?>



<?php include_once 'app/template/main.php' ?>

