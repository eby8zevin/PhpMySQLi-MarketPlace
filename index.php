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

<!-- konten -->
<section class="konten">
	<div class="container">
		<h1>Welcome <!-- <span style="color: red;"><?php //echo $_SESSION["pelanggan"]['nama_pelanggan']; ?></span> --></h1>
		<div class="row">

			<?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
			<?php while($perproduk = $ambil->fetch_assoc()){ ?>

			<div class="col-md-3">
				<div class="thumbnail">
					<img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="BLΛƆKPIИK">
					<div class="caption">
						<h4><?php echo $perproduk['nama_produk']; ?></h4>
						<h5>Rp<?php echo number_format($perproduk['harga_produk']); ?></h5>
						<a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary">Beli</a>
						<a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-default"> Detail</a>
					</div>
				</div>
			</div>
			<?php } ?>
			
		</div>
	</div>
</section>

</body>
</html>

           