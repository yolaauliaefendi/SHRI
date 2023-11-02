<?php
if (empty($_GET[datestart]) and empty($_GET[dateend])) { 
  $title = "-"; 
  $disable = 'disabled="disabled"';
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

            <h1 class="page-header">Laporan 10 Besar Penyakit</h1>
                        
            <div class="row">
                <div class="col-lg-12 ui-sortable">
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
                                      <a href="#" class="btn btn-default" onclick="window.open('indexbaru.php?actl=c_lap_penyakit&datestart=<?=$_GET[datestart]?>&dateend=<?=$_GET[dateend]?>', 'Laporan Penyakit', 'width=800,height=500');"><em class="fa fa-print"></em> &nbsp;Cetak</a>
                                      <?php } ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <?php
                        if (isset($_GET[datestart]) and isset($_GET[dateend])) { 
                        ?>
                                        <table id="data-table-default" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="1%" rowspan="2" data-orderable="false"><div align="center">No</div></th>
                                                    <th width="10%" rowspan="2" data-orderable="false">Kode ICD-10</th>
                                                    <th width="40%" rowspan="2" data-orderable="false">Nama Penyakit</th>
                                                    <th colspan="2" data-orderable="false">Pasien Keluar Hidup Menurut Jenis Kelamin</th>
                                                    <th colspan="2" data-orderable="false">Pasien Keluar Mati Menurut Jenis Kelamin</th>
                                                    <th width="8%" rowspan="2" data-orderable="false">Total Hidup + Mati</th>
                                                </tr>
                                                <tr>
                                                    <th width="8%" data-orderable="false">L</th>
                                                    <th width="8%" data-orderable="false">P</th>
                                                    <th width="8%" data-orderable="false">L</th>
                                                    <th width="8%" data-orderable="false">P</th>
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
Group by IDDiagnosa order by count(a.IDDiagnosa) desc limit 10");
                                                while ($vdat = mysql_fetch_array($sqld)) { $no++;
                                            ?>
                                                <tr>
                                                    <td><?=$no?></td>
                                                    <td><?=$vdat[KodeICD]?></td>
                                                    <td><?=$vdat[Nama]?></td>
                                                    <?php
                                                    $qlh = mysql_query("SELECT count(tblpasien.JenisKelamin) as jumlah FROM tblriwayat INNER JOIN tblpasien ON tblpasien.IDPasien = tblriwayat.IDPasien where tblriwayat.IDDiagnosa = '$vdat[IDDiagnosa]' and StatusKeluar = 'Hidup' and tblpasien.JenisKelamin = 'L'");
                                                    while ($lh = mysql_fetch_array($qlh)) {
                                                    ?>
                                                    <td><?=$lh[jumlah];?></td>
                                                    <?php } 

                                                    $qph = mysql_query("SELECT count(tblpasien.JenisKelamin) as jumlah FROM tblriwayat INNER JOIN tblpasien ON tblpasien.IDPasien = tblriwayat.IDPasien where tblriwayat.IDDiagnosa = '$vdat[IDDiagnosa]' and StatusKeluar = 'Hidup' and tblpasien.JenisKelamin = 'P'");
                                                    while ($ph = mysql_fetch_array($qph)) {
                                                    ?>
                                                    <td><?=$ph[jumlah]?></td>
                                                    <?php } 

                                                    $qlm = mysql_query("SELECT count(tblpasien.JenisKelamin) as jumlah FROM tblriwayat INNER JOIN tblpasien ON tblpasien.IDPasien = tblriwayat.IDPasien where tblriwayat.IDDiagnosa = '$vdat[IDDiagnosa]' and StatusKeluar = 'Mati' and tblpasien.JenisKelamin = 'L'");
                                                    while ($lm = mysql_fetch_array($qlm)) {
                                                    ?>
                                                    <td><?=$lm[jumlah]?></td>
                                                    <?php } 

                                                    $qpm = mysql_query("SELECT count(tblpasien.JenisKelamin) as jumlah FROM tblriwayat INNER JOIN tblpasien ON tblpasien.IDPasien = tblriwayat.IDPasien where tblriwayat.IDDiagnosa = '$vdat[IDDiagnosa]' and StatusKeluar = 'Mati' and tblpasien.JenisKelamin = 'P'");
                                                    while ($pm = mysql_fetch_array($qpm)) {
                                                    ?>
                                                    <td><?=$pm[jumlah]?></td>
                                                    <?php }?>
                                                    <td><?=$vdat[jumlah]?></td>
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
    echo '<meta http-equiv="refresh" content="0;url=?actl=laporan_penyakit&actv=lp&datestart='.$htglstart.'&dateend='.$htglend.'">';
  }
?>

