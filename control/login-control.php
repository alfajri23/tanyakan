<?php

include("koneksi.php");

$email=$_POST["email"];
$password = $_POST["password"];


$query= "SELECT * FROM user WHERE email='$email' and password='$password'";

$cek_data= mysqli_query($conn,$query) or die(mysqli_error($conn));

$result= mysqli_fetch_assoc($cek_data);

if($result > 0){
    session_start();
    $_SESSION["id"]=$result["id"];
    $_SESSION["username"]=$result["username"];
    header("location: ../views/dasboard.php ");
}
else{
    header("location: ../views/login.html ");
}