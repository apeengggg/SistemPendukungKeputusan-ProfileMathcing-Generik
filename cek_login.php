<?php
error_reporting(0);
include "./config/koneksi.php";
/*function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$username = anti_injection($_POST['username']);
$pass     = anti_injection(md5($_POST['password']));*/
 
$username = $_POST['email'];
$pass     = md5($_POST['password']);
// pastikan username dan password adalah berupa huruf atau angka.

// email dan password
  $login = mysqli_query($koneksi,"SELECT * FROM user WHERE email='$username' AND password='$pass'")or die (mysql_error());
  $ketemu=mysqli_num_rows($login);
  $r=mysqli_fetch_array($login);
  // Apabila username dan password ditemukan
  if ($ketemu > 0){
    $cek = mysqli_query($koneksi, "SELECT is_verif FROM user WHERE email='$username'");
    $result = mysqli_fetch_array($cek);
    $data = $result['is_verif'];
    if ($data==0) {
      ?>
                    <script type="text/javascript">
                    window.alert("Akun Anda Belum Diverifikasi, Silahkan Cek Email Anda");
                    window.location="index.php";
                    </script>       
    <?php
    }else{
    session_start();
    $_SESSION['id_user']     = $r['id_user'];
    $_SESSION['username']    = $r['username'];
    $_SESSION['nama']        = $r['nama'];
    $_SESSION['passuser']    = $r['password'];
    $_SESSION['level']       = $r['level'];
    $_SESSION['foto']        = $r['foto'];
    $_SESSION['aktif']       = $r['aktif'];
    $_SESSION['tlp']         = $r['tlp'];
    
    // session timeout
    //$_SESSION[login] = 1;
    //timer();
    //header('location:dashboard.php?module=home');
    ?>
    <br><br><br><br><br><br><br><br>
  <center><img src="updateimg.gif" width="100px"></center>
    <meta http-equiv="refresh" content="0.5;URL='dashboard.php?module=home'" />   
    <?php 
  }
}else{
    //header('location:index.php?msg=2');
      echo "<script>alert('username atau password anda salah'); window.location = 'index.php'</script>";
  }


?>
