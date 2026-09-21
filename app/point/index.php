<?php ob_start(); ?>
    <?php include_once 'indexRead.php' ?>

    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                  <div class="col-md-8">                                                      
                        <h4 class="font-weight-bold py-3 mb-0">Komisi</h4>   
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dashboard"><i class="fa fa-home"></i></a></li> 
                                <li class="breadcrumb-item">Komisi</li>
                            </ol>
                        </div>                               
                  </div>
            </div>      

            <?php if(mysqli_num_rows($data) < 1) : ?>
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
                                <th style="text-align: center"><b>NO PEMBAYARAN</b></th>
                                <th style="text-align: center"><b>TANGGAL TRANSFER</b></th>
                                <th style="text-align: center"><b>BANK PENGIRIM</b></th>
                                <th style="text-align: center"><b>BANK TUJUAN</b></th>
                                <th style="text-align: center"><b>TOTAL PENCAIRAN</b></th>
                                <th width="10%" style="text-align: center"></th>
                            </tr>                                               
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php while($val = $data->fetch_array()): ?>
                                <tr style="cursor: pointer;">
                                    <td align="center"><?php echo $i ?></td>
                                    <td><?php echo $val['no_payment'] ?></td>
                                    <td align="center"><?php echo $val['date_transfer'] ?></td>
                                    <td><?php echo $val['from_bank'] ?></td>
                                    <td><?php echo $val['bank_name'] ?></td>
                                    <td align="right"><?php echo number_format($val['total_withdraw'], 0, ',', '.') ?></td>
                                    <td align="center" style="width: 50px; vertical-align: middle;" > 
									    <i  class="fa fa-eye" style="font-size: 17px" onclick="window.location='<?php echo $globalUrl ?>commission/detail?id=<?php echo $val['id'] ?>'"></i>		                            
									</td>                                    
                                </tr>
                            <?php $i++ ?>    
                            <?php endwhile; ?>                          
                        </tbody>
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
            lengthMenu: [
                [ 50, 100, 200, -1 ],
                [ '50 Data', '100 Data', '200 Data', 'Tampilkan Semua' ]
            ], 
        }               
        );
    });  
</script>
<?php $embedCssJS = ob_get_contents(); ?>
<?php ob_end_clean(); ?>



<?php include_once 'app/template/main.php' ?>
