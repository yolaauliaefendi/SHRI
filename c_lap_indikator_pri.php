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
                                             <h4 class="media-box-heading">Laporan Pelayanan Rawat Inap</h4><small>Periode <?=tgl_indo($tglmulai)." - ".tgl_indo($tglselesai)?></small>
                                       </td>
                                    </tr>
                              </table>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="1%" data-orderable="false">Ruang - Kelas</th>
                                                    <th width="1%" data-orderable="false">TT</th>
                                                    <th width="1%" data-orderable="false">Pasien Awal</th>
                                                    <th width="1%" data-orderable="false">Pasien Masuk</th>
                                                    <th width="1%" data-orderable="false">Pasien Pindahan</th>
                                                    <th width="1%" data-orderable="false">Jumlah Pasien Masuk</th>
                                                    <th width="1%" data-orderable="false">Pasien Dipindahkan</th>
                                                    <th width="1%" data-orderable="false">Pasien Keluar Hidup</th>
                                                    <th width="1%" data-orderable="false">Mati > 48 jam</th>
                                                    <th width="1%" data-orderable="false">Mati <= 48 jam</th>
                                                    <th width="1%" data-orderable="false">Jumlah Pasien Keluar</th>
                                                    <th width="1%" data-orderable="false">Jml Lm Dirawat (Hr)</th>
                                                    <th width="1%" data-orderable="false">Jml Hr Perawatan</th>
                                                    <th width="1%" data-orderable="false">Pasien Sisa</th>
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
                                                      <td><?=$dbangsal[JumlahTT]?></td>
                                                      <td><?=$drekap[PasienAwal] == '' ? 0 : $drekap[PasienAwal]?></td>
                                                      <td><?=$drekap[PasienMasuk] == '' ? 0 : $drekap[PasienMasuk]?></td>
                                                      <td><?=$drekap[Pindahan] == '' ? 0 : $drekap[Pindahan]?></td>
                                                      <td><?=$drekap[PasienAwal]+$drekap[PasienMasuk]+$drekap[Pindahan]?></td>
                                                      <td><?=$drekap[Dipindahkan] == '' ? 0 : $drekap[Dipindahkan]?></td>
                                                      <td><?=$drekap[KeluarHidup] == '' ? 0 : $drekap[KeluarHidup]?></td>
                                                      <td><?=$drekap[MatiLbh48] == '' ? 0 : $drekap[MatiLbh48]?></td>
                                                      <td><?=$drekap[MatiKrng48] == '' ? 0 : $drekap[MatiKrng48]?></td>
                                                      <td><?=$drekap[KeluarHidup]+$drekap[MatiLbh48]+$drekap[MatiKrng48]?></td>
                                                      <td><?=$drekap[JmlLmDirawat1]+$drekap[JmlLmDirawat2] == '' ? 0 : $drekap[JmlLmDirawat1]+$drekap[JmlLmDirawat2]?></td>
                                                      <td><?=$drekap[JmlHrPerawatan1]+$drekap[JmlHrPerawatan2]+$drekap[JmlHrPerawatan3]+$drekap[JmlHrPerawatan4]?></td>
                                                      <td><?=($drekap[PasienAwal]+$drekap[PasienMasuk]+$drekap[Pindahan])-($drekap[KeluarHidup]+$drekap[MatiLbh48]+$drekap[MatiKrng48])?></td>
                                                      <td><?=$bor." %"?></td>
                                                        <td><?=$avlos?></td>
                                                        <td><?=$toii?></td>
                                                        <td><?=$bto?></td>
                                                        <td><?=$gdr." %<sub>0</sub>"?></td>
                                                        <td><?=$ndr." %<sub>0</sub>"?></td>
                                                    </tr>
                                                  <?php } ?>
                                            </tbody>

                                        </table>
 <script type="text/javascript">
    window.print();
  </script>