<?php ob_start(); ?>
    <?php include_once 'indexRead.php' ?>

    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                  <div class="col-md-8">                                                      
                        <h4 class="font-weight-bold py-3 mb-0">Penukaran Poin</h4>   
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dashboard"><i class="fa fa-home"></i></a></li> 
                                <li class="breadcrumb-item">Penukaran Komisi</li>
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
                                <th style="text-align: center"><b>NO PENUKARAN POIN</b></th>
                                <th style="text-align: center"><b>REWARD NAME</b></th>
                                <th style="text-align: center"><b>REWARD POINT </b></th>
                                <th style="text-align: center"><b>POINT DI TUKAR</b></th>
                                <th style="text-align: center"><b>KETERANGAN</b></th>
                                <th style="text-align: center"><b>STATUS KLAIM</b></th>
                                <th style="text-align: center"><b>RIWAYAT</b></th>
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
