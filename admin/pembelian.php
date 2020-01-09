<?php
include 'security.php';
?>

<h2>Data Pembelian</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th style="text-align: center;">No</th>
			<th>Nama Pelanggan</th>
			<th style="text-align: center;">Tanggal</th>
			<th style="text-align: center;">Status</th>
			<th style="text-align: center;">Total</th>
			<th style="text-align: center;">Opsi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil = $koneksi->query("SELECT * FROM pembelian 
										JOIN pelanggan 
										ON pembelian.id_pelanggan=pelanggan.id_pelanggan"); ?>
		<?php while($pecah = $ambil->fetch_assoc()) { ?>
		<tr>
			<td style="text-align: center;"><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_pelanggan']; ?></td>
			<td><?php echo $pecah['tanggal_pembelian']; ?></td>
			<td><?php echo $pecah['status_pembelian']; ?></td>
			<td>Rp<?php echo number_format($pecah['total_pembelian']); ?></td>
			<td style="text-align: center;">
				<a href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian'];?>" class="btn btn-info">Detail</a>

				<?php if ($pecah['status_pembelian']!=="Menunggu Pembayaran"): ?>
					<a href="index.php?halaman=pembayaran&id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-success" onclick="alert('Jika status Dibayar masukkan No. Resi Pengiriman dihalaman berikut ini.')">Lihat Pembayaran</a>
				<?php endif ?>

			</td>
		</tr>
		<?php $nomor++ ?>
		<?php } ?>
	</tbody>
</table>