<?php
//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

include 'date.php';
include 'koneksi.php';
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) 
	{
	echo "<script>alert('Silakan login terlebih dahulu.')</script>";
	echo "<script>location='login.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>MarketPlace</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="popup1.css">
</head>
<body>
	
<!-- navbar -->
<?php include 'navbar.php'; ?>

<section class="riwayat">
	<div class="container">
		<h3>Transaksi <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?></h3>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th style="text-align: center;">No</th>
					<th>Tanggal Pembelian</th>
					<th>Status</th>
					<th>Total Pembelian</th>
					<th style="text-align: center;">Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$nomor=1; 
				$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
				$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
				while ($pecah = $ambil->fetch_assoc()){
				?>
				<tr>
					<td style="text-align: center;"><?php echo $nomor; ?></td>
					<td><?php echo $pecah["tanggal_pembelian"]; ?></td>
					<td><?php echo $pecah["status_pembelian"]; ?>
						<br>
						<?php if (!empty($pecah["resi_pengiriman"])): ?>
						No. Resi : <?php echo $pecah["resi_pengiriman"]; ?> 
						<?php endif ?>
					</td>
					<td>Rp<?php echo number_format($pecah["total_pembelian"]); ?></td>
					<td>
						<a href="nota.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-info">Invoice</a>

						<!-- <?php //if ($pecah['status_pembelian']=="Menunggu Pembayaran"): ?>

						<a href="pembayaran.php?id=<?php //echo $pecah["id_pembelian"]; ?>" class="btn btn-danger">Konfirmasi Pembayaran</a>

						<?php //else: ?>

						<a href="lihat_pembayaran.php?id=<?php //echo $pecah["id_pembelian"]; ?>" class="btn btn-warning">Lihat Pembayaran</a>

						<?php //endif ?> -->

						<?php if ($pecah['status_pembelian']=="Menunggu Pembayaran") { ?>
							<a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-danger">Konfirmasi Pembayaran</a>

						<?php } elseif ($pecah['status_pembelian']=="Dibayar" OR $pecah['status_pembelian']=="Transaksi Selesai") { ?>
							<a href="lihat_pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-warning">Lihat Pembayaran</a>

						<?php } else { ?>
							<a href="terima_pesanan.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-success">Terima Pesanan</a>
						<?php } ?>
					</td>
				</tr>
				<?php $nomor++; ?>
				<?php } ?>
			</tbody>
		</table>
	</div>
</section>

</body>
</html>