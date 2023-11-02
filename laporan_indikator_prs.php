<?php
  if (isset($_POST[filter])) {
    $_SESSION[tglmulai] = $_POST[tglmulai];
    $_SESSION[tglselesai] = $_POST[tglselesai];
    echo '<meta http-equiv="refresh" content="0;url=?actl=laporan_indikator_prs&actv=lir">';
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
                <li class="breadcrumb-item active">Laporan Eksternal</li>
            </ol>

            <h1 class="page-header">Laporan Eksternal | Indikator Pelayanan Rumah Sakit</h1>
                        
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
                            <h4 style="color: inherit; font-size: 12px; line-height: 20px; margin-bottom: 0; margin-top: 0;">Laporan Eksternal</h4>
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
                                        <button class="btn btn-primary" type="submit" name="filter"><em class="fa fa-filter"></em> &nbsp;Filter</button>&nbsp;
                                        <a href="#" class="btn btn-default" onclick="window.open('indexbaru.php?actl=<?=$_GET[actl] == 'laporan_indikator_pri' ? 'c_lap_indikator_pri' : 'c_lap_indikator_prs'?>&tglmulai=<?=$tglmulai?>&tglselesai=<?=$tglselesai?>', 'Laporan Internal', 'width=800,height=500');"><em class="fa fa-print"></em> &nbsp;Cetak</a>
                                      </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                                        <table id="data-table-default" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                  <th width="1%" data-orderable="false">Ruang - Kelas</th>
                                                    <th width="1%" data-orderable="false">BOR (%)</th>
                                                    <th width="1%" data-orderable="false">AvLOS (Hari)</th>
                                                    <th width="1%" data-orderable="false">TOI (Hari)</th>
                                                    <th width="1%" data-orderable="false">BTO (Kali)</th>
                                                    <th width="1%" data-orderable="false">GDR (%<sub>0</sub>)</th>
                                                    <th width="1%" data-orderable="false">NDR (%<sub>0</sub>)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $arrResultBangsal = Array();
                                            $arrResultBor = Array();
                                            $arrResultAvlos = Array();
                                            $arrResultToii = Array();
                                            $arrResultBto = Array();
                                            $arrResultGdr = Array();
                                            $arrResultNdr = Array();
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
                                                      (select count(IDRiwayat) from tblriwayat where IDRuangKelas = '$dbangsal[IDRuangKelas]' and StatusKeluar = 'Mati' and CaraKeluar = 'Meninggal > 48 Jam' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as MatiLbh48,
                                                      (select count(IDRiwayat) from tblriwayat where IDRuangKelas = '$dbangsal[IDRuangKelas]' and StatusKeluar = 'Mati' and CaraKeluar = 'Meninggal <= 48 Jam' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as MatiKrng48,
                                                      (select sum(datediff(substr(TglKeluar,1,10), substr(TglMasuk,1,10))) from tblriwayat where IDRuangKelas = '$dbangsal[IDRuangKelas]' and substr(TglMasuk,1,10) between '$tglmulai' and '$tglselesai' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as JmlLmDirawat1, 
                                                      (select sum(datediff(substr(TglKeluar,1,10), '$tglmulai')) from tblriwayat where IDRuangKelas = '$dbangsal[IDRuangKelas]' and substr(TglMasuk,1,10) < '$tglmulai' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as JmlLmDirawat2,
                                                      (select sum(datediff(substr(TglKeluar,1,10), substr(TglMasuk,1,10))+1) from tblriwayat where IDRuangKelas = '$dbangsal[IDRuangKelas]' and substr(TglMasuk,1,10) between '$tglmulai' and '$tglselesai' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as JmlHrPerawatan1, 
                                                      (select sum(datediff(substr(TglKeluar,1,10), '$tglmulai')+1) from tblriwayat where IDRuangKelas = '$dbangsal[IDRuangKelas]' and substr(TglMasuk,1,10) < '$tglmulai' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as JmlHrPerawatan2, 
                                                      (select sum(datediff('$tglselesai', substr(TglMasuk,1,10))+1) from tblriwayat where IDRuangKelas = '$dbangsal[IDRuangKelas]' and substr(TglKeluar,1,10) > '$tglselesai' and substr(TglMasuk,1,10) between '$tglmulai' and '$tglselesai') as JmlHrPerawatan3, 
                                                      (select sum(datediff('$tglselesai', '$tglmulai')+1) from tblriwayat where IDRuangKelas = '$dbangsal[IDRuangKelas]' and TglKeluar = '0000-00-00 00:00:00' and substr(TglKeluar,1,10) > '$tglselesai' and substr(TglMasuk,1,10) < '$tglmulai') as JmlHrPerawatan4");
                                                    $drekap = mysql_fetch_array($qrekap); 

                                                    $bor = round((($drekap[JmlHrPerawatan1]+$drekap[JmlHrPerawatan2]+$drekap[JmlHrPerawatan3]+$drekap[JmlHrPerawatan4])/($dbangsal[JumlahTT]*($jumlah_hari+1)))*100,2);
                                                    $avlos = ($drekap[JmlLmDirawat1]+$drekap[JmlLmDirawat2])/($drekap[KeluarHidup]+$drekap[MatiLbh48]+$drekap[MatiKrng48]);
                                                    $toii = (($dbangsal[JumlahTT]*($jumlah_hari+1))-($drekap[JmlHrPerawatan1]+$drekap[JmlHrPerawatan2]+$drekap[JmlHrPerawatan3]+$drekap[JmlHrPerawatan4]))/($drekap[KeluarHidup]+$drekap[MatiLbh48]+$drekap[MatiKrng48]);
                                                    $bto = ($drekap[KeluarHidup]+$drekap[MatiLbh48]+$drekap[MatiKrng48])/$dbangsal[JumlahTT];
                                                    $gdr = round((($drekap[MatiLbh48]+$drekap[MatiKrng48])/($drekap[KeluarHidup]+$drekap[MatiLbh48]+$drekap[MatiKrng48]))*1000,2);
                                                    $ndr = round(($drekap[MatiLbh48] / ($drekap[KeluarHidup]+$drekap[MatiLbh48]+$drekap[MatiKrng48]))*1000,2);

                                                    $tbor += $bor;
                                                    $tavlos += $avlos;
                                                    $ttoi += $toii;
                                                    $tbto += $bto;
                                                    $tgdr += $gdr;
                                                    $tndr += $ndr;

                                                    Array_push($arrResultBangsal, $dbangsal[NamaRuangan].' - '.$dbangsal[NamaKelas]);
                                                    Array_push($arrResultBor, $bor);
                                                    Array_push($arrResultAvlos, $avlos);
                                                    Array_push($arrResultToii, $toii);
                                                    Array_push($arrResultBto, $bto);
                                                    Array_push($arrResultGdr, $gdr);
                                                    Array_push($arrResultNdr, $ndr);

                                            ?>
                                                <tr>
                                                  <td><?=$dbangsal[NamaRuangan].' - '.$dbangsal[NamaKelas]?></td>
                                                    <td><?=$bor." %"?></td>
                                                        <td><?=$avlos?></td>
                                                        <td><?=$toii?></td>
                                                        <td><?=$bto?></td>
                                                        <td><?=$gdr." %<sub>0</sub>"?></td>
                                                        <td><?=$ndr." %<sub>0</sub>"?></td>
                                                </tr>
                                            <?php } ?>
                                            <footer>
                                              <tr>
                                                      <th>TOTAL</th>
                                                      <th><?=$tbor." %"?></th>
                                                      <th><?=$tavlos?></th>
                                                      <th><?=$ttoi?></th>
                                                      <th><?=$tbto?></th>
                                                      <th><?=$tgdr." %<sub>0</sub"?></th>
                                                      <th><?=$tndr." %<sub>0</sub"?></th>
                                                      </tr>
                                                    </footer>
                                            </tbody>
                                        </table>
                                    </div>
                                  </div>
                    </div>


                <div class="col-lg-12 ui-sortable">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                        <div class="panel-heading ui-sortable-handle">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-refresh"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 style="color: inherit; font-size: 12px; line-height: 20px; margin-bottom: 0; margin-top: 0;">Grafik Laporan Eksternal Indikator Pelayanan Rumah Sakit</h4>
                        </div>

                        <div class="panel-body">
                          <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                        </div>
                    </div>
                </div>

