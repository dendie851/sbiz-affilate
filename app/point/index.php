<?php ob_start(); ?>
    <?php include_once 'indexRead.php' ?>

    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                  <div class="col-md-8">                                                      
                        <h4 class="font-weight-bold py-3 mb-0">Point</h4>   
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dashboard"><i class="fa fa-home"></i></a></li> 
                                <li class="breadcrumb-item">Point</li>
                                <li class="breadcrumb-item">Daftar Penukaran</li>
                            </ol>
                        </div>                               
                  </div>
                  <div class="col-md-4" style="text-align:right; padding-top:30px; padding-right:20px; padding-bottom: 10px">
                        <button type="button" class="btn btn-primary" onclick="window.location='<?php echo $globalUrl ?>point/claim'">Tukar Poin</button>
                  </div>    
            </div>      

            <?php if(isset($_GET['msg'])): ?>   
                <?php if($_GET['msg'] == 'addSuccess'): ?>   
                    <div class="alert alert-dark-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        Data berhasil disimpan
                    </div>   
                <?php endif; ?>                                  
                <?php if($_GET['msg'] == 'cancelSuccess'): ?>   
                    <div class="alert alert-dark-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        Data berhasil dibatalkan
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
                                    </div> 
                                </div>
                            </div>
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
                                <th style="text-align: center"><b>NO PENUKARAN POIN</b></th>
                                <th style="text-align: center"><b>REWARD NAME</b></th>
                                <th style="text-align: center"><b>REWARD POINT </b></th>
                                <th style="text-align: center"><b>POINT DI TUKAR</b></th>
                                <th style="text-align: center"><b>KETERANGAN</b></th>
                                <th style="text-align: center"><b>STATUS KLAIM</b></th>
                                <th style="text-align: center"><b>RIWAYAT</b></th>
                                <th width="5%" style="text-align: center"></th>
                            </tr>                                               
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php while($val = $data->fetch_array()): ?>
                                <tr style="cursor: pointer;">
                                    <td align="center"><?php echo $i ?></td>
                                    <td><?php echo $val['no_point_claim'] ?></td>
                                    <td><?php echo $val['reward_name'] ?></td>
                                    <td><?php echo $val['points_price_reward'] ?></td>
                                    <td><?php echo $val['points_spent'] ?></td>
                                    <td><?php echo $val['notes'] ?></td>
                                    <td align="center">
                                        <b>
                                        <?php if($val['status_claim'] == '0'):  ?>
                                            PENGAJUAN
                                        <?php endif; ?>

                                        <?php if($val['status_claim'] == '1'):  ?>
                                            DI SETUJUI
                                        <?php endif; ?>

                                        <?php if($val['status_claim'] == '2'):  ?>
                                            PROSES PENYERAHAN
                                        <?php endif; ?>

                                        <?php if($val['status_claim'] == '3'):  ?>
                                            SELESAI
                                        <?php endif; ?>

                                        <?php if($val['status_claim'] == '4'):  ?>
                                            DI TOLAK
                                        <?php endif; ?>
                                        </b>
                                    </td>    
                                    <td>    
                                        <div style="font-size:8px">
                                            Tgl Pengajuan: <?php echo $val['date_request_frm'] ?><br/>
                                            Tgl Disetujui: <?php echo $val['date_approve_frm'] ?><br/>
                                            Tgl Proses Penyerahaan : <?php echo $val['date_process_frm'] ?><br/>
                                            Tgl Selesai : <?php echo $val['date_complete_frm'] ?><br/>
                                            Tgl Ditolak :<?php echo $val['date_reject'] ?>
                                        </div>
                                    </td>
                                    <td align="center" style="width: 50px; vertical-align: middle;" > 
                                        <?php if($val['status_claim'] == '0'):  ?>
                                            <i class="fa fa-times" style="font-size: 17px" title="Batal" onclick="cancelConfirm(<?php echo $val['id'] ?>)"></i>
                                        <?php endif; ?>
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

    function cancelConfirm(p) {
      bootbox.confirm({
        message: 'Anda yakin akan membatalkan penukaran poin ini ?',
        className: 'bootbox-xs',

        callback: function(result) {
            if(result) {
                window.location='<?php echo $globalUrl ?>point/cancel?id='+p;
            }    
        },
      });
    }    
</script>
<?php $embedCssJS = ob_get_contents(); ?>
<?php ob_end_clean(); ?>



<?php include_once 'app/template/main.php' ?>
