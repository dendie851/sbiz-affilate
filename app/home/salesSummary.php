<?php ob_start(); ?>
    <?php include_once 'salesSummaryRead.php' ?>

    <?php
        $bulanLabel = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'Mei', '06' => 'Jun',
                            '07' => 'Jul', '08' => 'Agu', '09' => 'Sep', '10' => 'Okt', '11' => 'Nov', '12' => 'Des');

        $statusOrderLabel = array('0' => 'ORDER BARU', '1' => 'DIPROSES', '2' => 'DIKIRIM', '3' => 'SELESAI', '4' => 'DIBATALKAN');

        $totalOrder = isset($dataStatus['total_order']) ? (int) $dataStatus['total_order'] : 0;

        // Data tren bulanan untuk chart morris
        $jsonBulan   = array();
        $jsonOrder   = array();
        $jsonSale    = array();

        if(mysqli_num_rows($dataMonthly) > 0) {
            while($val = $dataMonthly->fetch_array()) {
                $jsonBulan[] = isset($bulanLabel[$val['bulan']]) ? $bulanLabel[$val['bulan']] : $val['bulan'];
                $jsonOrder[] = array('month' => isset($bulanLabel[$val['bulan']]) ? $bulanLabel[$val['bulan']] : $val['bulan'],
                                     'order' => (int) $val['total_order'],
                                     'sale'  => (float) $val['total_sale'],
                                     'fee'   => (float) $val['total_fee']);
            }
        }
    ?>

    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                  <div class="col-md-8">
                        <h4 class="font-weight-bold py-3 mb-0">Dashboard Penjualan</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dashboard"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item">Penjualan</li>
                            </ol>
                        </div>
                  </div>
                  <div class="col-md-4" style="text-align:right; padding-top:30px; padding-right:20px; padding-bottom: 10px">
                        <button type="button" class="btn btn-default" onclick="window.location='<?php echo $globalUrl ?>home/dashboard'">Kembali</button>
                  </div>
            </div>

            <div class="row">
                <?php $statusList = array(
                        '0' => array('label' => 'Order Baru', 'count' => 'total_order_new', 'sale' => 'total_sale_new', 'color' => 'bg-primary'),
                        '1' => array('label' => 'Diproses', 'count' => 'total_order_process', 'sale' => 'total_sale_process', 'color' => 'bg-info'),
                        '2' => array('label' => 'Dikirim', 'count' => 'total_order_shipping', 'sale' => 'total_sale_shipping', 'color' => 'bg-warning'),
                        '3' => array('label' => 'Selesai', 'count' => 'total_order_complete', 'sale' => 'total_sale_complete', 'color' => 'bg-success'),
                        '4' => array('label' => 'Dibatalkan', 'count' => 'total_order_cancel', 'sale' => 'total_sale_cancel', 'color' => 'bg-danger')
                    ) ?>
                <?php foreach($statusList as $key => $statusRow): ?>
                    <div class="col-xl-3 col-md-6">
                        <div class="card <?php echo $statusRow['color'] ?> text-white ui-hover-icon mb-4 bg-pattern-3">
                            <div class="card-body text-center">
                                <h2><?php echo number_format(isset($dataStatus[$statusRow['count']]) ? (int) $dataStatus[$statusRow['count']] : 0, 0, ',', '.') ?></h2>
                                <h6 class="mb-0"><?php echo $statusRow['label'] ?></h6>
                                <div class="small" style="font-size: 12px">Nilai: <?php echo number_format(isset($dataStatus[$statusRow['sale']]) ? (float) $dataStatus[$statusRow['sale']] : 0, 0, ',', '.') ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Grafik tren penjualan per bulan -->
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="my-3"><i class="fa fa-line-chart"></i> Tren Penjualan Tahun <?php echo $year ?></h6>
                    <?php if(count($jsonOrder) < 1) : ?>
                        <div class="alert alert-dark-warning alert-dismissible fade show">
                            Belum ada data penjualan pada tahun <?php echo $year ?>
                        </div>
                    <?php else: ?>
                        <div id="grafikPenjualan" style="height: 280px"></div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Produk terlaris -->
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="my-3"><i class="fa fa-cubes"></i> Produk Terlaris</h6>

                    <?php if(mysqli_num_rows($dataProduct) < 1) : ?>
                        <div class="alert alert-dark-warning alert-dismissible fade show">
                            Belum ada data penjualan produk
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="5%" style="text-align: center"><b>NO</b></th>
                                        <th style="text-align: center"><b>NAMA PRODUK</b></th>
                                        <th style="text-align: center"><b>QTY TERJUAL</b></th>
                                        <th style="text-align: center"><b>NILAI PENJUALAN</b></th>
                                        <th style="text-align: center"><b>KOMISI</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php while($val = $dataProduct->fetch_array()): ?>
                                        <tr>
                                            <td align="center"><?php echo $i ?></td>
                                            <td><?php echo $val['name'] ?></td>
                                            <td align="center"><?php echo number_format($val['total_qty'], 0, ',', '.') ?></td>
                                            <td align="right"><?php echo number_format($val['total_sale'], 0, ',', '.') ?></td>
                                            <td align="right"><?php echo number_format($val['total_fee'], 0, ',', '.') ?></td>
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

    <?php if(count($jsonOrder) > 0): ?>
    // Grafik tren penjualan per bulan
    new Morris.Bar({
        element: 'grafikPenjualan',
        data: <?php echo json_encode($jsonOrder, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>,
        xkey: 'month',
        ykeys: ['order', 'sale', 'fee'],
        labels: ['Jumlah Order', 'Nilai Penjualan', 'Komisi'],
        barColors: ['#26a69a', '#4fc3f7', '#f0ad4e'],
        behaveLikeLine: false,
        hideHover: 'auto',
        resize: true
    });
    <?php endif; ?>
</script>
<?php $embedCssJS = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php include_once 'app/template/main.php' ?>