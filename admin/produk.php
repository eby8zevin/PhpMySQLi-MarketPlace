<?php
include 'koneksi.php';

if (!isset($_SESSION['admin']))
{
  echo "<script>alert('Anda harus login !');</script>";
  echo "<script>location='login.php';</script>";
  header('location:login.php');
  exit();
}
?>

<h2>Data Produk <a href="index.php?halaman=tambahproduk" class="btn btn-primary" style="float: right;">Tambah Produk</a></h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th style="text-align: center;">No</th>
			<th style="text-align: center;">Nama</th>
			<th style="text-align: center;">Harga</th>
			<th style="text-align: center;">Foto</th>
			<th style="text-align: center;">Opsi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
			<td style="text-align: center;"><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_produk']; ?></td>
			<td>Rp<?php echo  number_format($pecah['harga_produk']); ?></td>
			<td style="text-align: center;">
				<img src="../foto_produk/<?php echo $pecah['foto_produk']; ?>" width="100">
			</td>
			<td style="text-align: center;">
				<a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn-danger btn">Hapus</a>
				<a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-warning">Edit</a>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>