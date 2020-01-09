<?php 
//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

include 'date.php';
include 'koneksi.php';

$id_produk = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Detail Produk</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>

<!-- navbar -->
<?php include 'navbar.php'; ?>

<section class="konten">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="thumbnail">
				<img src="foto_produk/<?php echo $detail["foto_produk"]; ?>" class="img-responsive">
				</div>
			</div>
			<div class="col-md-4">
				<h4><?php echo $detail["nama_produk"]; ?></h4>
				<h5>Rp <?php echo number_format($detail["harga_produk"]); ?></h5>
				<h5>Stok : <?php echo $detail["stok_produk"]; ?></h5>

				<form method="POST">
					<div class="form-group">
						<div class="input-group">
							<input type="number" min="1" class="form-control" name="jumlah" max="<?php echo $detail["stok_produk"]; ?>" required>
							<div class="input-group-btn">
								<button class="btn btn-primary" name="beli">Beli</button>
							</div>
						</div>
					</div>
				</form>

				<?php 
				if (isset($_POST["beli"])) 
					{
					$jumlah = $_POST["jumlah"];
					$_SESSION["keranjang"][$id_produk] += $jumlah;

					echo "<script>alert('Dimasukkan ke keranjang.');</script>";
					echo "<script>location='keranjang.php'</script>";
				}
				?>
				<h4>Deskripsi Produk</h4>
				<p><?php echo $detail["deskripsi_produk"]; ?></p>
			</div>
		</div>
	</div>
</section>

</body>
</html>