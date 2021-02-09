<?php  
session_start();
error_reporting(0);
include "config/koneksi.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    APK PROMATCH GENERIK
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Canonical SEO -->
  <link rel="canonical" href="https://www.creative-tim.com/product/material-dashboard-pro" />
  <!--  Social tags      -->
  <meta name="keywords" content="creative tim, html dashboard, html css dashboard, web dashboard, bootstrap 4 dashboard, bootstrap 4, css3 dashboard, bootstrap 4 admin, material dashboard bootstrap 4 dashboard, frontend, responsive bootstrap 4 dashboard, material design, material dashboard bootstrap 4 dashboard">
  <meta name="description" content="Material Dashboard PRO is a Premium Material Bootstrap 4 Admin with a fresh, new design inspired by Google's Material Design.">
  <!-- Schema.org markup for Google+ -->
  <meta itemprop="name" content="Material Dashboard PRO by Creative Tim">
  <meta itemprop="description" content="Material Dashboard PRO is a Premium Material Bootstrap 4 Admin with a fresh, new design inspired by Google's Material Design.">
  <meta itemprop="image" content="https://s3.amazonaws.com/creativetim_bucket/products/51/original/opt_mdp_thumbnail.jpg">
  <!-- Twitter Card data -->
  <meta name="twitter:card" content="product">
  <meta name="twitter:site" content="@creativetim">
  <meta name="twitter:title" content="Material Dashboard PRO by Creative Tim">
  <meta name="twitter:description" content="Material Dashboard PRO is a Premium Material Bootstrap 4 Admin with a fresh, new design inspired by Google's Material Design.">
  <meta name="twitter:creator" content="@creativetim">
  <meta name="twitter:image" content="https://s3.amazonaws.com/creativetim_bucket/products/51/original/opt_mdp_thumbnail.jpg">
  <!-- Open Graph data -->
  <meta property="fb:app_id" content="655968634437471">
  <meta property="og:title" content="Material Dashboard PRO by Creative Tim" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="http://demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html" />
  <meta property="og:image" content="https://s3.amazonaws.com/creativetim_bucket/products/51/original/opt_mdp_thumbnail.jpg" />
  <meta property="og:description" content="Material Dashboard PRO is a Premium Material Bootstrap 4 Admin with a fresh, new design inspired by Google's Material Design." />
  <meta property="og:site_name" content="Creative Tim" />

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.min.css?v=2.1.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />

  <!-- dropdown bertingkat -->

 <script src="js/ie-emulation-modes-warning.js"></script>
 <script src="js/jquery-chained.min.js"></script>
 
</head>

<body class="">
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Google Tag Manager (noscript) -->
  
  <!-- End Google Tag Manager (noscript) -->
  <div class="wrapper ">
    <div class="sidebar" data-color="rose" data-background-color="black" data-image="assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a href="#" class="simple-text logo-mini">
          PM
        </a>
        <a href="?module=home" class="simple-text logo-normal">
          PROFILE MATCHING
        </a>
      </div>
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <?php  
              if($_SESSION["foto"]=="")
              {
                ?>
                  <img src="assets/img/faces/avatar.png" />
                <?php 
              }else{
                ?>
                  <img src="./foto/<?php echo $_SESSION['foto'] ?>" />
                <?php 
              }
            ?>
          </div>
          <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                
                <?php echo $_SESSION["nama"]; ?>
                <b class="caret"></b>
              </span>
            </a>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="?module=user&act=edit&id=<?php echo $_SESSION[id_user]; ?>">
                    <span class="sidebar-mini"> MP </span>
                    <span class="sidebar-normal"> My Profile </span>
                  </a>
                </li>
                
                <li class="nav-item">
                  <a class="nav-link" onclick='return confirm("Anda Yakin Ingin Keluar ?")' href="logout.php">
                    <span class="sidebar-mini"> L </span>
                    <span class="sidebar-normal"> Logout </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <?php  
          if($_SESSION["level"]=="admin")
          {
            ?>
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="?module=home">
                  <i class="material-icons">dashboard</i>
                  <p> Dashboard </p>
                </a>
              <li class="nav-item ">
                <a class="nav-link" href="?module=spk">
                  <i class="material-icons">equalizer</i>
                  <p> SPK </p>
                </a>
              </li>   
              <li class="nav-item ">
                <a class="nav-link" href="?module=spk&act=verif_spk">
                  <i class="material-icons">equalizer</i>
                  <p> SPK User </p>
                </a>
              </li>             
              <li class="nav-item ">
               <a class="nav-link" href="?module=aspek_spk">
                  <i class="material-icons">apps</i>
                  <p> Aspek </p>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="?module=faktor_spk">
                  <i class="material-icons">apps</i>
                  <p> Faktor </p>
                </a>
              </li>
                <li class="nav-item ">
                  <a class="nav-link" href="?module=bobot">
                    <i class="material-icons">apps</i>
                    <p> Bobot </p>
                  </a>
              </li>
              <!-- <li class="nav-item ">
                  <a class="nav-link" href="?module=alternatif_spk">
                    <i class="material-icons">person</i>
                    <p> Kandidat </p>
                  </a>
              </li>  -->    
                <!-- <li class="nav-item ">
                  <a class="nav-link" href="?module=promatch">
                    <i class="material-icons">star</i>
                    <p> Perhitungan </p>
                  </a>
              </li> -->
                <li class="nav-item ">
                  <a class="nav-link" href="?module=hasil">
                    <i class="material-icons">timeline</i>
                    <p> History </p>
                  </a>
              </li>
                <li class="nav-item ">
                  <a class="nav-link" href="?module=user">
                    <i class="material-icons">people</i>
                    <p> Operator </p>
                  </a>
              </li>
            </ul>
            <?php 
          }elseif($_SESSION["level"]=="user"){
                  ?>
                      <ul class="nav">
                          <li class="nav-item">
                            <a class="nav-link" href="?module=home">
                              <i class="material-icons">dashboard</i>
                              <p> Dashboard </p>
                            </a>
                            <li class="nav-item ">
                            <a class="nav-link" href="?module=alternatif_user">
                              <i class="material-icons">person</i>
                              <p> Kandidat </p>
                            </a>
                          </li> 
                          <li class="nav-item ">
                            <a class="nav-link" href="?module=spk&act=operator&id_user=<?=$_SESSION[id_user]?>">
                              <i class="material-icons">equalizer</i>
                              <p> SPK </p>
                            </a>
                          </li>  
                          <!-- <li class="nav-item ">
                            <a class="nav-link" href="?module=alternatif">
                              <i class="material-icons">person</i>
                              <p> Kandidat </p>
                            </a>
                          </li>               -->
                          <li class="nav-item ">
                            <a class="nav-link" href="?module=promatch">
                              <i class="material-icons">star</i>
                              <p> Seleksi </p>
                            </a>
                          </li>
                          <li class="nav-item ">
                            <a class="nav-link" href="?module=hasil">
                              <i class="material-icons">timeline</i>
                              <p> History </p>
                            </a>
                          </li>
                          <!-- <center>
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Kontak
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="#">WA :+6283824021662</a>
                            </div>
                            </center> -->
        </ul>
            <?php 
          }
        ?>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            
            <!-- <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="?module=user&act=edit&id=<?php echo $_SESSION[username]; ?>">Profile</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" onclick='return confirm("Anda Yakin Ingin Keluar ?")'href="logout.php">Log out</a>
                </div>
              </li>
            </ul> -->
            <!--  -->
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">phone</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="#">WA : 083824021622</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">EMAIL : suhardiman645@gmail.com</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
        <div class="content">
          <div class="container-fluid">
            <?php  
            switch($_GET['module'])
            {
                case "home" :
                if($_SESSION["level"]!="admin"){
                    ?>
                    <div class="callout">
                    <h3><font face ="Arial">Haloo <?php echo $_SESSION['username'] ?>, Selamat datang di Sistem Pendukung Keputusan Generik Metode Profile Matching </font></h3>
                    <div><font face="Times">Gunakan sistem ini untuk membantu menyelesaikan masalah yang anda hadapi dan merekomendasikan hasil keputusan yang terbaik, dengan cara :</font></div>
                     <p><font face= "Times">
                         1.Pilih SPK Yang Tersedia Untuk Menyelesaikan Kasus Anda Pada Menu SPK<br />
                         2.Tambah Kandidat (Alternatif) Yang Akan Anda Seleksi<br />
                         3.Masukan Nilai Untuk Kandidat Yang Akan Diseleksi Sesuai Dengan Kriteria Yang Ada <br />
                         4.Pilih Menu Seleksi<br/>
                         5.Hasil Keputusan Menggunakan Metode Profile Matching Dapat Dilihat Pada Menu History Atau Setelah Anda Melakukan Penyeleksian Pada Menu Seleksi<br/>
                         </font></p>
                         <hr color="black"/>
                         <center>
                         <h3><font face="Snell">~ Keputusan Tetap Ditangan Anda ~</font></h3>
                         </center> 
                         <hr color="black"/>
                         <div class="card ">
                            <div class="card-body ">
                                <div class="card-header card-header-success card-header-icon">
                                    <div class="card-icon">
                                      <i class="material-icons"></i>
                                    </div>
                                    <h4 class="card-title">Data SPK Yang Tersedia</h4>
                                </div>
                                <div class="table-responsive table-sales">
                                    <?php  
                                    if($_SESSION["level"]=="admin")
                                    {
                                      $sql=mysqli_query($koneksi,"SELECT * FROM spk ORDER BY id_spk ASC LIMIT 5") or die(mysqli_error($koneksi));
                                    }else{
                                      $sql=mysqli_query($koneksi,"SELECT DISTINCT spk.nama_spk, spk.keterangan, spk.tanggal, spk.id_spk FROM spk RIGHT JOIN aspek ON aspek.id_spk=spk.id_spk RIGHT JOIN faktor ON faktor.aspek=aspek.id_aspek WHERE aspek.id_aspek IS NOT NULL AND faktor.id_faktor IS NOT NULL AND spk.id_user='$_SESSION[id_user]' OR (spk.jenis=0 AND spk.status_verif=1) ORDER BY spk.id_spk ASC LIMIT 5") or die(mysqli_error($koneksi));
                                    }
                                    ?>
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                      <thead>
                                          <tr>
                                            <th width="40px">No</th>
                                            <th width="150px">Nama SPK</th>
                                            <th width="250px">Keterangan</th>
                                          </tr>
                                        </thead>
                                       <tbody>
                                      <?php  
                                      $no = 1;
                                      while($data=mysqli_fetch_array($sql)){
                                      ?>
                                      <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $data["nama_spk"] ?></td>
                                        <td><?php echo $data["keterangan"] ?></td>
                                      </tr>
                                    <?php } ?>
                                      </tbody>
                                    </table>
                                </div>
                              </div>
                              <hr>
                              <div class="card-footer">
                              <div class="stats">
                              </div>
                            </div>
                            </div>
                    <?php 
                  }else{
                    ?>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                          <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                              <div class="card-icon">
                                <i class="material-icons">weekend</i>
                              </div>
                              <p class="card-category">SPK</p>
                              <?php  
                              if($_SESSION["level"]=="admin")
                              {
                                $sql=mysqli_query($koneksi,"SELECT COUNT(id_spk) as spk FROM spk") or die(mysqli_error($koneksi));
                              }else{
                                $sql=mysqli_query($koneksi,"SELECT COUNT(id_spk) as spk FROM spk WHERE id_user='$_SESSION[id_user]'") or die(mysqli_error($koneksi));
                              }
                              $data=mysqli_fetch_array($sql);
                              ?>
                              <h3 class="card-title"><?php echo $data['spk'] ?></h3>
                            </div>
                            <div class="card-footer">
                              <div class="stats">
                                <i class="material-icons text-danger">warning</i>
                                <a href="">Data SPK</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                          <div class="card card-stats">
                            <div class="card-header card-header-rose card-header-icon">
                              <div class="card-icon">
                                <i class="material-icons">equalizer</i>
                              </div>
                               <?php  
                              if($_SESSION["level"]=="admin")
                              {
                                $sql=mysqli_query($koneksi,"SELECT COUNT(id_aspek) as aspek FROM aspek") or die(mysqli_error($koneksi));
                              }else{
                                $sql=mysqli_query($koneksi,"SELECT COUNT(id_aspek) as aspek FROM aspek WHERE id_user='$_SESSION[id_user]'") or die(mysqli_error($koneksi));
                              }
                              $data=mysqli_fetch_array($sql);
                              ?>
                              <p class="card-category">Data Aspek</p>
                              <h3 class="card-title"><?php echo $data['aspek'] ?></h3>
                            </div>
                            <div class="card-footer">
                              <div class="stats">
                                <i class="material-icons">local_offer</i> Data Aspek
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                          <div class="card card-stats">
                            <div class="card-header card-header-success card-header-icon">
                              <div class="card-icon">
                                <i class="material-icons">store</i>
                              </div>
                              <?php  
                              if($_SESSION["level"]=="admin")
                              {
                                $sql=mysqli_query($koneksi,"SELECT COUNT(id_faktor) as faktor FROM faktor") or die(mysqli_error($koneksi));
                              }else{
                                $sql=mysqli_query($koneksi,"SELECT COUNT(id_faktor) as faktor FROM faktor WHERE id_user='$_SESSION[id_user]'") or die(mysqli_error($koneksi));
                              }
                              $data=mysqli_fetch_array($sql);
                              ?>
                              <p class="card-category">Data Faktor</p>
                              <h3 class="card-title"><?php echo $data['faktor'] ?></h3>
                            </div>
                            <div class="card-footer">
                              <div class="stats">
                                <i class="material-icons">date_range</i> Data Faktor
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                          <div class="card card-stats">
                            <div class="card-header card-header-info card-header-icon">
                              <div class="card-icon">
                                <i class="fa fa-users"></i>
                              </div>
                              <?php  
                              $sql=mysqli_query($koneksi,"SELECT COUNT(username) as user FROM user") or die(mysqli_error($koneksi));
                              $data=mysqli_fetch_array($sql);
                              ?>
                              <p class="card-category">Operator</p>
                              <h3 class="card-title"><?php echo $data['user'] ?></h3>
                            </div>
                            <div class="card-footer">
                              <div class="stats">
                                <i class="material-icons">update</i> Data User
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="card ">
                            <div class="card-body ">
                                <div class="card-header card-header-success card-header-icon">
                                    <div class="card-icon">
                                      <i class="material-icons"></i>
                                    </div>
                                    <h4 class="card-title">Data SPK</h4>
                                </div>
                                <div class="table-responsive table-sales">
                                    <?php  
                                    if($_SESSION["level"]=="admin")
                                    {
                                      $sql=mysqli_query($koneksi,"SELECT * FROM spk ORDER BY id_spk ASC LIMIT 5") or die(mysqli_error($koneksi));
                                    }else{
                                      $sql=mysqli_query($koneksi,"SELECT * FROM spk WHERE id_user='$_SESSION[id_user]' ORDER BY id_spk ASC LIMIT 5") or die(mysqli_error($koneksi));
                                    }
                                    ?>
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                      <thead>
                                          <tr>
                                            <th>Nama SPK</th>
                                          </tr>
                                        </thead>
                                       <tbody>
                                      <?php  
                                      while($data=mysqli_fetch_array($sql)){
                                      ?>
                                      <tr>
                                        <td><?php echo $data["nama_spk"] ?></td>
                                      </tr>
                                    <?php } ?>
                                      </tbody>
                                    </table>
                                </div>
                              </div>
                              <hr>
                              <div class="card-footer">
                              <div class="stats">
                              </div>
                            </div>
                            </div>
                          </div>

                          
                          <div class="col-md-6">
                            <div class="card ">
                              <div class="card-body ">
                                <div class="card-header card-header-info card-header-icon">
                                  <div class="card-icon">
                                    <i class="material-icons"></i>
                                  </div>
                                  <h4 class="card-title">Aspek</h4>
                                </div>
                                <div class="table-responsive table-sales">
                                  <?php  
                                  if($_SESSION["level"]=="admin")
                                    {
                                      $sql=mysqli_query($koneksi,"SELECT * FROM aspek ORDER BY id_aspek ASC LIMIT 5") or die(mysqli_error($koneksi));
                                    }else{
                                      $sql=mysqli_query($koneksi,"SELECT * FROM aspek WHERE id_user='$_SESSION[id_user]' ORDER BY id_aspek ASC LIMIT 5") or die(mysqli_error($koneksi));
                                    }
                                  ?>
                                  <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                    <tr>
                                      <th>Nama Aspek</th>
                                      <th>Bobot</th>
                                    </tr>
                                    </thead>
                                     <tbody>
                                    <?php  
                                    while($data=mysqli_fetch_array($sql)){
                                    ?>
                                    <tr>
                                      <td><?php echo $data["nama_aspek"] ?></td>
                                      <td><?php echo $data["bobot"] ?></td>
                                    </tr>
                                  <?php } ?>
                                    </tbody>
                                  </table>
                                </div>
                            </div>
                            <hr>
                              <div class="card-footer">
                              <div class="stats">
                              </div>
                            </div>
                          </div>
                        </div>
                    <?php
                  }
                    break;
                    case "user" :
                        include "modul/user/user.php";
                    break;
                    case "spk" :
                        include "modul/spk/spk.php";
                    break;
                    case "aspek_spk" :
                        include "modul/aspek/spk.php";
                    break;
                    case "aspek" :
                        include "modul/aspek/aspek.php";
                    break;
                    case "faktor" :
                        include "modul/faktor/faktor.php";
                    break;
                    case "faktor_spk" :
                        include "modul/faktor/spk.php";
                    break;
                    case "bobot" :
                        include "modul/bobot/bobot.php";
                    break;
                    case "bobot_spk" :
                        include "modul/bobot/spk.php";
                    break;
                    case "alternatif" :
                        include "modul/alternatif/alternatif.php";
                    break;
                    case "alternatif_user" :
                      include "modul/alternatif/alternatif_user.php";
                  break;
                    case "alternatif_spk" :
                        include "modul/alternatif/spk.php";
                    break;
                    case "promatch" :
                        include "modul/promatch/promatch.php";
                    break;
                    case "proses_promatch" :
                        include "modul/promatch/proses_promatch.php";
                    break;
                    case "nilai" :
                        include "modul/nilai/nilai.php";
                    break;
                    case "hasil" :
                        include "modul/hasil/hasil.php";
                    break;
                  }
                ?>
              </div>

              <footer class="footer">
                <div class="container-fluid">
                  
                   
                
              <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="assets/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="assets/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="assets/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="assets/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="assets/js/plugins/arrive.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Chartist JS -->
  <script src="assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
  <!-- Sharrre libray -->
  <script src="assets/demo/jquery.sharrre.js"></script>
  <script>
    $(document).ready(function() {


      $('#facebook').sharrre({
        share: {
          facebook: true
        },
        enableHover: false,
        enableTracking: false,
        enableCounter: false,
        click: function(api, options) {
          api.simulateClick();
          api.openPopup('facebook');
        },
        template: '<i class="fab fa-facebook-f"></i> Facebook',
        url: 'https://demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html'
      });

      $('#google').sharrre({
        share: {
          googlePlus: true
        },
        enableCounter: false,
        enableHover: false,
        enableTracking: true,
        click: function(api, options) {
          api.simulateClick();
          api.openPopup('googlePlus');
        },
        template: '<i class="fab fa-google-plus"></i> Google',
        url: 'https://demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html'
      });

      $('#twitter').sharrre({
        share: {
          twitter: true
        },
        enableHover: false,
        enableTracking: false,
        enableCounter: false,
        buttons: {
          twitter: {
            via: 'CreativeTim'
          }
        },
        click: function(api, options) {
          api.simulateClick();
          api.openPopup('twitter');
        },
        template: '<i class="fab fa-twitter"></i> Twitter',
        url: 'https://demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html'
      });


      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-46172202-1']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
      })();

      // Facebook Pixel Code Don't Delete
      ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
          n.callMethod ?
            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
      }(window,
        document, 'script', '//connect.facebook.net/en_US/fbevents.js');

      try {
        fbq('init', '111649226022273');
        fbq('track', "PageView");

      } catch (err) {
        console.log('Facebook Track Error:', err);
      }

    });
  </script>
  <noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=111649226022273&ev=PageView&noscript=1" />
  </noscript>
  <script>
    $(document).ready(function() {
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search records",
        }
      });

      var table = $('#datatable').DataTable();

      // Edit record
      table.on('click', '.edit', function() {
        $tr = $(this).closest('tr');
        var data = table.row($tr).data();
        alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
      });

      // Delete a record
      table.on('click', '.remove', function(e) {
        $tr = $(this).closest('tr');
        table.row($tr).remove().draw();
        e.preventDefault();
      });

      //Like record
      table.on('click', '.like', function() {
        alert('You clicked on Like button');
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $('#datatables2').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search records",
        }
      });

      var table = $('#datatable').DataTable();

      // Edit record
      table.on('click', '.edit', function() {
        $tr = $(this).closest('tr');
        var data = table.row($tr).data();
        alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
      });

      // Delete a record
      table.on('click', '.remove', function(e) {
        $tr = $(this).closest('tr');
        table.row($tr).remove().draw();
        e.preventDefault();
      });

      //Like record
      table.on('click', '.like', function() {
        alert('You clicked on Like button');
      });
    });
  </script>

  <script>
    $(document).ready(function() {
        $("#id_aspek").chained("#id_spk");
    });
  </script>
</body>
</html>