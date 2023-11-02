<?php
if (empty($_GET[datestart]) and empty($_GET[dateend])) { 
  $title = "-"; 
  $disable = 'disabled="disabled"';
  $col = "col-lg-12";
}else{
  $title = tgl_indo($_GET[datestart]).'- '.tgl_indo($_GET[dateend]);
  $vstart = date_format(date_create("$_GET[datestart]"), "m/d/Y");
  $vend = date_format(date_create("$_GET[dateend]"), "m/d/Y");
}
?>
            <ol class="breadcrumb pull-right">
                <li class="breadcrumb-item"><a href="?act=dashboard&actv=d">Home</a></li>
                <li class="breadcrumb-item active">Laporan Penyakit</li>
            </ol>

            <h1 class="page-header">Laporan Riwayat Penyakit</h1>
                        
            <div class="row">
                <div class="<?=$col?> ui-sortable">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                        <div class="panel-heading ui-sortable-handle">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-refresh"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 style="color: inherit; font-size: 12px; line-height: 20px; margin-bottom: 0; margin-top: 0;">Laporan Penyakit Per <?=$title;?></h4>
                        </div>

                        <div class="panel-body">
                        <div class="panel-body panel-form">
                            <form class="form-horizontal" method="post">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">Pilih Tanggal</label>
                                    <div class="col-md-8">
                                        <div class="input-group input-daterange">
                                            <input type="text" class="form-control" name="start" value='<?php echo $vstart; ?>' placeholder="Tanggal Mulai" required />
                                            <span class="input-group-addon">-</span>
                                            <input type="text" class="form-control" name="finish" value='<?php echo $vend; ?>' placeholder="Tanggal Selesai" required />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                      <button class="btn btn-primary" type="submit" name="filter"><em class="fa fa-filter"></em> &nbsp;Filter</button>
                                      <?php 
                                      if (empty($disable)) {
                                      ?>
                                      <a href="#" class="btn btn-default" onclick="window.open('indexbaru.php?actl=c_lap_riwayat_penyakit&datestart=<?=$_GET[datestart]?>&dateend=<?=$_GET[dateend]?>', 'Laporan Penyakit', 'width=800,height=500');"><em class="fa fa-print"></em> &nbsp;Cetak</a>
                                      <?php } ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <?php
                        if (isset($_GET[datestart]) and isset($_GET[dateend])) { 
                        ?>
                                        <table id="data-table-default" class="table table-striped table-bordered" style="text-align: center;">
                                            <thead>
                                                <tr>
                                                    <th width="1%" rowspan="3" data-orderable="false"><div align="center">No</div></th>
                                                    <th rowspan="3" data-orderable="false">Kode ICD-10</th>
                                                    <th rowspan="3" data-orderable="false">Nama Penyakit</th>
                                                    <th colspan="18" data-orderable="false">Jumlah Pasien Hidup dan Mati Menurut Golongan Umur & Jenis Kelamin</th>
                                                    <th colspan="2" rowspan="2" width="3%" data-orderable="false">Pasien Keluar (Hidup & Mati) Menurut Jenis Kelamin</th>
                                                    <th rowspan="3" data-orderable="false">Jumlah Pasien Keluar Hidup</th>

                                                    <th rowspan="3" data-orderable="false">Jumlah Pasien Keluar Mati</th>
                                                </tr>
                                                <tr>
                                                    <th colspan="2" data-orderable="false">0-6hr</th>
                                                    <th colspan="2" data-orderable="false">7-28hr</th>
                                                    <th colspan="2" data-orderable="false">29hr-&lt;1hr</th>
                                                    <th colspan="2" data-orderable="false">1-4th</th>
                                                    <th colspan="2" data-orderable="false">5-14th</th>
                                                    <th colspan="2" data-orderable="false">15-24th</th>
                                                    <th colspan="2" data-orderable="false">25-44th</th>
                                                    <th colspan="2" data-orderable="false">45-64th</th>
                                                    <th colspan="2" data-orderable="false">&gt;64th</th>
                                                </tr>
                                                <tr>
                                                    <th data-orderable="false">L</th>
                                                    <th data-orderable="false">P</th>
                                                    <th data-orderable="false">L</th>
                                                    <th data-orderable="false">P</th>
                                                    <th data-orderable="false">L</th>
                                                    <th data-orderable="false">P</th>
                                                    <th data-orderable="false">L</th>
                                                    <th data-orderable="false">P</th>
                                                    <th data-orderable="false">L</th>
                                                    <th data-orderable="false">P</th>
                                                    <th data-orderable="false">L</th>
                                                    <th data-orderable="false">P</th>
                                                    <th data-orderable="false">L</th>
                                                    <th data-orderable="false">P</th>
                                                    <th data-orderable="false">L</th>
                                                    <th data-orderable="false">P</th>
                                                    <th data-orderable="false">L</th>
                                                    <th data-orderable="false">P</th>
                                                    <th data-orderable="false">LK</th>
                                                    <th data-orderable="false">PR</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $no = 0;
                                                $sqld = mysql_query("SELECT
  a.IDRiwayat, a.IDDiagnosa, b.Nama, b.KodeICD, b.Deskripsi,
     count(a.IDDiagnosa) as jumlah
FROM
  tblriwayat a
  INNER JOIN tbldiagnosa b ON a.IDDiagnosa = b.IDDiagnosa
  where substr(TglKeluar,1,10) between '$_GET[datestart]' and '$_GET[dateend]'
Group by IDDiagnosa order by count(a.IDDiagnosa) desc");
                                                while ($vdat = mysql_fetch_array($sqld)) { $no++;
                                                $qwr = "SELECT count(*) as jumlah FROM tblriwayat INNER JOIN tblpasien ON tblpasien.IDPasien = tblriwayat.IDPasien where tblriwayat.IDDiagnosa = '$vdat[IDDiagnosa]' and TglKeluar != '0000-00-00 00:00:00'";
                                            ?>
                                                <tr>
                                                    <td><?=$no?></td>
                                                    <td><?=$vdat[KodeICD]?></td>
                                                    <td><?=$vdat[Nama]?></td>
                                                    <td>
                                                        <?php 
                                                            $L0to6 = mysql_fetch_array(mysql_query("$qwr and TIMESTAMPDIFF(DAY, TanggalLahir, CURDATE()) BETWEEN 0 and 6 and JenisKelamin = 'L'"));
                                                            echo $L0to6[jumlah];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $P0to6 = mysql_fetch_array(mysql_query("$qwr and TIMESTAMPDIFF(DAY, TanggalLahir, CURDATE()) BETWEEN 0 and 6 and JenisKelamin = 'P'"));
                                                            echo $P0to6[jumlah];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $L7to28 = mysql_fetch_array(mysql_query("$qwr and TIMESTAMPDIFF(DAY, TanggalLahir, CURDATE()) BETWEEN 7 and 28 and JenisKelamin = 'L'"));
                                                            echo $L7to28[jumlah];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $P7to28 = mysql_fetch_array(mysql_query("$qwr and TIMESTAMPDIFF(DAY, TanggalLahir, CURDATE()) BETWEEN 7 and 28 and JenisKelamin = 'P'"));
                                                            echo $P7to28[jumlah];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $L29to364 = mysql_fetch_array(mysql_query("$qwr and TIMESTAMPDIFF(DAY, TanggalLahir, CURDATE()) BETWEEN 29 and 364 and JenisKelamin = 'L'"));
                                                            echo $L29to364[jumlah];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $P29to364 = mysql_fetch_array(mysql_query("$qwr and TIMESTAMPDIFF(DAY, TanggalLahir, CURDATE()) BETWEEN 29 and 364 and JenisKelamin = 'P'"));
                                                            echo $P29to364[jumlah];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $L1to4 = mysql_fetch_array(mysql_query("$qwr and TIMESTAMPDIFF(YEAR, TanggalLahir, CURDATE()) BETWEEN 1 and 4 and JenisKelamin = 'L'"));
                                                            echo $L1to4[jumlah];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $L1to4 = mysql_fetch_array(mysql_query("$qwr and TIMESTAMPDIFF(YEAR, TanggalLahir, CURDATE()) BETWEEN 1 and 4 and JenisKelamin = 'P'"));
                                                            echo $L1to4[jumlah];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $L5to14 = mysql_fetch_array(mysql_query("$qwr and TIMESTAMPDIFF(YEAR, TanggalLahir, CURDATE()) BETWEEN 5 and 14 and JenisKelamin = 'L'"));
                                                            echo $L5to14[jumlah];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $P5to14 = mysql_fetch_array(mysql_query("$qwr and TIMESTAMPDIFF(YEAR, TanggalLahir, CURDATE()) BETWEEN 5 and 14 and JenisKelamin = 'P'"));
                                                            echo $P5to14[jumlah];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $L15to24 = mysql_fetch_array(mysql_query("$qwr and TIMESTAMPDIFF(YEAR, TanggalLahir, CURDATE()) BETWEEN 15 and 24 and JenisKelamin = 'L'"));
                                                            echo $L15to24[jumlah];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $P15to24 = mysql_fetch_array(mysql_query("$qwr and TIMESTAMPDIFF(YEAR, TanggalLahir, CURDATE()) BETWEEN 15 and 24 and JenisKelamin = 'P'"));
                                                            echo $P15to24[jumlah];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $L25to44 = mysql_fetch_array(mysql_query("$qwr and TIMESTAMPDIFF(YEAR, TanggalLahir, CURDATE()) BETWEEN 25 and 44 and JenisKelamin = 'L'"));
                                                            echo $L25to44[jumlah];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $P25to44 = mysql_fetch_array(mysql_query("$qwr and TIMESTAMPDIFF(YEAR, TanggalLahir, CURDATE()) BETWEEN 25 and 44 and JenisKelamin = 'P'"));
                                                            echo $P25to44[jumlah];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $L45to64 = mysql_fetch_array(mysql_query("$qwr and TIMESTAMPDIFF(YEAR, TanggalLahir, CURDATE()) BETWEEN 45 and 64 and JenisKelamin = 'L'"));
                                                            echo $L45to64[jumlah];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $P45to64 = mysql_fetch_array(mysql_query("$qwr and TIMESTAMPDIFF(YEAR, TanggalLahir, CURDATE()) BETWEEN 45 and 64 and JenisKelamin = 'P'"));
                                                            echo $P45to64[jumlah];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $Lto64 = mysql_fetch_array(mysql_query("$qwr and TIMESTAMPDIFF(YEAR, TanggalLahir, CURDATE()) > 64 and JenisKelamin = 'L'"));
                                                            echo $Lto64[jumlah];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $Pto64 = mysql_fetch_array(mysql_query("$qwr and TIMESTAMPDIFF(YEAR, TanggalLahir, CURDATE()) > 64 and JenisKelamin = 'P'"));
                                                            echo $Pto64[jumlah];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $Lh_m = mysql_fetch_array(mysql_query("$qwr and JenisKelamin = 'L'"));
                                                            echo $Lh_m[jumlah];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $Ph_m = mysql_fetch_array(mysql_query("$qwr and JenisKelamin = 'P'"));
                                                            echo $Ph_m[jumlah];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $pshidup = mysql_fetch_array(mysql_query("$qwr and StatusKeluar = 'Hidup'"));
                                                            echo $pshidup[jumlah];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $psmati = mysql_fetch_array(mysql_query("$qwr and StatusKeluar = 'Mati'"));
                                                            echo $psmati[jumlah];
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                    </div>
                    </div>
                </div>
            </div>

<?php
  if (isset($_POST[filter])) {
    $tglstart = date_create("$_POST[start]");
    $tglend = date_create("$_POST[finish]");
    $htglstart = date_format($tglstart, "Y-m-d");
    $htglend = date_format($tglend, "Y-m-d");
    echo '<meta http-equiv="refresh" content="0;url=?actl=laporan_riwayat_penyakit&actv=lrp&datestart='.$htglstart.'&dateend='.$htglend.'">';
  }
?>

