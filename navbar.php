<!-- navbar -->
<nav class="navbar navbar-default">
	<div class="container">
		<ul class="nav navbar-nav">
			<li><a href="index.php">Home</a></li>
			<li><a href="keranjang.php">Keranjang Belanja</a></li>
			<li><a href="riwayat.php">Status Transaksi</a></li>
		</ul>

		<ul class="nav navbar-nav navbar-right">
        <li style="padding: 15px; font-weight: bold; color: red;"> <?php echo sekarang(); ?></li>

			<?php if (isset($_SESSION["pelanggan"])): ?>
				<li><a href="logout.php" class="btn btn-default active">Log Out</a></li>
			<?php else: ?>
				<li><a href="login.php" class="btn btn-default active">Log In</a></li>
			<?php endif ?>

      	</ul>

      	<form action="pencarian.php" method="GET" class="navbar-form navbar-right">
      		<input type="text" name="cari" class="form-control"> &nbsp;
      		<button class="btn btn-primary">Cari</button>
      	</form>
	</div>
</nav>