<?php
include 'security.php';
?>

<h2>Data Pelanggan</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th style="text-align: center;">No</th>
			<th>Nama Pelanggan</th>
			<th style="text-align: center;">Email</th>
			<th style="text-align: center;">HP</th>
			<th style="text-align: center;">Opsi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil = $koneksi->query("SELECT * FROM pelanggan"); ?>
		<?php while($pecah = $ambil->fetch_assoc()){?>
		<tr>
			<td style="text-align: center;"><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_pelanggan']; ?></td>
			<td><?php echo $pecah['email_pelanggan']; ?></td>
			<td><?php echo $pecah['hp_pelanggan']; ?></td>
			<td style="text-align: center;">
				<a href="" class="btn btn-danger">Hapus</a>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>