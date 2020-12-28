<?php
include("koneksi.php");

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

$query= "SELECT * FROM user WHERE email='$email' and username='$username'";

$cek_data= mysqli_query($conn,$query) or die(mysqli_error($conn));

$result= mysqli_num_rows($cek_data);

//var_dump($result);
if($result >= 1){
    header("Location: ../views/login.html");
}
else{
    $query_db="INSERT INTO user(id,username,email,password) values (NULL,'$username','$email','$password')";
    $data=mysqli_query($conn,$query_db) or die(mysqli_error($conn));

    header("location: ../views/login.html");
}

?>