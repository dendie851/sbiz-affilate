<?php ob_start(); ?>
    <?php include_once 'addRead.php' ?>

    <form action="<?php echo $globalUrl ?>commission/addSave" method="post" id="validation-form" >
    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                  <div class="col-md-8">                                                      
                        <h4 class="font-weight-bold py-3 mb-0">Tambah Pencairan Komisi</h4>   
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dashboard"><i class="fa fa-home"></i></a></li> 
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>commission/index">Komisi</a></li>
                                <li class="breadcrumb-item">Tambah Pencairan</li>
                            </ol>
                        </div>                               
                  </div>
                  <div class="col-md-4" style="text-align:right; padding-top:30px; padding-right:20px; padding-bottom: 10px">
                        <button type="button" class="btn btn-default" onclick="window.location='<?php echo $globalUrl ?>commission/index'">Batal</button>                    
                        <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>    
            </div>      
                  
            <div class="row">
                    <div class="col-md-12">
                        <div class="card d-flex w-100 mb-4">
                            <div class="row no-gutters row-bordered row-border-light h-100">
                                <div class="d-flex col-md-12 align-items-center">                             
                                    <div class="card-body">  
                                        <h6 class="my-3"><i class="fa fa-university"></i> Rekening Pencairan</h6>
                                    <?php if(!$dataBank) : ?>                                        
                                        <div class="alert alert-dark-warning alert-dismissible fade show">
                                            Data rekening belum tersedia, silahkan lengkapi data rekening terlebih dahulu
                                        </div>
                                    <?php else: ?> 
                                        <input type="hidden" name="affiliateBankId" value="<?php echo $dataBank['id'] ?>">
                                        <div class="row mb-2">
                                            <div class="col-md-3 text-muted">Bank</div>
                                            <div class="col-md-9">
                                                <a href="javascript:void(0)" class="text-dark"><?php echo $dataBank['bank_name'] ?></a>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 text-muted">No Rekening</div>
                                            <div class="col-md-9">
                                                <a href="javascript:void(0)" class="text-dark"><?php echo $dataBank['account_number'] ?></a>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 text-muted">Atas Nama</div>
                                            <div class="col-md-9">
                                                <a href="javascript:void(0)" class="text-dark"><?php echo $dataBank['account_name'] ?></a>
                                            </div>
                                        </div>
                                    <?php endif; ?>                                        
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
                                <th width="5%" style="text-align: center"><b>PILIH</b></th>
                                <th width="5%" style="text-align: center"><b>NO</b></th>
                                <th style="text-align: center"><b>NO SALES ORDER</b></th>
                                <th style="text-align: center"><b>NAMA PEMBELI</b></th>
                                <th style="text-align: center"><b>TANGGAL ORDER</b></th>
                                <th style="text-align: center"><b>NILAI ORDER</b></th>
                                <th style="text-align: center"><b>KOMISI</b></th>
                            </tr>                                               
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php while($val = $data->fetch_array()): ?>
                                <tr style="cursor: pointer;">
                                    <td align="center">
                                        <input type="checkbox" class="chkOrder" name="salesOrderId[]" value="<?php echo $val['id'] ?>" data-fee="<?php echo $val['amount_fee_affiliate'] ?>">
                                    </td>
                                    <td align="center"><?php echo $i ?></td>
                                    <td><?php echo $val['no_order'] ?></td>
                                    <td><?php echo $val['name'] ?></td>
                                    <td align="center"><?php echo $val['date_order'] ?></td>
                                    <td align="right"><?php echo number_format($val['amount_sale'], 0, ',', '.') ?></td>
                                    <td align="right"><?php echo number_format($val['amount_fee_affiliate'], 0, ',', '.') ?></td>
                                </tr>
                            <?php $i++ ?>    
                            <?php endwhile; ?>                          
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6" style="text-align: right"><b>TOTAL PENCAIRAN</b></th>
                                <th style="text-align: right"><b><span id="totalKomisi">0</span></b></th>
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

        hitungTotalKomisi();

        $('.chkOrder').on('change', function() {
            hitungTotalKomisi();
        });
    });  

    function hitungTotalKomisi() {
        var total = 0;

        $('.chkOrder:checked').each(function() {
            total = total + parseFloat($(this).attr('data-fee'));
        });

        $('#totalKomisi').html(numberFormat(total));
    }

    function numberFormat(p) {
        var value = parseFloat(p);

        if(isNaN(value)) {
            value = 0;
        }

        return value.toFixed(0).replace(/\d(?=(\d{3})+$)/g, '$&.');
    }
</script>
<?php $embedCssJS = ob_get_contents(); ?>
<?php ob_end_clean(); ?>



<?php include_once 'app/template/main.php' ?>
