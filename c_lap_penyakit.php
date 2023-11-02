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
                                             <h4 class="media-box-heading">Laporan 10 Besar Penyakit</h4>
                                             <small>Tahun Periode <?=tgl_indo($_GET[datestart])?> sampai <?=tgl_indo($_GET[dateend])?></small>
                                       </td>
                                    </tr>
                              </table>
                                        <table class="table table-striped table-bordered">
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
 <script type="text/javascript">
    window.print();
  </script>