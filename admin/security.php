<?php
if (!isset($_SESSION['admin']))
{
  echo "<script>alert('Anda harus login !');</script>";
  echo "<script>location='login.php';</script>";
  header('location:login.php');
  exit();
}
?>