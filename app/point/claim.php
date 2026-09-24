<?php ob_start(); ?>
    <?php include_once 'claimRead.php' ?>

    <!-- Tambahan CSS agar tabel responsif di mobile -->
    <style>
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    </style>

    <form action="<?php echo $globalUrl ?>point/claimSave" method="post" id="validation-form" >
    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                  <div class="col-md-8">                                        
                        <h4 class="font-weight-bold py-3 mb-0">Point</h4>   
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dashboard"><i class="fa fa-home"></i></a></li> 
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>point/index">Point</a></li>
                                <li class="breadcrumb-item">Klaim Point</li>
                            </ol>
                        </div>                               
                  </div>
                  <div class="col-md-4" style="text-align:right; padding-top:30px; padding-right:20px; padding-bottom: 10px">
                        <button type="button" class="btn btn-default" onclick="window.location='<?php echo $globalUrl ?>point/index'">Batal</button>                    
                        <button type="submit" class="btn btn-primary">Tukar Poin</button>
                  </div>    
            </div>      

            <?php if(isset($_GET['msg'])): ?>   
                <?php if($_GET['msg'] == 'claimFailed'): ?>   
                    <div class="alert alert-dark-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        Poin gagal ditukar, harga reward tidak valid atau sisa poin belum ditukar tidak mencukupi
                    </div>   
                <?php endif; ?>                                  
            <?php endif; ?>

            <div class="row">
                    <div class="col-md-12">
                        <div class="card d-flex w-100 mb-4">
                            <div class="row no-gutters row-bordered row-border-light h-100">
                                <div class="d-flex col-md-12 align-items-center">                             
                                    <div class="card-body">  
                                        <div class="row mb-2">
                                            <div class="col-md-3 text-muted">Total Poin Diperoleh</div>
                                            <div class="col-md-9">
                                                <b><?php echo number_format($dataPointInfo['total_point'], 0, ',', '.') ?> Poin</b>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 text-muted">Total Poin Ditukar</div>
                                            <div class="col-md-9">
                                                <b><?php echo number_format($dataPointInfo['total_spent'], 0, ',', '.') ?> Poin</b>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 text-muted">Poin Dalam Pengajuan</div>
                                            <div class="col-md-9">
                                                <b><?php echo number_format($dataPointInfo['total_pending'], 0, ',', '.') ?> Poin</b>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 text-muted">Sisa Poin Belum Ditukar</div>
                                            <div class="col-md-9">
                                                <b><?php echo number_format($dataPointInfo['sisa_point'], 0, ',', '.') ?> Poin</b>
                                            </div>
                                        </div>
  
                                        <hr/>
                                        <div class="row mb-2">
                                            <div class="col-md-3 text-muted">Pilih Reward</div>
                                            <div class="col-md-9">
                                                <select name="rewardId" id="rewardId" class="form-control" required>
                                                    <option value="" data-point="0">-- Pilih Reward --</option>
                                                    <?php while($cmb = $cmbReward->fetch_array()): ?>
                                                        <option value="<?php echo $cmb['id'] ?>" data-point="<?php echo (int) $cmb['points_required'] ?>"><?php echo $cmb['title'] ?> (<?php echo (int) $cmb['points_required'] ?> Poin)</option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 text-muted">Jumlah Poin Ditukar</div>
                                            <div class="col-md-9">
                                                <b id="pointsSpentInfo">0 Poin</b>
                                                <small class="text-muted d-block">Jumlah poin otomatis mengikuti harga reward yang dipilih (tidak dapat diubah)</small>
                                                <small class="text-muted d-block">Sisa poin belum ditukar: <b><?php echo number_format($dataPointInfo['sisa_point'], 0, ',', '.') ?></b> Poin</small>
                                                <div id="pointWarning" class="text-danger small mt-1" style="display:none"></div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 text-muted">Keterangan</div>
                                            <div class="col-md-9">
                                                <textarea name="notes" class="form-control" rows="3"></textarea>
                                            </div>
                                        </div>                                       
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <h6 class="font-weight-bold mb-3">Riwayat Poin</h6>

            <?php if(mysqli_num_rows($riwayat) < 1) : ?>
                    <div class="alert alert-dark-warning alert-dismissible fade show">
                        Belum ada data riwayat poin
                    </div>   
            <?php else: ?>    
                <div class="card">
                    <div class="card-datatable table-responsive" style="padding: 20px 10px 10px 10px">
                    <table  id="datatables" class="table table-striped table-bordered" data-toolbar="#bootstrap-table-toolbar" data-search="true" data-show-columns="true" data-show-export="true" data-detail-view="false" data-minimum-count-columns="3"
                        data-show-pagination-switch="false" data-pagination="true" data-id-field="id" >
                        <thead>
                            <tr>
                                <th width="5%" style="text-align: center"><b>NO</b></th>
                                <th style="text-align: center"><b>NO REFERENSI</b></th>
                                <th width="15%" style="text-align: center"><b>TANGGAL</b></th>
                                <th style="text-align: center"><b>KETERANGAN</b></th>
                                <th width="12%" style="text-align: center"><b>POIN MASUK</b></th>
                                <th width="12%" style="text-align: center"><b>POIN KELUAR</b></th>
                            </tr>                                               
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php while($val = $riwayat->fetch_array()): ?>
                                <tr style="cursor: pointer;">
                                    <td align="center"><?php echo $i ?></td>
                                    <td><?php echo $val['ref'] ?></td>
                                    <td align="center"><?php echo $val['date_frm'] ?></td>
                                    <td>
                                        <?php echo $val['ket'] ?>
                                        <?php if(strlen($val['notes']) > 0): ?>
                                            <div class="text-muted small"><?php echo $val['notes'] ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td align="right"><?php echo $val['point_in'] > 0 ? number_format($val['point_in'], 0, ',', '.') : '-' ?></td>
                                    <td align="right"><?php echo $val['point_out'] > 0 ? number_format($val['point_out'], 0, ',', '.') : '-' ?></td>
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
    </form>     

<?php $templateContent = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php ob_start(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatables').DataTable({
            "scrollX": true
        });
    });  

    // Sisa poin yang belum ditukarkan
    var sisaPoin = parseInt('<?php echo $dataPointInfo['sisa_point'] ?>') || 0;

    // Validasi sisi frontend: poin otomatis sebesar harga reward, hanya boleh dilakukan bila sisa poin mencukupi
    function validatePoint() {
        var rewardPoint = parseInt($('#rewardId option:selected').attr('data-point')) || 0;
        var warning = '';

        if(rewardPoint > 0) {
            $('#pointsSpentInfo').html(rewardPoint + ' Poin');
        } else {
            $('#pointsSpentInfo').html('0 Poin');
        }

        if(rewardPoint < 1) {
            warning = 'Silakan pilih reward terlebih dahulu';
        } else if(rewardPoint > sisaPoin) {
            warning = 'Sisa poin belum ditukar tidak mencukupi. Harga reward '+rewardPoint+' Poin, sisa poin '+sisaPoin+' Poin';
        }

        if(warning.length > 0) {
            $('#pointWarning').html(warning).show();
        } else {
            $('#pointWarning').html('').hide();
        }

        return warning.length < 1;
    }

    $(document).on('change', '#rewardId', function() {
        validatePoint();
    });

    $(document).on('submit', '#validation-form', function(e) {
        if(!validatePoint()) {
            e.preventDefault();
            alert($('#pointWarning').html());
            return false;
        }
    });

    $(document).ready(function() {
        validatePoint();
    });
</script>
<?php $embedCssJS = ob_get_contents(); ?>
<?php ob_end_clean(); ?>



<?php include_once 'app/template/main.php' ?>
