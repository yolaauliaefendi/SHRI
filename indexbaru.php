<?php
error_reporting(0);
session_start();
include "koneksi.php";
$mysql=mysql_query("SELECT IDPegawai, Nama, NIP, JenisKelamin, TempatLahir, TanggalLahir, Alamat, IDPendidikan, TahunLulus, TanggalBekerja, StatusKepeg, Gelar, Username, NamaMapel, NamaJabatan, Foto from pegawai left join jabatan on pegawai.IDJabatan = jabatan.IDJabatan left join kepeg on pegawai.IDKepeg = kepeg.IDKepeg left join mapel on pegawai.IDMapel = mapel.IDMapel where IDPegawai = '$_GET[idpegaw]' and pegawai.NA = 'N' limit 1");
$val=mysql_fetch_array($mysql);
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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>SIRI | Sistem Informasi Rawat Inap</title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <link rel="icon" href="assets/img/logo/logo5.jpg"/>
  <!-- ================== BEGIN BASE CSS STYLE ================== -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="assets/plugins/animate/animate.min.css" rel="stylesheet" />
  <link href="assets/css/default/style.min.css" rel="stylesheet" />
  <link href="assets/css/default/style-responsive.min.css" rel="stylesheet" />
  <link href="assets/css/default/theme/default.css" rel="stylesheet" id="theme" />
  <!-- ================== END BASE CSS STYLE ================== -->
  
  <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
  <link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
  <link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
  <!-- ================== END PAGE LEVEL STYLE ================== -->

  <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
  <link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
  <link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
    <link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
  <link href="assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
  <!-- ================== END PAGE LEVEL STYLE ================== -->

  
</head>
<body <?php if (empty($_GET[full])) { echo 'style="background: none;"'; } ?>>
  <!-- begin #page-container -->
  <div id="page-container" class="fade page-sidebar-fixed page-header-fixed" style="padding-top: 0">
    <!-- begin #content -->
    <div id="content" class="content <?=$_GET[full]?>" style="margin-left: 0;">
            <?php
            $fdl = 'modul/laporan';
            $fd = 'modul';
            if(!empty($_GET['actl'])){
                $p=$_GET['actl'];
                include ($fdl.'/'.$p.'.php');
            }elseif(!empty($_GET['act'])){
                $p=$_GET['act'];
                include ($fd.'/'.$p.'.php');
            }
            ?>
    </div>
    <!-- end #content -->
  </div>
  <!-- end page container -->
  
  <!-- ================== BEGIN BASE JS ================== -->
  <script src="assets/plugins/jquery/jquery-3.2.1.min.js"></script>
  <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
  <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="assets/plugins/js-cookie/js.cookie.js"></script>
  <script src="assets/js/theme/default.min.js"></script>
  <script src="assets/js/apps.min.js"></script>
  <!-- ================== END BASE JS ================== -->
  
  <!-- ================== BEGIN PAGE LEVEL JS ================== -->
  <script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
  <script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
  <script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
  <script src="assets/js/demo/table-manage-default.demo.min.js"></script>
  <!-- ================== END PAGE LEVEL JS ================== -->

  <!-- ================== BEGIN PAGE LEVEL JS ================== -->
  <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script src="assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
  <script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <script src="assets/plugins/masked-input/masked-input.min.js"></script>
  <script src="assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="assets/plugins/password-indicator/js/password-indicator.js"></script>
  <script src="assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
  <script src="assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
  <script src="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
  <script src="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
  <script src="assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
    <script src="assets/plugins/bootstrap-daterangepicker/moment.js"></script>
    <script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="assets/plugins/select2/dist/js/select2.min.js"></script>
  <script src="assets/plugins/bootstrap-show-password/bootstrap-show-password.js"></script>
  <script src="assets/js/demo/form-plugins.demo.min.js"></script>
  <!-- ================== END PAGE LEVEL JS ================== -->


  <script>
    $(document).ready(function() {
      App.init();
      TableManageDefault.init();
      FormPlugins.init();
    });
  </script>

</body>

<!-- Mirrored from seantheme.com/color-admin-v4.0/admin/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 19 Apr 2018 13:37:42 GMT -->
</html>

