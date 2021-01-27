<?php
include "./config/koneksi.php";

$username=$_POST["username"];
$password=md5($_POST["password"]);
$email=$_POST["email"];


//cari user 
$sql=mysqli_query($koneksi, "SELECT* FROM user WHERE username='username' AND email='$email'");
$res=mysqli_num_rows($sql);
if($res==0)
{
    $update=mysqli_query($koneksi, "UPDATE user SET password='$password' WHERE username='$username' AND email='$email'");
    if($update)
    {
            ?>
                <script type="text/javascript">
                    window.alert("Berhasil mengganti password");
                    window.location.href="index.php";
                </script>
            <?php
    }
}else{
    ?>
        <script type="text/javascript">
            window.alert("Username atau email tidak terdaftar");
            window.location.href="index.php";
        </script>
    <?php 
}
?>
