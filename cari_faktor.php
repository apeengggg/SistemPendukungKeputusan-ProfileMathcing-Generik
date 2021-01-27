<?php
    include "config/koneksi.php";
   
    $sel_faktor="select * from faktor where id_spk='".$_POST["spk"]."'";
    $q=mysql_query($sel_faktor);
    while($data_faktor=mysql_fetch_array($q)){
   
    ?>
        <option value="<?php echo $data_faktor["id_faktor"] ?>"><?php echo $data_prov["nama_faktor"] ?></option><br>
   
    <?php
    }
    ?>