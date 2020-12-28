<?php

session_start();
  if (!isset($_SESSION['id'])){
    header("Location: login.html");
  }

  $id=$_GET ["id"];
  $p=$_GET["p"];
  //var_dump(p);
  //var_dump($id_pertanyaan);
  require_once ("koneksi.php");

  $query = "DELETE FROM jawaban WHERE id like '$id'";
	$hasil_mysql = mysqli_query($conn,$query) or die (mysqli_error($conn));
    //$result= mysqli_num_rows($hasil_mysql);
    header("location: ../views/detail.php?id=$p ");

?>

