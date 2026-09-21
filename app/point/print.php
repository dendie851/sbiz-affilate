<?php ob_start(); ?>
<?php include 'printRead.php' ?>

<style>
    /* CSS tambahan untuk merapikan tampilan saat layar kecil dan saat dicetak */
    .invoice-container {
        padding: 20px;
        background-color: #fff;
    }
    .table-totals th, .table-totals td {
        border-top: none !important;
    }
    @media print {
        body {
            background-color: #fff;
            -webkit-print-color-adjust: exact;
        }
        .invoice-container {
            padding: 0;
        }
        .card {
            border: 1px solid #ddd !important;
        }
        .card-header {
            background-color: #f8f9fa !important;
            border-bottom: 1px solid #ddd !important;
        }
    }
</style>

<div class="invoice-container container-fluid flex-grow-1">
    
    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
        <div>
            <!-- Uncomment jika ingin pakai logo -->
            <!-- <img src="../asset/image/logo.jpg" alt="Logo" style="max-height: 80px;" /> -->
        </div>
        <div class="text-right">
            <h2 class="font-weight-bold text-uppercase mb-0">Faktur Penjualan</h2>
        </div>
    </div>

    <!-- INFORMASI UMUM -->
    <div class="row mb-4">
        <!-- Jenis Pembelian -->
        <div class="col-md-6 mb-3 mb-md-0">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-light font-weight-bold">
                    <i class="fa fa-shopping-cart mr-2"></i> JENIS PEMBELIAN
                </div>
                <div class="card-body py-2">
                    <table class="table table-borderless table-sm mb-0">
                        <tr>
                            <td width="40%" class="text-muted">NO SALES ORDER</td>
                            <td class="font-weight-bold">: <?php echo $dataHeader['no_order'] ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">TGL PEMBELIAN</td>
                            <td>: <?php echo $dataHeader['date_order_frm'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Data Pembeli -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-light font-weight-bold">
                    <i class="fa fa-user mr-2"></i> DATA PEMBELI
                </div>
                <div class="card-body py-2">
                    <table class="table table-borderless table-sm mb-0">
                        <tr>
                            <td width="30%" class="text-muted">NAMA</td>
                            <td class="font-weight-bold">: <?php echo $dataHeader['name'] ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">TELEPON</td>
                            <td>: <?php echo $dataHeader['phone'] ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted align-top">ALAMAT</td>
                            <td>
                                : <?php echo $dataHeader['address_shipping'] ?>
                                <div class="text-muted small mt-1 pl-2">
                                    <?php echo ucwords(strtolower($dataHeader['province'])) ?>, <?php echo ucwords(strtolower($dataHeader['city'])) ?>, 
                                    <?php echo ucwords(strtolower($dataHeader['districts'])) ?>, <?php echo ucwords(strtolower($dataHeader['districts_sub'])) ?>,
                                    <?php echo ucwords(strtolower($dataHeader['postal_code'])) ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- DATA BARANG -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light font-weight-bold">
            <i class="fa fa-box mr-2"></i> DATA BARANG
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped mb-0">
                <thead class="thead-dark text-center">
                    <tr>
                        <th width="5%" class="align-middle">NO</th>
                        <th width="35%" class="align-middle">NAMA BARANG</th>
                        <th width="10%" class="align-middle">QTY</th>
                        <th width="25%" class="align-middle">HARGA JUAL</th>
                        <th width="25%" class="align-middle">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php $total = 0; ?>
                    <?php while($val = mysqli_fetch_array($dataDetail)): ?>
                        <tr>
                            <td class="text-center align-middle"><?php echo $i ?></td>
                            <td>
                                <?php if($val['is_bundling'] == '1'): ?>
                                    <span class="font-weight-bold"><?php echo $val['name'] ?></span><br />
                                    <?php 
                                        $query = "SELECT b.id, b.stuff_id, b.qty, s.name
                                                    FROM sales_order_detail_bundling as b
                                                    INNER JOIN stuff as s ON s.id = b.stuff_id
                                                    WHERE sales_order_detail_id = '{$val['id']}'
                                                    ORDER BY id ASC";
                                        $rstDetailBundling = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL))
                                    ?>
                                    <div class="mt-2 text-muted" style="font-size: 0.85rem;">
                                        <strong>Bundling Detail:</strong><br/>
                                        <ul class="pl-3 mb-0">
                                        <?php while($dataDetailBundling = $rstDetailBundling->fetch_array()): ?>
                                            <li><?php echo $dataDetailBundling['name'] ?> (<?php echo $dataDetailBundling['qty'] ?>)</li>
                                        <?php endwhile; ?>
                                        </ul>
                                    </div>
                                <?php else: ?>  
                                    <span class="font-weight-bold"><?php echo $val['name'] ?></span><br />
                                    <small class="text-muted">(<?php echo $val['nickname'] ?>)</small>
                                <?php endif; ?> 
                            </td>
                            <td class="text-center align-middle"><?php echo $val['amount'] ?></td>
                            <td class="text-right align-middle">Rp. <?php echo number_format($val['price'], 0, ',', '.') ?></td>   
                            <td class="text-right align-middle font-weight-bold">Rp. <?php echo number_format($val['price'] * $val['amount'], 0, ',', '.') ?></td>                            
                        </tr>   
                        <?php $total = $total + ($val['price'] * $val['amount']) ?>
                        <?php $i++; ?>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        
        <!-- BAGIAN TOTAL / FOOTER TABEL -->
        <div class="card-footer bg-white">
            <div class="row justify-content-end">
                <div class="col-md-6 col-lg-5">
                    <table class="table table-sm table-borderless table-totals mb-0">
                        <tr>
                            <td class="font-weight-bold text-right" width="60%">TOTAL</td>
                            <td class="text-right font-weight-bold" width="40%">Rp. <?php echo number_format($total, 0, ',', '.') ?></td>
                        </tr>                       
                        <tr>
                            <td class="text-right">Diskon (<?php echo $dataHeader['discount_persen'] ?>%)</td>
                            <td class="text-right text-danger">- Rp. <?php echo number_format(($total / 100) * $dataHeader['discount_persen'], 0, ',', '.') ?></td>
                        </tr>   
                        <tr>
                            <td class="text-right">Diskon Nominal</td>
                            <td class="text-right text-danger">- Rp. <?php echo number_format($dataHeader['discount_amount'], 0, ',', '.') ?></td>
                        </tr>   
                        <tr class="border-top">
                            <td class="font-weight-bold text-right">TOTAL SETELAH DISKON</td>
                            <?php $totalAfterDiscount = ($total - (($total / 100) * $dataHeader['discount_persen'])) - $dataHeader['discount_amount']; ?>
                            <td class="text-right font-weight-bold">Rp. <?php echo number_format($totalAfterDiscount, 0, ',', '.') ?></td>
                        </tr>       
                        <tr>
                            <td class="text-right">Biaya Kirim (Sebelum Diskon)</td>
                            <td class="text-right">Rp. <?php echo number_format($dataHeader['shipping_cost_before_discount'], 0, ',', '.') ?></td>
                        </tr>                                               
                        <tr>
                            <td class="text-right">Diskon Biaya Kirim</td>
                            <td class="text-right text-danger">- Rp. <?php echo number_format($dataHeader['shipping_cost_discount'], 0, ',', '.') ?></td>
                        </tr>                                               
                        <tr>
                            <td class="text-right">Biaya Kirim Akhir</td>
                            <td class="text-right">Rp. <?php echo number_format($dataHeader['shipping_cost'], 0, ',', '.') ?></td>
                        </tr>                                               
                        <tr class="border-top bg-light">
                            <td class="font-weight-bold text-right" style="font-size: 1.1rem;">GRAND TOTAL</td>
                            <td class="text-right font-weight-bold text-primary" style="font-size: 1.1rem;">
                                Rp. <?php echo number_format($totalAfterDiscount + $dataHeader['shipping_cost'], 0, ',', '.') ?>
                            </td>
                        </tr>   
                    </table>
                </div>
            </div>
        </div>
    </div>

</div> <!-- End Invoice Container -->

<?php $templateContent = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php ob_start(); ?>
<!-- Letakkan JavaScript Tambahan disini jika ada -->
<?php $embedCssJS = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php include_once 'app/template/popup.php' ?>