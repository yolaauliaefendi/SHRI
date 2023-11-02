<?php
if ($_GET[tglmulai] != '' and $_GET[tglselesai] != '') {
  $tglmulai = $_GET[tglmulai];
  $tglselesai = $_GET[tglselesai];
}
?>
              <table class="table table-valign-middle">

                                    <tr>
                                       <td colspan="2" align="center" style="border-top: 0">
                                             <h4 class="media-box-heading">RSIA MUTIARA BUNDA PADANG</h4>
                                             <small class="text-muted">Jalan S. Parman No.142, Ulak Karang Sel., Kec. Padang Utara, Kota Padang, Sumatera Barat</small>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td colspan="2" style="border-top: 0;">
                                          <hr style="margin-bottom: 2px; margin-top: 5px; border-top: 3px solid #000;">
                                          <hr style="margin-bottom: 5px; margin-top: 2px; border-top: 1px solid #000;">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td colspan="2" align="center" style="border-top: 0">
                                             <h4 class="media-box-heading">Laporan Rekapitulasi SHRI</h4><small>Tahun <?=tgl_indo($tglmulai).' - '.tgl_indo($tglselesai)?></small>
                                       </td>
                                    </tr>
                              </table>
<table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="1%" rowspan="2" data-orderable="false">No</th>
                                                    <th width="1%" rowspan="2" data-orderable="false">Ruang</th>
                                                    <th width="1%" rowspan="2" data-orderable="false">Pasien Awal</th>
                                                    <th width="1%" rowspan="2" data-orderable="false">Pasien Masuk</th>
                                                    <th width="1%" rowspan="2" data-orderable="false">Pasien Keluar Hidup</th>
                                                    <th width="1%" rowspan="2" data-orderable="false">Jumlah Pasien Keluar Mati</th>
                                                    <th width="1%" rowspan="2" data-orderable="false">Jml Lm Dirawat (Hr)</th>
                                                    <th width="1%" rowspan="2" data-orderable="false">Jml Hr Perawatan</th>
                                                    <th colspan="6" data-orderable="false" style="text-align: center;">Rincian Hari Perawatan Per Kelas</th>
                                                </tr>
                                                <tr>
                                                    <th width="1%" data-orderable="false">Mati > 48 jam</th>
                                                    <th width="1%" data-orderable="false">Mati <= 48 jam</th>
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
                                                      (select count(IDRiwayat) from tblriwayat a inner join tblruang_kelas b on a.IDRuangKelas = b.IDRuangKelas where b.IDRuangan = '$dbangsal[IDRuangan]' and StatusKeluar = 'Hidup' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as KeluarHidup,
                                                      (select count(IDRiwayat) from tblriwayat a inner join tblruang_kelas b on a.IDRuangKelas = b.IDRuangKelas where b.IDRuangan = '$dbangsal[IDRuangan]' and StatusKeluar = 'Mati' and CaraKeluar = 'Meninggal > 48 Jam' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as MatiLbh48,
                                                      (select count(IDRiwayat) from tblriwayat a inner join tblruang_kelas b on a.IDRuangKelas = b.IDRuangKelas where b.IDRuangan = '$dbangsal[IDRuangan]' and StatusKeluar = 'Mati' and CaraKeluar = 'Meninggal <= 48 Jam' and substr(TglKeluar,1,10) between '$tglmulai' and '$tglselesai') as MatiKrng48,
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
                                                    <td><?=$drekap[PasienAwal] == '' ? 0 : $drekap[PasienAwal]?></td>
                                                    <td><?=$drekap[PasienMasuk] == '' ? 0 : $drekap[PasienMasuk]?></td>
                                                    <td><?=$drekap[KeluarHidup] == '' ? 0 : $drekap[KeluarHidup]?></td>
                                                    <td><?=$drekap[MatiLbh48]+$drekap[MatiKrng48]?></td>
                                                    <td><?=$drekap[JmlLmDirawat1]+$drekap[JmlLmDirawat2] == '' ? 0 : $drekap[JmlLmDirawat1]+$drekap[JmlLmDirawat2]?></td>
                                                    <td><?=$drekap[JmlHrPerawatan1]+$drekap[JmlHrPerawatan2]+$drekap[JmlHrPerawatan3]+$drekap[JmlHrPerawatan4]?></td>
                    
                                                    <td><?=$drekap[MatiLbh48] == '' ? 0 : $drekap[MatiLbh48]?></td>
                                                    <td><?=$drekap[MatiKrng48] == '' ? 0 : $drekap[MatiKrng48]?></td>
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
 <script type="text/javascript">
    window.print();
  </script>