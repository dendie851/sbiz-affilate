<?php ob_start(); ?>
    <?php include_once 'indexRead.php' ?>

    <?php
        $totalOrder          = isset($dataSaleSummary['total_order']) ? (int) $dataSaleSummary['total_order'] : 0;
        $totalSale           = isset($dataSaleSummary['total_sale']) ? (float) $dataSaleSummary['total_sale'] : 0;
        $totalOrderComplete  = isset($dataSaleComplete['total_order_complete']) ? (int) $dataSaleComplete['total_order_complete'] : 0;
        $totalSaleComplete   = isset($dataSaleComplete['total_sale_complete']) ? (float) $dataSaleComplete['total_sale_complete'] : 0;

        $statusOrderLabel = array('0' => 'ORDER BARU', '1' => 'DIPROSES', '2' => 'DIKIRIM', '3' => 'SELESAI', '4' => 'DIBATALKAN');
        $statusClaimLabel = array('0' => 'PENGAJUAN', '1' => 'DI SETUJUI', '2' => 'PROSES PENYERAHAN', '3' => 'SELESAI', '4' => 'DI TOLAK');
    ?>

<div class="layout-content">  
    <!-- [ content ] Start -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-0">Dashboard Affiliator</h4>
        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dashboard"><i class="fa fa-home"></i></a></li> 
                <li class="breadcrumb-item active">Dashboard </li>
            </ol>
        </div>

        <?php if($dataDashboardInfo['is_bank_exist'] == '0'): ?>
            <div class="alert alert-dark-warning alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">×</button>
                Data rekening bank belum diisi, lengkapi terlebih dahulu agar komisi dapat dicairkan.
                <a href="<?php echo $globalUrl ?>profile/editBank" class="alert-link">Isi Rekening Bank</a>
            </div>
        <?php endif; ?>

    <div class="row">
        <!-- Staustic card 10 Start -->
        <div class="col-xl-3 col-md-6">
           <a href="<?php echo $globalUrl ?>home/salesSummary" /> 
           <div class="card bg-primary text-white ui-hover-icon mb-4 bg-pattern-3">
               <div class="card-body text-center">
                   <h2><?php echo number_format($totalOrder, 0, ',', '.') ?></h2>
                   <h6 class="mb-0">Total Order</h6>
                   <i class="fa fa-shopping-cart hov-icon"></i>
               </div>
           </div>
           </a>
        </div>
        <div class="col-xl-3 col-md-6">
           <a href="<?php echo $globalUrl ?>home/salesSummary" /> 
           <div class="card bg-success text-white ui-hover-icon mb-4 bg-pattern-3">
               <div class="card-body text-center">
                   <h2><?php echo number_format($totalSale, 0, ',', '.') ?></h2>
                   <h6 class="mb-0">Total Nilai Penjualan</h6>
                   <i class="fa fa-line-chart hov-icon"></i>
               </div>
           </div>
           </a>
        </div>
        <div class="col-xl-3 col-md-6">
           <a href="<?php echo $globalUrl ?>home/commissionSummary" /> 
           <div class="card bg-danger text-white ui-hover-icon mb-4 bg-pattern-3">
               <div class="card-body text-center">
                   <h2><?php echo number_format($dataCommissionInfo['total_earned'], 0, ',', '.') ?></h2>
                   <h6 class="mb-0">Total Komisi Diperoleh</h6>
                   <i class="fa fa-coins hov-icon"></i>
               </div>
           </div>
           </a>
        </div>
        <div class="col-xl-3 col-md-6">
           <a href="<?php echo $globalUrl ?>home/pointSummary" /> 
           <div class="card bg-warning text-white ui-hover-icon mb-4 bg-pattern-3">
               <div class="card-body text-center">
                   <h2><?php echo number_format($dataPointInfo['sisa_point'], 0, ',', '.') ?></h2>
                   <h6 class="mb-0">Sisa Point</h6>
                   <i class="fa fa-star hov-icon"></i>
               </div>
           </div>
           </a>
        </div>
    </div>   

    <div class="row">
        <div class="col-xl-3 col-md-6">
           <a href="<?php echo $globalUrl ?>home/salesSummary" /> 
           <div class="card mb-4">
               <div class="card-body">
                   <div class="d-flex justify-content-between">
                       <div>
                           <div class="text-muted small">Order Selesai</div>
                           <div class="text-large font-weight-bold"><?php echo number_format($totalOrderComplete, 0, ',', '.') ?></div>
                       </div>
                       <i class="fa fa-check-circle text-success" style="font-size: 28px"></i>
                   </div>
               </div>
           </div>
           </a>
        </div>
        <div class="col-xl-3 col-md-6">
           <a href="<?php echo $globalUrl ?>home/salesSummary" /> 
           <div class="card mb-4">
               <div class="card-body">
                   <div class="d-flex justify-content-between">
                       <div>
                           <div class="text-muted small">Nilai Penjualan Selesai</div>
                           <div class="text-large font-weight-bold"><?php echo number_format($totalSaleComplete, 0, ',', '.') ?></div>
                       </div>
                       <i class="fa fa-money text-primary" style="font-size: 28px"></i>
                   </div>
               </div>
           </div>
           </a>
        </div>
        <div class="col-xl-3 col-md-6">
           <a href="<?php echo $globalUrl ?>home/commissionSummary" /> 
           <div class="card mb-4">
               <div class="card-body">
                   <div class="d-flex justify-content-between">
                       <div>
                           <div class="text-muted small">Komisi Sudah Dicairkan</div>
                           <div class="text-large font-weight-bold"><?php echo number_format($dataCommissionInfo['total_withdraw_amount'], 0, ',', '.') ?></div>
                       </div>
                       <i class="fa fa-bank text-info" style="font-size: 28px"></i>
                   </div>
               </div>
           </div>
           </a>
        </div>
        <div class="col-xl-3 col-md-6">
           <a href="<?php echo $globalUrl ?>home/productSummary" /> 
           <div class="card mb-4">
               <div class="card-body">
                   <div class="d-flex justify-content-between">
                       <div>
                           <div class="text-muted small">Produk Dipromosikan</div>
                           <div class="text-large font-weight-bold"><?php echo number_format($dataDashboardInfo['total_product'], 0, ',', '.') ?></div>
                       </div>
                       <i class="fa fa-cubes text-warning" style="font-size: 28px"></i>
                   </div>
               </div>
           </div>
           </a>
        </div>
    </div>

    <div class="row">
        <!-- Ringkasan Point -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="my-3"><i class="fa fa-star"></i> Ringkasan Point</h6>
                    <div class="row mb-2">
                        <div class="col-md-7 text-muted">Total Point Diperoleh</div>
                        <div class="col-md-5 text-right"><b><?php echo number_format($dataPointInfo['total_point'], 0, ',', '.') ?> Point</b></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-7 text-muted">Total Point Ditukar</div>
                        <div class="col-md-5 text-right"><b><?php echo number_format($dataPointInfo['total_spent'], 0, ',', '.') ?> Point</b></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-7 text-muted">Point Dalam Pengajuan</div>
                        <div class="col-md-5 text-right"><b><?php echo number_format($dataPointInfo['total_pending'], 0, ',', '.') ?> Point</b></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-7 text-muted">Sisa Point</div>
                        <div class="col-md-5 text-right"><b><?php echo number_format($dataPointInfo['sisa_point'], 0, ',', '.') ?> Point</b></div>
                    </div>
                    <div class="row" style="text-align:right">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-outline-primary" onclick="window.location='<?php echo $globalUrl ?>point/index'">Lihat Point</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ringkasan Komisi -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="my-3"><i class="fa fa-coins"></i> Ringkasan Komisi</h6>
                    <div class="row mb-2">
                        <div class="col-md-7 text-muted">Total Komisi Diperoleh</div>
                        <div class="col-md-5 text-right"><b><?php echo number_format($dataCommissionInfo['total_earned'], 0, ',', '.') ?></b></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-7 text-muted">Total Pencairan</div>
                        <div class="col-md-5 text-right"><b><?php echo number_format($dataCommissionInfo['total_withdraw_amount'], 0, ',', '.') ?></b></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-7 text-muted">Jumlah Pencairan</div>
                        <div class="col-md-5 text-right"><b><?php echo number_format($dataCommissionInfo['total_withdraw'], 0, ',', '.') ?> Kali</b></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-7 text-muted">Saldo Komisi</div>
                        <div class="col-md-5 text-right"><b><?php echo number_format($dataCommissionInfo['balance'], 0, ',', '.') ?></b></div>
                    </div>
                    <div class="row" style="text-align:right">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-outline-primary" onclick="window.location='<?php echo $globalUrl ?>commission/index'">Lihat Komisi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Penjualan Terakhir -->
    <div class="card mb-4">
        <div class="card-body">
            <h6 class="my-3"><i class="fa fa-shopping-cart"></i> 5 Penjualan Terakhir</h6>

            <?php if(mysqli_num_rows($dataLastOrder) < 1) : ?>
                <div class="alert alert-dark-warning alert-dismissible fade show">
                    Belum ada data penjualan
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="5%" style="text-align: center"><b>NO</b></th>
                                <th style="text-align: center"><b>NO ORDER</b></th>
                                <th style="text-align: center"><b>NAMA PEMBELI</b></th>
                                <th style="text-align: center"><b>TANGGAL ORDER</b></th>
                                <th style="text-align: center"><b>NILAI PENJUALAN</b></th>
                                <th style="text-align: center"><b>KOMISI</b></th>
                                <th width="12%" style="text-align: center"><b>STATUS</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php while($val = $dataLastOrder->fetch_array()): ?>
                                <tr style="cursor: pointer;">
                                    <td align="center"><?php echo $i ?></td>
                                    <td><?php echo $val['no_order'] ?></td>
                                    <td><?php echo $val['name'] ?></td>
                                    <td align="center"><?php echo $val['date_order'] ?></td>
                                    <td align="right"><?php echo number_format($val['amount_sale'], 0, ',', '.') ?></td>
                                    <td align="right"><?php echo number_format($val['amount_fee_affiliate'], 0, ',', '.') ?></td>
                                    <td align="center"><?php echo isset($statusOrderLabel[$val['status_order']]) ? $statusOrderLabel[$val['status_order']] : '-' ?></td>
                                </tr>
                            <?php $i++ ?>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <div class="row" style="text-align:right">
                <div class="col-md-12">
                    <button type="button" class="btn btn-outline-primary" onclick="window.location='<?php echo $globalUrl ?>salesOrder/index'">Lihat Semua Penjualan</button>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- [ content ] End -->
</div>
<!-- [ Layout container ] End -->

<?php $templateContent = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php ob_start(); ?>
       

<?php $embedCssJS = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php include_once 'app/template/main.php' ?>
