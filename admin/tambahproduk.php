<?php
include 'security.php';
?>

<h2>Tambah Produk</h2>

<form method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama" required oninvalid="this.setCustomValidity('nama tidak boleh kosong.')" oninput="setCustomValidity('')">
	</div>
	<div class="form-group">
		<label>Harga</label>
		<input type="number" class="form-control" name="harga" required oninvalid="this.setCustomValidity('harga tidak boleh kosong.')" oninput="setCustomValidity('')">
	</div>
	<div class="form-group">
		<label>Stok</label>
		<input type="number" class="form-control" name="stok" required oninvalid="this.setCustomValidity('stok tidak boleh kosong.')" oninput="setCustomValidity('')">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea class="form-control" name="deskripsi" rows="10" required oninvalid="this.setCustomValidity('deskripsi tidak boleh kosong.')" oninput="setCustomValidity('')"></textarea>
	</div>
	<div class="form-group">
		<label>Foto</label>
		<input type="file" class="form-control" name="foto" required oninvalid="this.setCustomValidity('foto tidak boleh kosong.')" oninput="setCustomValidity('')">
	</div>
	<button class="btn btn-primary" name="simpan">Tambah</button>
</form>

<?php 
if (isset($_POST['simpan'])) 
{
	$nama = $_FILES['foto']['name'];
	$lokasi = $_FILES['foto']['tmp_name'];
	move_uploaded_file($lokasi, "../foto_produk/".$nama);
	$koneksi->query("INSERT INTO produk 
					(nama_produk, harga_produk,stok_produk, foto_produk, deskripsi_produk) 
					VALUES ('$_POST[nama]',
							'$_POST[harga]',
							'$_POST[stok]',
							'$nama',
							'$_POST[deskripsi]')");

	echo "<div class='alert alert-info'>Data berhasil disimpan.</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
}
?>
