<?php
session_start();
  if (!isset($_SESSION['id'])){
    header("Location: login.html");
  }

  $id=$_SESSION['id'];
  $judul=$_GET ["judul"];
  $isi=$_GET ["isi"];
  $id_kategori=$_GET ["id_kategori"];
  require_once ("koneksi.php");

  $query = "INSERT INTO pertayaan (id,id_user,judul,isi,id_kategori) VALUES (NULL,'$id','$judul','$isi','$id_kategori')";
	$hasil_mysql = mysqli_query($conn,$query) or die (mysqli_error($conn));
    //$result= mysqli_num_rows($hasil_mysql);
    header("location: ../views/dasboard.php");

?>

