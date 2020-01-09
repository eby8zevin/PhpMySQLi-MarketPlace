<?php 
//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>MarketPlace</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>

<div class="container" style="margin-top:3%">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<p>
				<center>
					<h2>MarketPlace : Daftar</h2>
				</center>
			</p>
			<br>

			<div class="login-panel panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Daftar akun baru sekarang</h3>
			</div>
			<div class="panel-body"> 
			<form class="form-horizontal" method="post">
				<div class="box-body">
					<div class="form-group">
						<label class="col-sm-3 control-label" style="text-align: left">Nama</label>

						<div class="col-sm-9">
							<input type="text" name="nama" class="form-control" placeholder="Nama" required oninvalid="this.setCustomValidity('nama tidak boleh kosong')" oninput="setCustomValidity('')">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" style="text-align: left">Email</label>

						<div class="col-sm-9">
							<input type="email" name="email" class="form-control" placeholder="@ Email" required oninvalid="this.setCustomValidity('email tidak boleh kosong')" oninput="setCustomValidity('')">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" style="text-align: left">No. HP</label>

						<div class="col-sm-9">
							<input type="number" name="hp" class="form-control" placeholder="+62345678910" required oninvalid="this.setCustomValidity('no. hp tidak boleh kosong')" oninput="setCustomValidity('')">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" style="text-align: left">Username</label>

						<div class="col-sm-9">
							<input type="text" name="username" class="form-control" placeholder="Username" required oninvalid="this.setCustomValidity('username tidak boleh kosong')" oninput="setCustomValidity('')">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" style="text-align: left">Password</label>

						<div class="col-sm-9">
							<input type="password" name="password" class="form-control" placeholder="Password" required oninvalid="this.setCustomValidity('password tidak boleh kosong')" oninput="setCustomValidity('')">
						</div>
					</div>
				</div>
					<button type="submit" class="btn btn-lg btn-success btn-block" name="daftar">Daftar</button>
				<div class="form-group">
				  <div class="col-sm-offset-0 col-sm-12">
				  	<div class="checkbox">
						<label>Sudah punya akun? <a href="login.php">Login</a></label>
					</div>
				  </div>
				</div>
			</form>

<?php 
if (isset($_POST["daftar"])) 
	{
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$hp = $_POST['hp'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
	$yangcocok = $ambil->num_rows;
	if ($yangcocok==1) 
		{
		echo "<script>alert('Pendaftaran gagal, email sudah digunakan.')</script>";
		echo "<script>location='daftar.php'</script>";
	}
	else
		{
		$koneksi->query("INSERT INTO pelanggan (nama_pelanggan,
											email_pelanggan,
											hp_pelanggan,
											username,
											password)
											VALUES
											('$nama',
											'$email',
											'$hp',
											'$username',
											'$password')");

		echo "<script>alert('Pendaftaran berhasil, silakan login.')</script>";
		echo "<script>location='login.php'</script>";
	}
}
?>

			</div>
			</div>
		</div>
	</div>

	<center>Copyright @ 2019 by : <a href="index.php" target="_blank">MarketPlace</a> All rights reserved.</center>

</div>
	<script type="text/javascript" src="style/jquery.js"></script>
	<script type="text/javascript" src="style/bootstrap.js"></script>	
	<script type="text/javascript" src="script.js"></script>	
</body>
</html>



           