<?php
include 'koneksi.php';
include 'security.php';
?>

<h2>Detail Pembelian</h2>

<?php
	$ambil = $koneksi->query("SELECT * FROM pembelian 
							JOIN pelanggan 
							ON pembelian.id_pelanggan=pelanggan.id_pelanggan 
							WHERE pembelian.id_pembelian='$_GET[id]'");
	$detail = $ambil->fetch_assoc();
?>

<div class="row">
	<div class="col-md-4">
		<h4>Pembelian</h4>
		<strong>No. Tagihan : <?php echo $detail['id_pembelian']; ?></strong> <br>
		Tanggal : <?php echo $detail['tanggal_pembelian']; ?> <br>
	</div>
	<div class="col-md-4">
		<h4>Pelanggan</h4>
		<strong>Nama : <?php echo $detail['nama_pelanggan']; ?></strong> <br>
				HP : <?php echo $detail['hp_pelanggan']; ?> <br>
				Email : <?php echo $detail['email_pelanggan']; ?> <br>
	</div>
	<div class="col-md-4">
		<h4>Pengiriman</h4>
		<strong><?php echo $detail['nama_kota']; ?></strong> <br>
		Alamat : <?php echo $detail['alamat_pengiriman']; ?>
	</div>
</div>
<br>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Barang</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_produk']; ?></td>
			<td>Rp<?php echo number_format($pecah['harga_produk']); ?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td>Rp<?php echo number_format($pecah['harga_produk']*$pecah['jumlah']); ?></td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="4" style="text-align: left;">Ongkos Kirim</th>
			<th>Rp<?php echo number_format($detail['tarif']); ?></th>
		</tr>
		<tr>
			<th colspan="4" style="text-align: left;">Total Pembayaran</th>
			<th>Rp<?php echo number_format($detail['total_pembelian']); ?></th>
		</tr>
	</tfoot>

</table>