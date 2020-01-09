<?php
include 'security.php';
?>

<h2>Data Pembayaran</h2> <br>

<?php 
$id_pembelian = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
$detail = $ambil->fetch_assoc();
?>

<div class="row">
	<div class="col-md-6">
		<table class="table">
			<tr>
				<th>Nama</th>
				<td><?php echo $detail['nama']; ?></td>
			</tr>
			<tr>
				<th>BANK</th>
				<td><?php echo $detail['bank']; ?></td>
			</tr>
			<tr>
				<th>Total</th>
				<td>Rp<?php echo number_format($detail['jumlah']); ?></td>
			</tr>
			<tr>
				<th>Tanggal</th>
				<td><?php echo $detail['tanggal']; ?></td>
			</tr>
			<tr>
				<th></th>
				<td></td>
			</tr>
		</table>
	</div>
	<div class="col-md-6">
		<img src="../bukti_pembayaran/<?php echo $detail['bukti']; ?>" class="img-responsive">
	</div>
</div>

<?php $nores = $koneksi->query("SELECT * FROM pembelian 
								WHERE id_pembelian='$id_pembelian'"); ?>
<?php $pecah = $nores->fetch_assoc(); ?>
<?php if ($pecah['status_pembelian']=="Dibayar"): ?>
<form method="POST">
	<div class="form-group">
		<label>Masukkan No. Resi Pengiriman</label>
		<input type="text" name="resi" class="form-control" required>
		<input hidden type="text" name="status" value="Barang Dikirim">
	</div>
	<button class="btn btn-primary" name="proses">Kirim</button>
</form>
<?php endif ?>

<?php
if (isset($_POST["proses"])) 
	{
	$resi = $_POST["resi"];
	$status = $_POST["status"];

	$koneksi->query("UPDATE pembelian SET resi_pengiriman='$resi',
		status_pembelian='$status' WHERE id_pembelian='$id_pembelian'");

	echo "<script>alert('Pembelian diperbarui.')</script>";
	echo "<script>location='index.php?halaman=pembelian'</script>";
}
?>