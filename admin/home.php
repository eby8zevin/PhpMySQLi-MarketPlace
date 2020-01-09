<?php
include 'security.php';
?>

<h2>Selamat Datang,</h2>
<h3><strong><?php echo $_SESSION['admin']['nama_lengkap']; ?></strong><h3>

<pre><?php print_r($_SESSION); ?></pre>