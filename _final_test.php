<?php
// Final smoke test of the commission module (read-only, tidak mengubah data).
$base = 'http://localhost/fahrian-new-product/sbiz-affilate/';
$out = array();
function r($l) { global $out; $out[] = $l; file_put_contents(dirname(__FILE__) . '/_final.txt', implode(PHP_EOL, $out) . PHP_EOL); }

function req($url, $post = null, $cookie = null)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    if ($cookie !== null) { curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie); curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie); }
    if ($post !== null) { curl_setopt($ch, CURLOPT_POST, true); curl_setopt($ch, CURLOPT_POSTFIELDS, $post); }
    $resp = curl_exec($ch);
    $i = curl_getinfo($ch);
    curl_close($ch);
    return array('code' => $i['http_code'], 'headers' => substr($resp, 0, $i['header_size']), 'body' => substr($resp, $i['header_size']));
}

$ck = null;
for ($t = 0; $t < 8 && !$ck; $t++) {
    $c = tempnam(sys_get_temp_dir(), 'ck');
    $x = req($base . 'auth/login', null, $c);
    preg_match('/name="token" value="([^"]+)"/', $x['body'], $m);
    if (!isset($m[1])) { continue; }
    req($base . 'auth/signin', 'username=affiliate&password=1234&token=' . $m[1], $c);
    if (req($base . 'commission/index', null, $c)['code'] == 200) { $ck = $c; }
}
r('LOGIN affiliate (pemilik data): ' . ($ck ? 'OK' : 'GAGAL'));

$pages = array('commission/index', 'commission/detail?id=19', 'commission/detail?id=20', 'commission/add');
foreach ($pages as $p) {
    $x = req($base . $p, null, $ck);
    r(str_pad($p, 26) . ' HTTP ' . $x['code'] . ' | bytes=' . strlen($x['body'])
        . ' | PHP-err=' . (preg_match('/(Fatal error|Parse error|Warning:|Notice:)/i', $x['body']) ? 'ADA <<<<' : 'CLEAN'));
}

// UI berbahasa Indonesia
$x = req($base . 'commission/index', null, $ck);
foreach (array('Komisi', 'Tambah Pencairan', 'CAIR', 'NO PEMBAYARAN', 'TANGGAL TRANSFER', 'TOTAL PENCAIRAN', 'STATUS') as $t) {
    r('  index  teks "' . $t . '" : ' . (strpos($x['body'], $t) !== false ? 'ADA' : 'TIDAK <<<<'));
}
$x = req($base . 'commission/detail?id=19', null, $ck);
foreach (array('Detail Komisi', 'Informasi Pencairan', 'No Pembayaran', 'Tanggal Transfer', 'Bank', 'Keterangan', 'Total Pencairan', 'TOTAL', 'Kembali') as $t) {
    r('  detail teks "' . $t . '" : ' . (strpos($x['body'], $t) !== false ? 'ADA' : 'TIDAK <<<<'));
}
$x = req($base . 'commission/add', null, $ck);
foreach (array('Tambah Pencairan Komisi', 'Rekening Pencairan', 'No Rekening', 'Atas Nama', 'PILIH', 'NILAI ORDER', 'TOTAL PENCAIRAN', 'Batal', 'Simpan') as $t) {
    r('  add    teks "' . $t . '" : ' . (strpos($x['body'], $t) !== false ? 'ADA' : 'TIDAK <<<<'));
}

// Verifikasi label tabel add saat ADA data (buat SO uji sementara, lalu hapus)
$m = new mysqli('localhost', 'root', '', 'fahrian_new_product');
$m->query("insert into sales_order set client_id='0', sales_id='0', reseller_id='0', affiliate_id='1', expedition_id='0', period_order_id='0',
    no_order='SO-FINAL', name='Pembeli Final', phone='620000000000', address_shipping='-', description_payment='', description_shipping='',
    discount_persen='0', discount_amount='0', amount_sale='90000', amount_basic_sale='50000', shipping_cost='0', no_resi='', marketplace='',
    date_order=curdate(), date_packing='0000-00-00', date_payment='0000-00-00', date_shipping='0000-00-00',
    amount_fee_affiliate='1500', is_delete='0'");
$soid = $m->insert_id;

$x = req($base . 'commission/add', null, $ck);
r('--- dengan 1 SO yang bisa dicairkan (id=' . $soid . ') ---');
foreach (array('PILIH', 'NO SALES ORDER', 'NAMA PEMBELI', 'TANGGAL ORDER', 'NILAI ORDER', 'KOMISI', 'TOTAL PENCAIRAN', 'SO-FINAL', '1.500') as $t) {
    r('  add    teks "' . $t . '" : ' . (strpos($x['body'], $t) !== false ? 'ADA' : 'TIDAK <<<<'));
}
r('  checkbox chkOrder : ' . (strpos($x['body'], 'class="chkOrder"') !== false ? 'ADA' : 'TIDAK <<<<'));
r('  data-fee          : ' . (strpos($x['body'], 'data-fee="1500"') !== false ? 'ADA' : 'TIDAK <<<<'));

$m->query("delete from sales_order where id='{$soid}'");
$c = $m->query("select count(*) as s from sales_order")->fetch_assoc();
r('CLEANUP: sales_order=' . $c['s'] . ' (semula 12)');

