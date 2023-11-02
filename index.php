<?php
error_reporting(0);
session_start();
date_default_timezone_set('Asia/Jakarta');
$date = date_create(date("Y-m-d H:i:s"));
$vdate = date_format($date, 'Y-m-d H:i:s');

include "koneksi.php";

if ($_SESSION[level] == "1" or $_SESSION[level] == "2" or $_SESSION[level] == "3" or $_SESSION[level] == "4") {
$mysql=mysql_query("SELECT
  `tbluser`.`IDUser`,
  `tbluser`.`Username`,
  `tbllevel`.`NamaLevel`,
  `tblpetugas`.`Nama`,
  `tblpetugas`.`JenisKelamin`,
  `tblpetugas`.`Alamat`,
  `tblpetugas`.`Agama`,
  `tblpetugas`.`Kewarganegaraan`,
  `tblpetugas`.`Telp`
FROM
  `tbluser`
  INNER JOIN `tblpetugas` ON `tbluser`.`IDPetugas` = `tblpetugas`.`IDPetugas`
  INNER JOIN `tbllevel` ON `tbllevel`.`IDLevel` = `tbluser`.`IDLevel`
where IDUser = '$_SESSION[id]' limit 1");
$val=mysql_fetch_array($mysql);
include "header.php";
include "topbar.php";
include "leftmenu.php";
include "content.php";
include "footer.php";
}else{
  include "modul/login.php";
}

if ($_GET[act] == 'logout') {
  session_destroy();
  echo "<meta http-equiv='refresh' content='0;url=index.php'>";
  exit;
}

function tgl_indo($tg){
  $tgl = substr($tg,8,2);
  $bulan = getBulan(substr($tg,5,3));
  $tahun = substr($tg, 0, 4);
  $waktu = substr($tg,11,8);
  return $tgl." ".$bulan." ".$tahun." ".$waktu;
  }
  
  function  getBulan($bln){
  switch  ($bln){
  case  1:
  return  "Januari";
  break;
  case  2:
  return  "Februari";
  break;
  case  3:
  return  "Maret";
  break;
  case  4:
  return  "April";
  break;
  case  5:
  return  "Mei";
  break;
  case  6:
  return  "Juni";
  break;
  case  7:
  return  "Juli";
  break;
  case  8:
  return  "Agustus";
  break;
  case  9:
  return  "September";
  break;
  case  10:
  return  "Oktober";
  break;
  case  11:
  return  "November";
  break;
  case  12:
  return  "Desember";
  break;
  }
  }
?>