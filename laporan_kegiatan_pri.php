<?php
if (empty($_GET[datestart])) { 
  $disable = 'disabled="disabled"';
  $vstart = date("Y");
}else{
  $title = $_GET[datestart];
  $vstart = $_GET[datestart];
}

  if (isset($_POST[filter])) {
    $_SESSION[tglmulai] = $_POST[tglmulai];
    $_SESSION[tglselesai] = $_POST[tglselesai];
    echo '<meta http-equiv="refresh" content="0;url=?actl=laporan_kegiatan_pri&actv=kri">';
    exit();
  }

if ($_SESSION[tglmulai] != '' and $_SESSION[tglselesai] != '') {
  $tglmulai = $_SESSION[tglmulai];
  $tglselesai = $_SESSION[tglselesai];
}else{
  $tglmulai = $datenow;
  $tglselesai = $datenow;
}
?>
            <ol class="breadcrumb pull-right">
                <li class="breadcrumb-item"><a href="?act=dashboard&actv=d">Home</a></li>
                <li class="breadcrumb-item active"> Rekapitulasi SHRI</li>
            </ol>

            <h1 class="page-header"> Rekapitulasi SHRI</h1>
                        
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
                            <h4 style="color: inherit; font-size: 12px; line-height: 20px; margin-bottom: 0; margin-top: 0;">Laporan Rekapitulasi</h4>
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
                                        <a href="#" class="btn btn-default" onclick="window.open('indexbaru.php?actl=c_lap_kegiatan_pri&tglmulai=<?=$tglmulai?>&tglselesai=<?=$tglselesai?>', 'Laporan Internal', 'width=800,height=500');"><em class="fa fa-print"></em> &nbsp;Cetak</a>
                                      </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                                        <table id="data-table-default" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="1%" rowspan="2" data-orderable="false">No</th>
                                                    <th width="1%" rowspan="2" data-orderable="false">Ruang</th>
                                                    <th width="1%" rowspan="2" data-orderable="false">Pasien Sisa</th>
                                                    <th width="1%" rowspan="2" data-orderable="false">Pasien Masuk</th>
                                                    <th width="1%" rowspan="2" data-orderable="false">Pasien Pindahan</th>
                                                    <th width="1%" rowspan="2" data-orderable="false">Pasien Keluar (Hidup + Meninggal)</th>
                                                    <th width="1%" rowspan="2" data-orderable="false">Pasien Dipindahkan</th>
                                                    <th width="1%" rowspan="2" data-orderable="false">Jumlah Lama Dirawat (LD)</th>
                                                    <th width="1%" rowspan="2" data-orderable="false">Jumlah Hari Perawatan (HP)</th>
                                                    <th colspan="6" data-orderable="false" style="text-align: center;">Rincian Hari Perawatan Per Kelas</th>
                                                </tr>
                                                <tr>
                                                  
                                                    <?php
                                                    $arrResultIDKelas = Array();
                                                    $qkls = mysql_query("select * from tblkelas where NA = 'N'");
                                                    while ($dkls = mysql_fetch_array($qkls)) {
                                                      Array_push($arrResultIDKelas, $dkls[IDKelas]);
                                                    echo '<th width="8%" data-orderable="false">'.$dkls[NamaKelas].'</th>'; } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $no = 0;
                                                $qbangsal = mysql_query("select * from tblruangan where NA = 'N'");
                                                  while ($dbangsal = mysql_fetch_array($qbangsal)) { 
                                                    $qrekap = mysql_query("select
                                                      (select count(IDRiwayat) from tblriwayat a inner join tblruang_kelas b on a.IDRuangKelas = b.IDRuangKelas where b.IDRuangan = '$dbangsal[IDRuangan]' and substr(TglMasuk,1,10) < '$tglmulai' and TglKeluar > '$tglmulai')as PasienAwal,
                                                      (select count(IDRiwayat) from tblriwayat a inner join tblruang_kelas b on a.IDRuangKelas = b.IDRuangKelas where b.IDRuangan = '$dbangsal[IDRuangan]' and substr(TglMasuk,1,10) between '$tglmulai' and '$tglselesai') as PasienMasuk,
                                                      (select count(IDRiwayat) from tblriwayat a inner join tblruang_kelas b on a.IDRuangKelas = b.IDRuangKelas where b.IDRuangan = '$dbangsal[IDRuangan]' and substr(TglPindah,1,10) between '$tglmulai' and '$tglselesai') as Pindahan,
                                                      (select count(IDRiwayat) from tblriwayat a inner join tblruang_kelas b on a.IDRuangAwal = b.IDRuangKelas where IDRuangAwal != '0' and IDRuangan = '$dbangsal[IDRuangan]' and substr(TglPindah,1,10) between '$tglmulai' and '$tglselesai') as Dipindahkan,
                                                      (select count(IDRiwayat) from tblriwayat a inner join tblruang_kelas b on a.IDRuangKelas = b.IDRuangKelas where b.IDRuangan = '$dbangsal[IDRuangan]' and StatusKeluar = 'Hidup' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as KeluarHidup,
                                                      (select count(IDRiwayat) from tblriwayat a inner join tblruang_kelas b on a.IDRuangKelas = b.IDRuangKelas where b.IDRuangan = '$dbangsal[IDRuangan]' and StatusKeluar = 'Meninggal' and CaraKeluar = 'Meninggal > 48 Jam' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as MatiLbh48,
                                                      (select count(IDRiwayat) from tblriwayat a inner join tblruang_kelas b on a.IDRuangKelas = b.IDRuangKelas where b.IDRuangan = '$dbangsal[IDRuangan]' and StatusKeluar = 'Meninggal' and CaraKeluar = 'Meninggal < 48 Jam' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as MatiKrng48,
                                                      (select sum(datediff(substr(TglKeluar,1,10), substr(TglMasuk,1,10))) from tblriwayat a inner join tblruang_kelas b on a.IDRuangKelas = b.IDRuangKelas where b.IDRuangan = '$dbangsal[IDRuangan]' and substr(TglMasuk,1,10) between '$tglmulai' and '$tglselesai' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as JmlLmDirawat1, 
                                                      (select sum(datediff(substr(TglKeluar,1,10), '$tglmulai')) from tblriwayat a inner join tblruang_kelas b on a.IDRuangKelas = b.IDRuangKelas where b.IDRuangan = '$dbangsal[IDRuangan]' and substr(TglMasuk,1,10) < '$tglmulai' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as JmlLmDirawat2,
                                                      (select sum(datediff(substr(TglKeluar,1,10), substr(TglMasuk,1,10))+1) from tblriwayat a inner join tblruang_kelas b on a.IDRuangKelas = b.IDRuangKelas where b.IDRuangan = '$dbangsal[IDRuangan]' and substr(TglMasuk,1,10) between '$tglmulai' and '$tglselesai' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as JmlHrPerawatan1, 
                                                      (select sum(datediff(substr(TglKeluar,1,10), '$tglmulai')+1) from tblriwayat a inner join tblruang_kelas b on a.IDRuangKelas = b.IDRuangKelas where b.IDRuangan = '$dbangsal[IDRuangan]' and substr(TglMasuk,1,10) < '$tglmulai' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as JmlHrPerawatan2, 
                                                      (select sum(datediff('$tglselesai', substr(TglMasuk,1,10))+1) from tblriwayat a inner join tblruang_kelas b on a.IDRuangKelas = b.IDRuangKelas where b.IDRuangan = '$dbangsal[IDRuangan]' and substr(TglKeluar,1,10) > '$tglselesai' and substr(TglMasuk,1,10) between '$tglmulai' and '$tglselesai') as JmlHrPerawatan3, 
                                                      (select sum(datediff('$tglselesai', '$tglmulai')+1) from tblriwayat a inner join tblruang_kelas b on a.IDRuangKelas = b.IDRuangKelas where b.IDRuangan = '$dbangsal[IDRuangan]' and TglKeluar = '0000-00-00 00:00:00' and substr(TglKeluar,1,10) > '$tglselesai' and substr(TglMasuk,1,10) < '$tglmulai') as JmlHrPerawatan4");
                                                    $drekap = mysql_fetch_array($qrekap);  $no++;
                                            ?>
                                                <tr>
                                                    <td><?=$no?></td>
                                                    <td><?=$dbangsal[NamaRuangan]?></td>
                                                    <td><?=($drekap[PasienAwal]+$drekap[PasienMasuk]+$drekap[Pindahan])-($drekap[KeluarHidup]+$drekap[MatiLbh48]+$drekap[MatiKrng48])?></td>
                                                    <td><?=$drekap[PasienMasuk] == '' ? 0 : $drekap[PasienMasuk]?></td>
                                                    <td><?=$drekap[Pindahan] == '' ? 0 : $drekap[Pindahan]?></td>
                                                    <td><?=($drekap[KeluarHidup]+$drekap[MatiKrng48]+$drekap[MatiLbh48])?></td>
                                                    <td><?=$drekap[Dipindahkan] == '' ? 0 : $drekap[Dipindahkan]?></td>
                                                    <td><?=$drekap[JmlLmDirawat1]+$drekap[JmlLmDirawat2] == '' ? 0 : $drekap[JmlLmDirawat1]+$drekap[JmlLmDirawat2]?></td>
                                                    <td><?=$drekap[JmlHrPerawatan1]+$drekap[JmlHrPerawatan2]+$drekap[JmlHrPerawatan3]+$drekap[JmlHrPerawatan4]?></td>
                                                  
                                                    
                                                    <?php
                                                      foreach ($arrResultIDKelas as $key => $value) {
                                                        $dtnkls = mysql_fetch_array(mysql_query("select count(IDRiwayat) as Jumla from tblriwayat a inner join tblruang_kelas b on a.IDRuangKelas = b.IDRuangKelas where b.IDRuangan = '$dbangsal[IDRuangan]' and b.IDKelas = '$value' and substr(TglMasuk,1,10) between '$tglmulai' and '$tglselesai'"));
                                                        echo "<td>".$dtnkls[Jumla]."</td>";
                                                      }
                                                    ?>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                    </div>
                </div>
            </div>