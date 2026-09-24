<?php ob_start(); ?>
    <?php include_once 'productSummaryRead.php' ?>

    <?php
        $totalProduct       = isset($dataProductInfo['total_product']) ? (int) $dataProductInfo['total_product'] : 0;
        $totalProductStock  = isset($dataProductInfo['total_product_stock']) ? (int) $dataProductInfo['total_product_stock'] : 0;
        $totalProductEmpty  = isset($dataProductInfo['total_product_empty']) ? (int) $dataProductInfo['total_product_empty'] : 0;
        $totalPointProduct  = isset($dataProductInfo['total_point']) ? (float) $dataProductInfo['total_point'] : 0;

        // Data grafik status stok produk
        $jsonStock = array(
            array('label' => 'Ada Stok', 'value' => $totalProductStock),
            array('label' => 'Stok Kosong', 'value' => $totalProductEmpty)
        );
    ?>

    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                  <div class="col-md-8">
                        <h4 class="font-weight-bold py-3 mb-0">Dashboard Produk Affiliator</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dashboard"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item">Produk</li>
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
                            <h2><?php echo number_format($totalProduct, 0, ',', '.') ?></h2>
                            <h6 class="mb-0">Produk Dipromosikan</h6>
                            <i class="fa fa-cubes hov-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white ui-hover-icon mb-4 bg-pattern-3">
                        <div class="card-body text-center">
                            <h2><?php echo number_format($totalProductStock, 0, ',', '.') ?></h2>
                            <h6 class="mb-0">Produk Ada Stok</h6>
                            <i class="fa fa-check-circle hov-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white ui-hover-icon mb-4 bg-pattern-3">
                        <div class="card-body text-center">
                            <h2><?php echo number_format($totalProductEmpty, 0, ',', '.') ?></h2>
                            <h6 class="mb-0">Produk Stok Kosong</h6>
                            <i class="fa fa-times-circle hov-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white ui-hover-icon mb-4 bg-pattern-3">
                        <div class="card-body text-center">
                            <h2><?php echo number_format($totalPointProduct, 0, ',', '.') ?></h2>
                            <h6 class="mb-0">Potensi Point</h6>
                            <i class="fa fa-star hov-icon"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Grafik status stok -->
                <div class="col-md-5">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="my-3"><i class="fa fa-pie-chart"></i> Status Stok Produk</h6>
                            <div id="grafikStok" style="height: 280px"></div>
                        </div>
                    </div>
                </div>

                <!-- Produk terlaris -->
                <div class="col-md-7">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="my-3"><i class="fa fa-fire"></i> 5 Produk Terlaris</h6>

                            <?php if(mysqli_num_rows($dataProductBest) < 1) : ?>
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1 ?>
                                            <?php while($val = $dataProductBest->fetch_array()): ?>
                                                <tr>
                                                    <td align="center"><?php echo $i ?></td>
                                                    <td><?php echo $val['name'] ?></td>
                                                    <td align="center"><?php echo number_format($val['total_qty'], 0, ',', '.') ?></td>
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
            </div>

            <!-- Daftar produk & link brosur -->
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="my-3"><i class="fa fa-cubes"></i> Produk & Link Brosur</h6>

                    <?php if(mysqli_num_rows($data) < 1) : ?>
                        <div class="alert alert-dark-warning alert-dismissible fade show">
                            Belum ada data produk
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table id="datatables" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="5%" style="text-align: center"><b>NO</b></th>
                                        <th style="text-align: center"><b>SKU</b></th>
                                        <th style="text-align: center"><b>NAMA PRODUK</b></th>
                                        <th style="text-align: center"><b>STOK</b></th>
                                        <th style="text-align: center"><b>HARGA</b></th>
                                        <th style="text-align: center"><b>KOMISI</b></th>
                                        <th style="text-align: center"><b>POINT</b></th>
                                        <th style="text-align: center"><b>QTY TERJUAL</b></th>
                                        <th style="text-align: center"><b>LINK BROSUR</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php while($val = $data->fetch_array()): ?>
                                        <?php $link_product_brosur = $val['link_product_brosur'] ?>
                                        <tr>
                                            <td align="center"><?php echo $i ?></td>
                                            <td><?php echo $val['sku'] ?></td>
                                            <td><?php echo $val['name'] ?></td>
                                            <td align="center"><?php echo number_format($val['stock'], 0, ',', '.') ?></td>
                                            <td align="right"><?php echo number_format($val['price'], 0, ',', '.') ?></td>
                                            <td align="right"><?php echo number_format($val['fee_affiliate_nominal'], 0, ',', '.') ?></td>
                                            <td align="center"><?php echo number_format($val['point'], 0, ',', '.') ?></td>
                                            <td align="center"><?php echo number_format($val['total_qty'], 0, ',', '.') ?></td>
                                            <td style="word-wrap: break-word; word-break: break-all;">
                                                <a href="<?php echo $link_product_brosur ?>" target="_blank"><?php echo $link_product_brosur ?></a>
                                                <br>
                                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('<?php echo $link_product_brosur ?>')">
                                                    <i class="fa fa-copy"></i> Copy
                                                </button>
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

    // Grafik status stok produk
    new Morris.Donut({
        element: 'grafikStok',
        data: <?php echo json_encode($jsonStock, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>,
        colors: ['#26a69a', '#ef5350'],
        resize: true,
        hideHover: 'auto'
    });

    function copyToClipboard(text) {
        if(navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(function() {
                alert("Tautan berhasil disalin:\n" + text);
            }).catch(function(err) {
                console.error("Gagal menyalin: ", err);
                alert("Gagal menyalin tautan.");
            });
        } else {
            var tempInput = document.createElement("input");
            tempInput.style.position = "absolute";
            tempInput.style.left = "-1000px";
            tempInput.style.top = "-1000px";
            tempInput.value = text;

            document.body.appendChild(tempInput);
            tempInput.select();

            try {
                document.execCommand("copy");
                alert("Tautan berhasil disalin:\n" + text);
            } catch (err) {
                console.error("Gagal menyalin: ", err);
                alert("Gagal menyalin tautan.");
            }

            document.body.removeChild(tempInput);
        }
    }
</script>
<?php $embedCssJS = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php include_once 'app/template/main.php' ?>