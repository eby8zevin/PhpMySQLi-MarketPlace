<?php
//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

include 'date.php';
include 'koneksi.php';

$cari = $_GET["cari"];
$semuadata=array();

$ambil = $koneksi->query("SELECT * FROM produk 
				WHERE nama_produk 
				LIKE '%$cari%' 
				OR deskripsi_produk 
				LIKE '%$cari%'");
while ($pecah = $ambil->fetch_assoc()) 
	{
	$semuadata[]=$pecah;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pencarian</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
	<h3>Hasil Pencarian : <?php echo $cari ?></h3>

	<?php if (empty($semuadata)): ?>
		<div class="alert alert-danger">Produk <strong><?php echo $cari ?></strong> tidak ditemukan.</div>
	<?php endif ?>

	<div class="row">

		<?php foreach ($semuadata as $key => $value): ?>

		<div class="col-md-3">
			<div class="thumbnail">
				<img src="foto_produk/<?php echo $value["foto_produk"]; ?>" class="img-responsive">
				<div class="caption">
				<h3><?php echo $value["nama_produk"]; ?></h3>
				<h5>Rp<?php echo number_format($value["harga_produk"]); ?></h5>
				<a href="beli.php?id=<?php echo $value["id_produk"]; ?>" class="btn btn-primary">Beli</a>
				<a href="detail.php?id=<?php echo $value["id_produk"]; ?>" class="btn btn-default">Detail</a>
				</div>
			</div>
		</div>
		<?php endforeach ?>
	</div>
</div>

</body>
</html>