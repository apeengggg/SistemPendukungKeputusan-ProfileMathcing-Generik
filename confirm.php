<?php
include "config/koneksi.php";
if (isset($_GET)) {
    $code = $_GET['code'];

    // cek apakah ada kode tersebut ?
    $sql = "SELECT verif_code FROM user WHERE verif_code='$code'";
    $query = mysqli_query($koneksi, $sql);
    if (mysqli_num_rows($query)==1) {
        // die;
        $sql = "UPDATE user SET is_verif=1 WHERE verif_code='$code'";
        $query1 = mysqli_query($koneksi, $sql);
        if ($query1) {
            ?>
                <script type="text/javascript">
                window.alert("Berhasil Verifikasi ! Silahkan Login Untuk Mengakses Sistem");
                window.location="index.php";
                </script>       
<?php
        }else{
            ?>
            <script type="text/javascript">
            window.alert("Gagal Verifikasi!");
            window.location="index.php";
            </script>       
<?php
        }
    }else{
        ?>
            <script type="text/javascript">
            window.alert("Gagal Konfirmasi!");
            window.location="index.php";
            </script>       
<?php
    }
}


?>