<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../asset/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="../asset/jquery-3.5.1.slim.js"></script>
   <script src="../asset/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
    <title>Tanyakan</title>
</head>
<style>
@media only screen and (max-width: 600px) {
    #flex{
        flex-direction : column;
    }
}
</style>
<body>
  <?php
  require_once("../control/koneksi.php");
  require_once("../control/session-time.php");

  
  if (!isset($_SESSION['id'])){
    header("Location: login.html");
  }
  $id=$_SESSION['id'];
  $username=$_SESSION["username"];
  $kat=$_GET["kat"];
  ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-info p-3 fixed-top">
        <a class="navbar-brand" href="dasboard.php"><h3>Tanyakan</h3></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto ">
            
          </ul>
          <div class="nav-item mx-3"><?= $username ?>
            <i class="far fa-user"></i>
          </div>
          <a href="../control/logout-control.php" class="btn btn-danger active" role="button" aria-pressed="true">Logout</a>
        </div>
    </nav>

    <div class="container d-flex mt-5" id="flex">
        <div class="flex-grow-2 p-4 mt-3 border-right">
            <h4 class="ml-3">Kategori</h4>
            <ul class="nav flex-column">
            <?php 
              $query_kategori="SELECT * FROM kategori";
              $hasil_kategori = mysqli_query($conn,$query_kategori) or die (mysqli_error($conn));
              while($data_kategori= mysqli_fetch_assoc($hasil_kategori)){  ?>
                <li class="nav-item">
                  <a href="dasboard_search.php?kat=<?= $data_kategori["id"] ?>" class="nav-link">
                  <!-- jenis kategori start -->
                    <?= $data_kategori["jenis"] ?> 
                  <!-- jenis end -->
                  <!-- jumlah kategori -->
                    <span class="float-right badge badge-info ml-1">
                      <?php 
                            $id_kategori=$data_kategori["id"];
                            //var_dump($id_s);
                            $query_kat="SELECT id_kategori FROM pertayaan WHERE id_kategori = '$id_kategori'";
                            $hasil_query_kat = mysqli_query($conn,$query_kat) or die (mysqli_error($conn));
                            $data_kat=mysqli_num_rows($hasil_query_kat);
                            //var_dump($data_s);
                            echo($data_kat);
                      ?>
                    </span>
                  <!-- jumlah end -->
                  </a>
                </li>
              <?php } ?>  
              </ul>
        </div>

        <div class="flex-grow-1 p-4">
            <div class="col m-4 d-flex justify-content-center">
            <a href="buatpertayaan.php?" class="btn btn-primary btn-lg rounded-2">Buat Pertanyaan</a>
            </div>
            <div class="row">
              <p class="mx-auto">Tanyakan pertanyaaanmu sekarang ! Ribuan jawaban akan segera kamu dapatkan disini</p>
            </div>
            <div class="row mt-5">
                <h5 class="mx-auto font-weight-bold text-secondary"> Pencarian berdasarkan :
                    <?php
                    $query_kat="SELECT jenis FROM kategori WHERE id = '$kat'";
                            $hasil_query_kat = mysqli_query($conn,$query_kat) or die (mysqli_error($conn));
                            $data_c=mysqli_fetch_row($hasil_query_kat);
                            echo($data_c[0]);
                    ?>
                </h5>
            </div>
            
            <?php 
              $query="SELECT * FROM pertayaan WHERE id_kategori=$kat";
              $hasil_pertanyaan = mysqli_query($conn,$query) or die (mysqli_error($conn));
            while($data_pertanyaan= mysqli_fetch_assoc($hasil_pertanyaan)){  ?>
              <div class="card border-0 my-5">
                  <div class="card-body border-bottom">
                          <div class="d-flex justify-content-between align-items-center">
                              <h6 class="card-subtitle text-muted">
                              <?php 
                                      $id_s=$data_pertanyaan["id_user"];
                                      //var_dump($id_s);
                                      $query_user="SELECT username FROM user WHERE id = '$id_s'";
                                      $hasil_query_user = mysqli_query($conn,$query_user) or die (mysqli_error($conn));
                                      $data_s=mysqli_fetch_row($hasil_query_user);
                                      //var_dump($data_s);
                                      echo($data_s[0]);
                              ?></h6>
                              <?php  if( $data_pertanyaan["id_user"] == $id ) { ?>
                                  <div class="row mr-2">
                                      <a href="editpertanyaan.php?id=<?= $data_pertanyaan["id"] ?>"><i class="fas fa-edit "></i></a>
                                      <a href="../control/hapus-control.php?id=<?= $data_pertanyaan["id"] ?>"><i class="fas fa-trash-alt mx-3"></i></a>
                                  </div>
                              <?php } ?>
                          </div>
                    <h4 class="card-title"><a href="detail.php?id=<?= $data_pertanyaan["id"] ?>" class="text-reset"><?= $data_pertanyaan["judul"] ?></a></h4>
                    <p class="card-text"><?= $data_pertanyaan["isi"] ?></p>
                    <a href="#" class="card-link"><h4 class="far fa-thumbs-up"></h4></a>
                    <a href="detail.php?id=<?= $data_pertanyaan["id"] ?>" class="card-link"><h4 class="far fa-comment"></h4></a>
                    <a class="text-muted">
                        <?php
                            $id_p=$data_pertanyaan["id"];
                            $query_comen="SELECT * FROM jawaban WHERE id_tanya = '$id_p'";
                            $hasil_query_comen = mysqli_query($conn,$query_comen) or die (mysqli_error($conn));
                            $data_c=mysqli_num_rows($hasil_query_comen);
                            echo($data_c);
                        ?>
                    </a>
                  </div>
              </div>

            <?php } ?>
            

        </div>
    </div>
    
</body>
</html>