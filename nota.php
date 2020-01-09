<?php
//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

include 'date.php';
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Nota Pembelian</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">

	<style>   
    	@media print
    	{
    	.noprint {display:none;}
    }
	</style>
</head>
<body>

<!-- navbar -->
<?php include 'navbar.php'; ?>

<section class="konten">
	<div class="container">

<ul class="text-right">
<div class="noprint">
	<a href="">
    	<button onClick="window.print();" class="btn btn-info btn-sm">
    		Cetak <span class="glyphicon glyphicon-print"></span>
    	</button>
	</a>
</div>
</ul>

		<h1 style="color: red;">MarketPlace</h1>
		<h3>Invoice</h3>

<?php
	$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
	$detail = $ambil->fetch_assoc();
?>

<?php

$idbeli = $detail["id_pelanggan"];
$idlogin = $_SESSION["pelanggan"]["id_pelanggan"];

if ($idbeli!==$idlogin) 
	{
	echo "<script>location='riwayat.php'</script>";
	exit();
}

?>

<h3><strong>Dear <?php echo $detail['nama_pelanggan']; ?></strong></h3>
Terima kasih, Anda telah melakukan pemesanan sebagai berikut :
<p></p>
<table class="table table-bordered">
	<thead>
		<tr>
			<th style="text-align: center;" width="50">No</th>
			<th>Nama Barang</th>
			<th>Harga</th>
			<th style="text-align: center;" width="10">Jumlah</th>
			<th>Subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
			<td style="text-align: center;"><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama']; ?></td>
			<td>Rp<?php echo number_format($pecah['harga']); ?></td>
			<td style="text-align: center;"><?php echo $pecah['jumlah']; ?></td>
			<td>Rp<?php echo number_format($pecah['subharga']); ?></td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="4" style="text-align: left;">Ongkos Kirim</th>
			<th>Rp<?php echo number_format($detail['tarif']); ?></th>
		</tr>
		<tr>
			<th colspan="4" style="text-align: left;">Total Pembayaran</th>
			<th>Rp<?php echo number_format($detail['total_pembelian']); ?></th>
		</tr>
	</tfoot>
</table>

<strong>Alamat Tujuan :</strong>
<p>
<strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
<?php echo $detail['alamat_pengiriman']; ?> <br>
HP : <?php echo $detail['hp_pelanggan']; ?>
</p>

<div class="noprint">
<div class="row">
	<div class="col-md-4">
		<div class="alert alert-info">
			<p>
				Silakan melakukan pembayaran Rp<?php echo number_format($detail['total_pembelian']); ?> ke <br>
				<strong>BANK BCA 123-456-78910 AN. MarketPlace</strong>
			</p>
		</div>
	</div>
</div>
</div>
		
	</div>
</section>

</body>
</html>