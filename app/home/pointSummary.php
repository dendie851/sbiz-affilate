<?php ob_start(); ?>
    <?php include_once 'pointSummaryRead.php' ?>

    <?php
        $statusClaimLabel = array('0' => 'PENGAJUAN', '1' => 'DI SETUJUI', '2' => 'PROSES PENYERAHAN', '3' => 'SELESAI', '4' => 'DI TOLAK');
        $statusClaimBadge = array('0' => 'badge-outline-info', '1' => 'badge-outline-primary', '2' => 'badge-outline-warning', '3' => 'badge-outline-success', '4' => 'badge-outline-danger');

        // Data grafik perbandingan point
        $jsonPoint = array(
            array('label' => 'Diperoleh', 'value' => (int) $dataPointInfo['total_point']),
            array('label' => 'Ditukar', 'value' => (int) $dataPointInfo['total_spent']),
            array('label' => 'Dalam Pengajuan', 'value' => (int) $dataPointInfo['total_pending']),
            array('label' => 'Sisa', 'value' => (int) $dataPointInfo['sisa_point'])
        );
    ?>

    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                  <div class="col-md-8">
                        <h4 class="font-weight-bold py-3 mb-0">Dashboard Point</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dashboard"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item">Point</li>
                            </ol>
                        </div>
                  </div>
                  <div class="col-md-4" style="text-align:right; padding-top:30px; padding-right:20px; padding-bottom: 10px">
                        <button type="button" class="btn btn-primary" onclick="window.location='<?php echo $globalUrl ?>point/claim'">Tukar Point</button>
                        <button type="button" class="btn btn-default" onclick="window.location='<?php echo $globalUrl ?>home/dashboard'">Kembali</button>
                  </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white ui-hover-icon mb-4 bg-pattern-3">
                        <div class="card-body text-center">
                            <h2><?php echo number_format($dataPointInfo['total_point'], 0, ',', '.') ?></h2>
                            <h6 class="mb-0">Total Point Diperoleh</h6>
                            <i class="fa fa-star hov-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white ui-hover-icon mb-4 bg-pattern-3">
                        <div class="card-body text-center">
                            <h2><?php echo number_format($dataPointInfo['sisa_point'], 0, ',', '.') ?></h2>
                            <h6 class="mb-0">Sisa Point</h6>
                            <i class="fa fa-check-circle hov-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white ui-hover-icon mb-4 bg-pattern-3">
                        <div class="card-body text-center">
                            <h2><?php echo number_format($dataPointInfo['total_spent'], 0, ',', '.') ?></h2>
                            <h6 class="mb-0">Total Point Ditukar</h6>
                            <i class="fa fa-exchange hov-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white ui-hover-icon mb-4 bg-pattern-3">
                        <div class="card-body text-center">
                            <h2><?php echo number_format($dataPointInfo['total_pending'], 0, ',', '.') ?></h2>
                            <h6 class="mb-0">Point Dalam Pengajuan</h6>
                            <i class="fa fa-clock-o hov-icon"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Grafik perbandingan point -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="my-3"><i class="fa fa-pie-chart"></i> Perbandingan Point</h6>
                            <div id="grafikPoint" style="height: 280px"></div>
                        </div>
                    </div>
                </div>

                <!-- Rincian point -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="my-3"><i class="fa fa-info-circle"></i> Rincian Point</h6>
                            <div class="row mb-2">
                                <div class="col-md-7 text-muted">Jumlah Transaksi Selesai</div>
                                <div class="col-md-5 text-right"><b><?php echo number_format($dataPointInfo['jml_transaksi'], 0, ',', '.') ?> Transaksi</b></div>
                            </div>
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
                            <div class="row mb-2">
                                <div class="col-md-7 text-muted">Point Selesai Ditukar</div>
                                <div class="col-md-5 text-right"><b><?php echo number_format($dataPointInfo['total_complete'], 0, ',', '.') ?> Point</b></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-7 text-muted">Sisa Point</div>
                                <div class="col-md-5 text-right"><b><?php echo number_format($dataPointInfo['sisa_point'], 0, ',', '.') ?> Point</b></div>
                            </div>
                            <div class="row" style="text-align:right">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-outline-primary" onclick="window.location='<?php echo $globalUrl ?>point/index'">Daftar Penukaran Point</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Riwayat penukaran point -->
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="my-3"><i class="fa fa-history"></i> Riwayat Penukaran Point</h6>

                    <?php if(mysqli_num_rows($data) < 1) : ?>
                        <div class="alert alert-dark-warning alert-dismissible fade show">
                            Belum ada data penukaran point
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table id="datatables" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="5%" style="text-align: center"><b>NO</b></th>
                                        <th style="text-align: center"><b>NO PENUKARAN</b></th>
                                        <th style="text-align: center"><b>REWARD</b></th>
                                        <th style="text-align: center"><b>TGL PENGAJUAN</b></th>
                                        <th style="text-align: center"><b>POINT</b></th>
                                        <th style="text-align: center"><b>STATUS</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php while($val = $data->fetch_array()): ?>
                                        <tr>
                                            <td align="center"><?php echo $i ?></td>
                                            <td><?php echo $val['no_point_claim'] ?></td>
                                            <td><?php echo $val['reward_name'] ?></td>
                                            <td align="center"><?php echo $val['date_request'] ?></td>
                                            <td align="center"><?php echo number_format($val['points_spent'], 0, ',', '.') ?></td>
                                            <td align="center">
                                                <span class="badge <?php echo isset($statusClaimBadge[$val['status_claim']]) ? $statusClaimBadge[$val['status_claim']] : 'badge-outline-dark' ?>"
                                                      style="font-size: 11px; padding: 6px; margin: 3px;">
                                                    <?php echo isset($statusClaimLabel[$val['status_claim']]) ? $statusClaimLabel[$val['status_claim']] : '-' ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php $i++ ?>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    <!-- [ content ] End -->
    </div>

<?php $templateContent = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php ob_start(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatables').DataTable({
            scrollX: true,
            lengthMenu: [
                [ 50, 100, 200, -1 ],
                [ '50 Data', '100 Data', '200 Data', 'Tampilkan Semua' ]
            ],
        });
    });

    // Grafik perbandingan point
    new Morris.Donut({
        element: 'grafikPoint',
        data: <?php echo json_encode($jsonPoint, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>,
        colors: ['#26a69a', '#ef5350', '#f0ad4e', '#4fc3f7'],
        resize: true,
        hideHover: 'auto'
    });
</script>
<?php $embedCssJS = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php include_once 'app/template/main.php' ?>