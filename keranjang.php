<?php
//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

include 'date.php';
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>MarketPlace</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>

<!-- navbar -->
<?php include 'navbar.php'; ?>

<?php
if (empty($_SESSION["keranjang"])):
	echo "<center><h1>Keranjang belanja Anda masih kosong.</h1></center>"; ?>
<?php else: ?>

<section class="konten">
	<div class="container">
		<h1>Keranjang Belanja</h1>
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th style="text-align: center;" width="50">No</th>
					<th>Produk</th>
					<th>Harga</th>
					<th style="text-align: center;" width="10">Jumlah</th>
					<th>Subharga</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php $nomor=1; ?>
				<?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
				<!-- menampilkan produk -->
				<?php $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
				$pecah = $ambil->fetch_assoc(); 
				$subharga = $pecah["harga_produk"]*$jumlah;
				?>
				<tr>
					<td style="text-align: center;"><?php echo $nomor; ?></td>
					<td><?php echo $pecah["nama_produk"]; ?></td>
					<td>Rp <?php echo number_format($pecah["harga_produk"]); ?></td>
					<td style="text-align: center;"><?php echo $jumlah; ?></td>
					<td>Rp <?php echo number_format($subharga); ?></td>
					<td>
						<a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs">Hapus</a>
					</td>
				</tr>
				<?php $nomor++; ?>
				<?php endforeach ?>
			</tbody>
		</table>

<?php endif ?>
<?php if (empty($_SESSION["keranjang"])): 
	echo "<center><a href='index.php' class='btn btn-info'>Belanja Sekarang</a></center>" ?>
<?php else: ?>

		<a href="index.php" class="btn btn-default">Lanjutkan Belanja</a>
		<a href="checkout.php" class="btn btn-primary">Checkout</a>
		
<?php endif ?>
	</div>
</section>

</body>
</html>