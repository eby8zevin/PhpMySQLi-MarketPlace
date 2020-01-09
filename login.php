<?php 
//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>MarketPlace</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>


<div class="container" style="margin-top:8%">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<p>
				<center>
					<h2>MarketPlace : Login</h2>
				</center>
			</p>
			<br>
				 <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login ke akun anda</h3>
                    </div>
                    <div class="panel-body">
                        <form method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block" name="login">Log In</button>
                                <div class="checkbox">
                                    <label>Belum punya akun? <a href="daftar.php">Daftar</a></label>
                                </div>
                            </fieldset>
                        </form>

<?php

if (isset($_POST["login"])) 
    {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE username='$username' AND password='$password'");

    $cekakun = $ambil->num_rows;

    if ($cekakun==1)
        {
        $akun = $ambil->fetch_assoc();
        $_SESSION["pelanggan"] = $akun;

        echo "<script>alert('Login Sukses . . .');</script>";
        echo "<script>location='index.php'</script>";
    }
    else
        {
        echo "<script>alert('Login Gagal . . .');</script>";
        echo "<script>location='login.php?login=failed'</script>";
    }
} 

?>

                    </div>
                </div>
		</div>
	</div>

	<center>Copyright @ 2019 by : <a href="index.php" target="_blank">MarketPlace</a> All rights reserved.</center>

</div>

</body>
</html>



           