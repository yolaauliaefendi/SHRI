<?php
  if (isset($_POST[filter])) {
    $_SESSION[tglmulai] = $_POST[tglmulai];
    $_SESSION[tglselesai] = $_POST[tglselesai];
    echo '<meta http-equiv="refresh" content="0;url=?actl=grafik_barber_johnson&actv=gbj">';
    exit();
  }

if ($_SESSION[tglmulai] != '' and $_SESSION[tglselesai] != '') {
  $tglmulai = $_SESSION[tglmulai];
  $tglselesai = $_SESSION[tglselesai];
}else{
  $tglmulai = $datenow;
  $tglselesai = $datenow;
}

$date1=date_create($tglmulai);
$date2=date_create($tglselesai);
$diff=date_diff($date1,$date2);
$jumlah_hari=$diff->format("%d%");
?>
            <ol class="breadcrumb pull-right">
                <li class="breadcrumb-item"><a href="?act=dashboard&actv=d">Home</a></li>
                <li class="breadcrumb-item active">Laporan Internal</li>
            </ol>

            <h1 class="page-header">Laporan Grafik Barber Johson</h1>
                        
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
                            <h4 style="color: inherit; font-size: 12px; line-height: 20px; margin-bottom: 0; margin-top: 0;">Grafik Barber Johson</h4>
                        </div>

                        <div class="panel-body">
                        <div class="panel-body panel-form">
                            <form class="form-horizontal" method="post">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                      <label class="col-form-label">Pilih Tanggal Mulai</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="tglmulai" value="<?=$tglmulai?>" required="required" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                      <label class="col-form-label">Pilih Tanggal Selesai</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="tglselesai" value="<?=$tglselesai?>" required="required" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                      <label class="col-form-label">&nbsp;</label>
                                      <div class="input-group">
                                        <button class="btn btn-primary" type="submit" name="filter"><em class="fa fa-filter"></em> &nbsp;Filter</button>
                                      </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                                            <?php
                                            

                                            $qbangsal = mysql_query("select a.IDRuangKelas, b.NamaRuangan, c.NamaKelas, a.JumlahTT from tblruang_kelas a 
inner join tblruangan b on a.IDRuangan = b.IDRuangan 
inner join tblkelas c on a.IDKelas = c.IDKelas
where a.NA = 'N'");
                                                  while ($dbangsal = mysql_fetch_array($qbangsal)) { 
                                                    $qrekap = mysql_query("select
                                                      (select count(IDRiwayat) from tblriwayat where substr(TglMasuk,1,10) < '$tglmulai' and TglKeluar > '$tglmulai' and IDRuangKelas = '$dbangsal[IDRuangKelas]')as PasienAwal,
                                                      (select count(IDRiwayat) from tblriwayat where IDRuangKelas = '$dbangsal[IDRuangKelas]' and substr(TglMasuk,1,10) between '$tglmulai' and '$tglselesai') as PasienMasuk,
                                                      (select count(IDRiwayat) from tblriwayat where IDRuangAwal = '$dbangsal[IDRuangKelas]' and substr(TglPindah,1,10) between '$tglmulai' and '$tglselesai') as Dipindahkan,
                                                      (select count(IDRiwayat) from tblriwayat where IDRuangAwal != '0' and IDRuangKelas = '$dbangsal[IDRuangKelas]' and substr(TglPindah,1,10) between '$tglmulai' and '$tglselesai') as Pindahan,
                                                      (select count(IDRiwayat) from tblriwayat where IDRuangKelas = '$dbangsal[IDRuangKelas]' and StatusKeluar = 'Hidup' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as KeluarHidup,
                                                      (select count(IDRiwayat) from tblriwayat where IDRuangKelas = '$dbangsal[IDRuangKelas]' and StatusKeluar = 'Meninggal' and CaraKeluar = 'Meninggal > 48 Jam' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as MatiLbh48,
                                                      (select count(IDRiwayat) from tblriwayat where IDRuangKelas = '$dbangsal[IDRuangKelas]' and StatusKeluar = 'Meninggal' and CaraKeluar = 'Meninggal < 48 Jam' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as MatiKrng48,
                                                      (select sum(datediff(substr(TglKeluar,1,10), substr(TglMasuk,1,10))) from tblriwayat where IDRuangKelas = '$dbangsal[IDRuangKelas]' and substr(TglMasuk,1,10) between '$tglmulai' and '$tglselesai' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as JmlLmDirawat1, 
                                                      (select sum(datediff(substr(TglKeluar,1,10), '$tglmulai')) from tblriwayat where IDRuangKelas = '$dbangsal[IDRuangKelas]' and substr(TglMasuk,1,10) < '$tglmulai' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as JmlLmDirawat2,
                                                      (select sum(datediff(substr(TglKeluar,1,10), substr(TglMasuk,1,10))+1) from tblriwayat where IDRuangKelas = '$dbangsal[IDRuangKelas]' and substr(TglMasuk,1,10) between '$tglmulai' and '$tglselesai' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as JmlHrPerawatan1, 
                                                      (select sum(datediff(substr(TglKeluar,1,10), '$tglmulai')+1) from tblriwayat where IDRuangKelas = '$dbangsal[IDRuangKelas]' and substr(TglMasuk,1,10) < '$tglmulai' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as JmlHrPerawatan2, 
                                                      (select sum(datediff('$tglselesai', substr(TglMasuk,1,10))+1) from tblriwayat where IDRuangKelas = '$dbangsal[IDRuangKelas]' and substr(TglKeluar,1,10) > '$tglselesai' and substr(TglMasuk,1,10) between '$tglmulai' and '$tglselesai') as JmlHrPerawatan3, 
                                                      (select sum(datediff('$tglselesai', '$tglmulai')+1) from tblriwayat where IDRuangKelas = '$dbangsal[IDRuangKelas]' and TglKeluar = '0000-00-00 00:00:00' and substr(TglKeluar,1,10) > '$tglselesai' and substr(TglMasuk,1,10) < '$tglmulai') as JmlHrPerawatan4");
                                                    $drekap = mysql_fetch_array($qrekap); 
                                                    $tbor += round((($drekap[JmlHrPerawatan1]+$drekap[JmlHrPerawatan2]+$drekap[JmlHrPerawatan3]+$drekap[JmlHrPerawatan4])/($dbangsal[JumlahTT]*($jumlah_hari+1)))*100,2);
                                                    $tavlos += ($drekap[JmlLmDirawat1]+$drekap[JmlLmDirawat2])/($drekap[KeluarHidup]+$drekap[MatiLbh48]+$drekap[MatiKrng48]);
                                                    $ttoi += (($dbangsal[JumlahTT]*($jumlah_hari+1))-($drekap[JmlHrPerawatan1]+$drekap[JmlHrPerawatan2]+$drekap[JmlHrPerawatan3]+$drekap[JmlHrPerawatan4]))/($drekap[KeluarHidup]+$drekap[MatiLbh48]+$drekap[MatiKrng48]);
                                                    $tbto += ($drekap[KeluarHidup]+$drekap[MatiLbh48]+$drekap[MatiKrng48])/$dbangsal[JumlahTT];
                                                    $tgdr += round((($drekap[MatiLbh48]+$drekap[MatiKrng48])/($drekap[KeluarHidup]+$drekap[MatiLbh48]+$drekap[MatiKrng48]))*1000,2);
                                                    $tndr += round(($drekap[MatiLbh48] / ($drekap[KeluarHidup]+$drekap[MatiLbh48]+$drekap[MatiKrng48]))*1000,2);
                                                  }

                                                  $bor = $tbor;
                                                  $los=$tavlos;
                                                  $toi=$ttoi;
                                                  $bto=$tbto;
                                                  /*$bor = 69;
                                                  $los=5.8;
                                                  $toi=2.6;
                                                  $bto=3.68;*/
                                                  $jhee=31;
                                                    ?>

<div id="gbj" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<h3 align="center"><b>Detail</b></h3>
<table border="1px" align="center">
  <tr align="center" style="font-size: 15px">
    <th align="center" >Indikator</th>
    <th align="center" >Nilai</th>
    <th align="center" >Standar</th>
    <th align="center" >Kesimpulan</th>
  </tr>
  <tbody>
    <tr>
      <td>BOR</td>
      <td align="center"><?php echo $bor; ?>&nbsp;%</td>
      <td align="center">60-80 %</td>
      <td align="center"><?php 
if (($bor>=60) and ($bor<=80)) {
  echo "Sesuai Standar";
} else
{
 echo "Tidak Sesuai Standar";
}

       ?></td>
    </tr>
    <tr>
      <td>LOS</td>
      <td align="center"><?php echo $los; ?></td>
      <td align="center">6-9 Hari</td>
      <td align="center"><?php 
if (($los>=6) and ($los<=9)) {
  echo "Sesuai Standar";
} else
{
 echo "Tidak Sesuai Standar";
}       ?></td>
    </tr>
    <tr>
      <td>TOI</td>
      <td align="center"><?php echo $toi; ?></td>
      <td align="center">1-3 Hari</td>
      <td align="center"><?php 
if (($toi>=1) and ($toi<=3)) {
  echo "Sesuai Standar";
} else
{
 echo "Tidak Sesuai Standar";
}
       ?></td>
    </tr>
    <tr>
      <td>BTO</td>
      <td align="center"><?php echo $bto; ?></td>
      <td align="center">40-50 Kali</td>
      <td align="center"><?php 
if (($bto>=40) and ($bto<=50)) {
  echo "Sesuai Standar";
} else
{
 echo "Tidak Sesuai Standar";
}
       ?></td>
    </tr>
  </tbody>
</table>
<br>
                        </div>
                        </div>
                    </div>
                </div>

