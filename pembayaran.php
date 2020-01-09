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

$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

$idbeli = $detpem["id_pelanggan"];
$idlogin = $_SESSION["pelanggan"]["id_pelanggan"];

if ($idlogin !== $idbeli) 
	{
	echo "<script>location='riwayat.php'</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>MarketPlace</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
	<h2>Konfirmasi Pembayaran</h2>
	<p>Kirim bukti pembayaran disini !</p>
	<div class="alert alert-info">Total tagihan <strong>Rp<?php echo number_format($detpem["total_pembelian"]);  ?></strong></div>

	<form method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label>Nama</label>
			<input type="text" name="nama" class="form-control" placeholder="Nama Penyetor" required>
		</div>
		<div class="form-group">
			<label>Bank</label>
			<input type="text" name="bank" class="form-control" placeholder="BCA , BNI , Mandiri , BRI" required>
		</div>
		<div class="form-group">
			<label>Total</label>
			<input readonly type="text" name="jumlah" class="form-control" value="<?php echo $detpem["total_pembelian"]; ?>">
		</div>
		<div class="form-group">
			<label>Bukti Foto</label>
			<input type="file" name="bukti" class="form-control" required>
			<p class="text-danger">Silakan upload bukti pembayaran Anda.</p>
		</div>
		<button class="btn btn-primary" name="kirim">Kirim</button>
	</form>
</div>

<?php
if (isset($_POST["kirim"])) 
	{
	
	$namabukti = $_FILES["bukti"]["name"];
	$lokasibukti = $_FILES["bukti"]["tmp_name"];
	$namafiks = date("YmdHis").$namabukti;
	move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

	$nama = $_POST["nama"];
	$bank = $_POST["bank"];
	$jumlah = $_POST["jumlah"];
	$tanggal = date("Y-m-d");

	$koneksi->query("INSERT INTO pembayaran 
					(id_pembelian,
					nama,
					bank,
					jumlah,
					tanggal,
					bukti) 
					VALUES
					('$idpem',
					'$nama',
					'$bank',
					'$jumlah',
					'$tanggal',
					'$namafiks')");

	$koneksi->query("UPDATE pembelian SET status_pembelian='Dibayar' WHERE id_pembelian='$idpem'");

	echo "<script>alert('Terimakasih telah mengirimkan bukti pembayaran.')</script>";
	echo "<script>location='riwayat.php'</script>";
}


?>

</body>
</html>