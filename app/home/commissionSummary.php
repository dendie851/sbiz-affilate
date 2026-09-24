<?php ob_start(); ?>
    <?php include_once 'commissionSummaryRead.php' ?>

    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                  <div class="col-md-8">
                        <h4 class="font-weight-bold py-3 mb-0">Dashboard Komisi</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dashboard"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item">Komisi</li>
                            </ol>
                        </div>
                  </div>
                  <div class="col-md-4" style="text-align:right; padding-top:30px; padding-right:20px; padding-bottom: 10px">
                        <button type="button" class="btn btn-default" onclick="window.location='<?php echo $globalUrl ?>home/dashboard'">Kembali</button>
                  </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white ui-hover-icon mb-4 bg-pattern-3">
                        <div class="card-body text-center">
                            <h2><?php echo number_format($dataCommissionInfo['total_earned'], 0, ',', '.') ?></h2>
                            <h6 class="mb-0">Total Komisi Diperoleh</h6>
                            <i class="fa fa-coins hov-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white ui-hover-icon mb-4 bg-pattern-3">
                        <div class="card-body text-center">
                            <h2><?php echo number_format($dataCommissionInfo['total_paid'], 0, ',', '.') ?></h2>
                            <h6 class="mb-0">Komisi Sudah Dibayar</h6>
                            <i class="fa fa-check-circle hov-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white ui-hover-icon mb-4 bg-pattern-3">
                        <div class="card-body text-center">
                            <h2><?php echo number_format($dataCommissionInfo['total_unpaid'], 0, ',', '.') ?></h2>
                            <h6 class="mb-0">Komisi Belum Dibayar</h6>
                            <i class="fa fa-clock-o hov-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white ui-hover-icon mb-4 bg-pattern-3">
                        <div class="card-body text-center">
                            <h2><?php echo number_format($dataCommissionInfo['total_withdraw_amount'], 0, ',', '.') ?></h2>
                            <h6 class="mb-0">Total Pencairan</h6>
                            <i class="fa fa-bank hov-icon"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Informasi Saldo -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="my-3"><i class="fa fa-money"></i> Informasi Saldo Komisi</h6>
                            <div class="row mb-2">
                                <div class="col-md-7 text-muted">Total Komisi Diperoleh</div>
                                <div class="col-md-5 text-right"><b><?php echo number_format($dataCommissionInfo['total_earned'], 0, ',', '.') ?></b></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-7 text-muted">Komisi Sudah Dibayar</div>
                                <div class="col-md-5 text-right"><b><?php echo number_format($dataCommissionInfo['total_paid'], 0, ',', '.') ?></b></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-7 text-muted">Komisi Belum Dibayar</div>
                                <div class="col-md-5 text-right"><b><?php echo number_format($dataCommissionInfo['total_unpaid'], 0, ',', '.') ?></b></div>
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
                                    <button type="button" class="btn btn-outline-primary" onclick="window.location='<?php echo $globalUrl ?>commission/index'">Riwayat Pencairan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Informasi Saldo -->

                <!-- Rekening Pencairan -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="my-3"><i class="fa fa-credit-card"></i> Rekening Pencairan</h6>
                            <?php if(isset($dataBankAffiliate) && $dataBankAffiliate): ?>
                                <div class="row mb-2">
                                    <div class="col-md-5 text-muted">Nama Bank</div>
                                    <div class="col-md-7"><?php echo $dataBankAffiliate['bank_name'] ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-5 text-muted">Nama Pemilik</div>
                                    <div class="col-md-7"><?php echo $dataBankAffiliate['account_name'] ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-5 text-muted">Nomor Rekening</div>
                                    <div class="col-md-7"><?php echo $dataBankAffiliate['account_number'] ?></div>
                                </div>
                            <?php else: ?>
                                <div class="row mb-2">
                                    <div class="col-md-12 text-muted">
                                        Data rekening bank belum ada
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="row mb-2" style="text-align:right">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-outline-primary" onclick="window.location='<?php echo $globalUrl ?>profile/editBank'">Ubah Rekening</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Rekening Pencairan -->
            </div>

            <!-- Riwayat pencairan komisi -->
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="my-3"><i class="fa fa-history"></i> Riwayat Pencairan Komisi</h6>

                    <?php if(mysqli_num_rows($data) < 1) : ?>
                        <div class="alert alert-dark-warning alert-dismissible fade show">
                            Belum ada data pencairan komisi
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table id="datatables" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="5%" style="text-align: center"><b>NO</b></th>
                                        <th style="text-align: center"><b>NO PEMBAYARAN</b></th>
                                        <th style="text-align: center"><b>TANGGAL TRANSFER</b></th>
                                        <th style="text-align: center"><b>BANK TUJUAN</b></th>
                                        <th style="text-align: center"><b>TOTAL PENCAIRAN</b></th>
                                        <th width="10%" style="text-align: center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php while($val = $data->fetch_array()): ?>
                                        <tr>
                                            <td align="center"><?php echo $i ?></td>
                                            <td><?php echo $val['no_payment'] ?></td>
                                            <td align="center"><?php echo $val['date_transfer'] ?></td>
                                            <td><?php echo $val['bank_name'] ?></td>
                                            <td align="right"><?php echo number_format($val['total_withdraw'], 0, ',', '.') ?></td>
                                            <td align="center" style="width: 50px; vertical-align: middle;">
                                                <i class="fa fa-eye" style="font-size: 17px" onclick="window.location='<?php echo $globalUrl ?>commission/detail?id=<?php echo $val['id'] ?>'"></i>
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
</script>
<?php $embedCssJS = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php include_once 'app/template/main.php' ?>