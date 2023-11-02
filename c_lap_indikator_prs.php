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
                                             <h4 class="media-box-heading">Laporan Eksternal Indikator Pelayanan Rumah Sakit</h4><small>Tahun Periode <?=tgl_indo($_GET[datestart])?> sampai <?=tgl_indo($_GET[dateend])?></small>
                                       </td>
                                    </tr>
                              </table>
<table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="1%" data-orderable="false">Tahun</th>
                                                    <th width="1%" data-orderable="false">BOR (%)</th>
                                                    <th width="1%" data-orderable="false">ALOS (HR)</th>
                                                    <th width="1%" data-orderable="false">BTO</th>
                                                    <th width="1%" data-orderable="false">TOI</th>
                                                    <th width="1%" data-orderable="false">NDR</th>
                                                    <th width="1%" data-orderable="false">GDR</th>
                                                    <th width="1%" data-orderable="false">Rata-rata Kunjungan /hari</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $no = 0;
                                                $sqld = mysql_query("SELECT
  SUBSTR(a.TglMasuk, 1,4) as tahun,
  count(a.TglMasuk) as PsMasuk,
  (select count(TglKeluar) from tblriwayat where SUBSTR(TglKeluar, 1,4) = SUBSTR(a.TglMasuk, 1,4)) as PsKeluar,
  (select count(IDPasien) from tblriwayat where SUBSTR(TglKeluar, 1,4) = SUBSTR(a.TglMasuk, 1,4) and StatusKeluar = 'Mati') as PsKeluarMati,
  (select count(IDPasien) from tblriwayat where TglKeluar = '0000-00-00 00:00:00' and SUBSTR(TglMasuk, 1,4) = SUBSTR(a.TglMasuk, 1,4)) as PsSisa,
  sum((datediff(a.TglKeluar, a.TglMasuk)+1)) as JmlHrPerawatan,
  sum(if((datediff(a.TglKeluar, a.TglMasuk))=0,1,datediff(a.TglKeluar, a.TglMasuk))) as JmlLamaDirawat,
  (select timestampdiff(day, a.TglMasuk, date_add(a.TglMasuk, interval 1 year))) as Periode,
  (select count(IDPasien) from tblriwayat where datediff(TglKeluar, TglMasuk) <= 2 and StatusKeluar = 'Mati' and SUBSTR(TglKeluar, 1,4) = SUBSTR(a.TglMasuk, 1,4)) as MatiKD48Jam,
  (select count(IDPasien) from tblriwayat where datediff(TglKeluar, TglMasuk) > 2 and StatusKeluar = 'Mati' and SUBSTR(TglKeluar, 1,4) = SUBSTR(a.TglMasuk, 1,4)) as MatiLD48Jam

FROM
  tblriwayat a
  INNER JOIN tblpasien b ON a.IDPasien = b.IDPasien
  INNER JOIN tblruang_kelas c ON a.IDRuangKelas = c.IDRuangKelas
  INNER JOIN tbljenispembayaran d ON a.IDJenisPembayaran = d.IDJenisPembayaran
  INNER JOIN tbldiagnosa e ON a.IDDiagnosa = e.IDDiagnosa
  where SUBSTR(a.TglMasuk, 1,4) between '$_GET[datestart]' and '$_GET[dateend]'
group by SUBSTR(a.TglMasuk, 1,4) order by SUBSTR(a.TglMasuk, 1,4) asc");
                                                while ($vdat = mysql_fetch_array($sqld)) { $no++;
                                            ?>
                                                <tr>
                                                    <td><?=$vdat[tahun]?></td>
                                                    <td><?=round(($vdat[JmlHrPerawatan]/$vdat[Periode])/101*100,2)?></td>
                                                    <td><?=round($vdat[JmlHrPerawatan]/$vdat[PsKeluar],2)?></td>
                                                    <td><?=number_format($vdat[PsKeluar]/101, 2)?></td>
                                                    <td><?=((101*$vdat[Periode])-$vdat[JmlHrPerawatan])/$vdat[PsKeluar]?></td>
                                                    <td><?=round($vdat[MatiLD48Jam]/$vdat[PsKeluar],2)?></td>
                                                    <td><?=round($vdat[PsKeluarMati]/$vdat[PsKeluar], 2)?></td>
                                                    <td><?=round($vdat[PsKeluar]/12, 2)?></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
 <script type="text/javascript">
    window.print();
  </script>