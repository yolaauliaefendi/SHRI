<?php 
include("koneksi.php");
$fakultas = $_POST['statuskeluar'];
$tampil=mysql_query("SELECT * FROM tblcarakeluar WHERE StatusKeluar='$fakultas'");
$jml=mysql_num_rows($tampil);
 
if($jml > 0){    
    while($r=mysql_fetch_array($tampil)){
        ?>
        <option value="<?php echo $r['Nama'] ?>"><?php echo $r['Nama'] ?></option>
        <?php        
    }
}else{
    echo "<option selected>- Data Tidak Ada -</option>";
}
 
?>