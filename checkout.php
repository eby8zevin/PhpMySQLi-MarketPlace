<?php
//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

include 'date.php';
include 'koneksi.php';
if (!isset($_SESSION["pelanggan"])) 
	{
	echo "<script>alert('Silakan login terlebih dahulu.')</script>";
	echo "<script>location='login.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>

<!-- navbar -->
<?php include 'navbar.php'; ?>

<?php
if (empty($_SESSION["keranjang"])):
	echo "<script>location='index.php'</script>"; ?>
<?php else: ?>

<section class="konten">
	<div class="container">
		<h1>Checkout</h1>
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th style="text-align: center;" width="50">No</th>
					<th>Produk</th>
					<th>Harga</th>
					<th style="text-align: center;" width="10">Jumlah</th>
					<th>Subharga</th>
				</tr>
			</thead>
			<tbody>
				<?php $nomor=1; ?>
				<?php $totalbelanja=0; ?>
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
				</tr>
				<?php $nomor++; ?>
				<?php $totalbelanja+=$subharga; ?>
				<?php endforeach ?>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="4" style="text-align: center;">Total Belanja</th>
					<th>Rp<?php echo number_format($totalbelanja) ?></th>
				</tr>
			</tfoot>
		</table>

		<form method="POST">
			<div class="row">
				<div class="col-md-4">
					<label>Nama</label>
					<div class="form-group">
					<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan'] ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>HP</label>
					<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['hp_pelanggan'] ?>" class="form-control">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
					<label>Pengiriman Ke</label>
					<select class="form-control" name="id_ongkir" required>
						<?php
						$ambil = $koneksi->query("SELECT * FROM ongkir");
						while($perongkir = $ambil->fetch_assoc()){
						?>
						<option value="<?php echo $perongkir["id_ongkir"]; ?>">
							<?php echo $perongkir['nama_kota'] ?> -
							Rp<?php echo number_format($perongkir['tarif']) ?>
						</option>
						<?php } ?> 
					</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>Alamat Lengkap</label>
				<textarea class="form-control" name="alamat_pengiriman" placeholder="Alamat lengkap pengiriman" required=""></textarea>
			</div>
			<br>
			<button class="btn btn-primary" name="checkout">Checkout</button>
		</form>

		<?php
		if (isset($_POST["checkout"]))
			{
			$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
			$id_ongkir = $_POST["id_ongkir"];
			$tanggal_pembelian = date("Y-m-d");
			$alamat_pengiriman = $_POST['alamat_pengiriman'];

			$ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
			$arrayongkir = $ambil->fetch_assoc();
			$nama_kota = $arrayongkir['nama_kota'];
			$tarif = $arrayongkir['tarif'];

			$total_pembelian = $totalbelanja + $tarif;

			$koneksi->query("INSERT INTO pembelian
							(id_pelanggan,
							id_ongkir,
							tanggal_pembelian,
							total_pembelian,
							nama_kota,
							tarif,
							alamat_pengiriman)
							VALUES
							('$id_pelanggan',
							'$id_ongkir',
							'$tanggal_pembelian',
							'$total_pembelian',
							'$nama_kota',
							'$tarif',
							'$alamat_pengiriman')");

			$id_pembelian_new = $koneksi->insert_id;

			foreach ($_SESSION["keranjang"] as $id_produk => $jumlah)
				{

					$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
					$perproduk = $ambil->fetch_assoc();

					$nama = $perproduk['nama_produk'];
					$harga = $perproduk['harga_produk'];

					$subharga = $perproduk['harga_produk']*$jumlah;

				$koneksi->query("INSERT INTO pembelian_produk 
								(id_pembelian,
								id_produk,
								nama,
								harga,
								subharga,
								jumlah)
								VALUES
								('$id_pembelian_new',
								'$id_produk',
								'$nama',
								'$harga',
								'$subharga',
								'$jumlah')");

				$koneksi->query("UPDATE produk SET 
								stok_produk=stok_produk -$jumlah 
								WHERE id_produk='$id_produk'");
			}

			unset($_SESSION["keranjang"]);

			echo "<script>alert('Pembelian berhasil.');</script>";
			echo "<script>location='nota.php?id=$id_pembelian_new';</script>";
			
		}
		?>
		
	</div>
</section>
<?php endif ?>
</body>
</html>