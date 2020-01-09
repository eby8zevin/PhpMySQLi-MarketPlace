<?php
//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

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
	<title>Terima Pesanan</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>


<div style="padding: 250px">
<center><h3>Menerima Pesanan ?</h3></center>
	<form method="POST">
		<center>
			<button class="btn btn-success btn-lg" name="terima">Terima</button>
			&nbsp;
			<a href="riwayat.php" class="btn btn-danger btn-lg">Belum</a>
		</center>
	</form>
</div>

</body>
</html>

<?php
if (isset($_POST["terima"])) 
	{

	$koneksi->query("UPDATE pembelian 
					SET status_pembelian='Transaksi Selesai' 
					WHERE id_pembelian='$idpem'");

	echo "<script>alert('Terima kasih sudah berbelanja ditoko online kami.')</script>";
	echo "<script>location='riwayat.php'</script>";
}
?>