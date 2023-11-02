<?php
$sqlqu = "SELECT
  a.IDRiwayat, a.IDPasien, a.IDRuangKelas, a.IDJenisPembayaran, a.TglMasuk, a.TglKeluar, a.BaruLama, 
  b.NamaPasien, c.Jml_TTPakai, d.NamaRuangan, e.NamaKelas, f.Nama, g.Nama as JenisPembayaran, h.Nama as Diagnosa, a.StatusKeluar, a.CaraKeluar
FROM
  tblriwayat a
 LEFT JOIN tblpasien b ON a.IDPasien = b.IDPasien
 LEFT JOIN tblruang_kelas c ON a.IDRuangKelas = c.IDRuangKelas
 LEFT JOIN tblruangan d ON c.IDRuangan = d.IDRuangan
 LEFT JOIN tblkelas e ON c.IDKelas = e.IDKelas
 LEFT JOIN tbljenispelayanan f ON f.IDJenisPelayanan = d.IDJenisPelayanan
  LEFT JOIN tbljenispembayaran g ON a.IDJenisPembayaran = g.IDJenisPembayaran
  LEFT JOIN tbldiagnosa h ON a.IDDiagnosa = h.IDDiagnosa";

if (empty($_GET[idrwyt])) {
  $kondisi = "";
}else{
  $kondisi = "Where IDRiwayat = '$_GET[idrwyt]'";
  $ssq = mysql_query("$sqlqu $kondisi");
  $dat = mysql_fetch_array($ssq);
}
$num = mysql_num_rows(mysql_query($sqlqu));
$count = $num+1;
?>
            <ol class="breadcrumb pull-right">
                <li class="breadcrumb-item"><a href="?act=dashboard&actv=d">Home</a></li>
                <li class="breadcrumb-item active">Pasien Keluar</li>
            </ol>

            <h1 class="page-header">Data Keadaan Pasien Keluar</h1>
                        
            <div class="row">
            <?php if($_GET[add] == "active"){ $col = 8; ?> <!--ukuran kolom tabel jika diklik keluar-->
                <div class="col-lg-4 ui-sortable">
                    <div class="panel panel-inverse">
                        <div class="panel-heading ui-sortable-handle">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-refresh"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Formulir Pasien Keluar</h4>
                        </div>
                        <div class="panel-body">
                            <form method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <label>Tanggal Keluar</label>
                                         <input type="text" class="form-control" value="<?php $tgk = substr($dat[TglKeluar], 0,10); echo tgl_indo($tgk);?>" readonly="readonly" />
                                        <!-- <input type="date" class="form-control" name="tglkeluar" value="<?=substr($dat[TglKeluar], 0,10)?>"/> -->
                                    </div>
                                    <div class="form-group">
                                        <label>No. RM</label>
                                        <input type="text" class="form-control" value="<?=$dat[IDPasien]?>" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Pasien</label>
                                        <input type="text" class="form-control" value="<?=$dat[NamaPasien]?>" readonly />
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Jenis Pembayaran</label>
                                        <input type="text" class="form-control" value="<?=$dat[JenisPembayaran]?>" readonly />
                                    </div> -->
                                    <div class="form-group" style="margin-bottom: 0">
                                        <label>Diagnosa</label>
                                    </div>
                                    <div class="input-group m-b-10">
                                        <input type="hidden" name="idpenyakit" id="idpenyakit" value="<?=$dat[IDPenyakit]?>">
                                        <input type="text" class="form-control" name="namapenyakit" id="nmpenyakit" value="<?=$dat[NamaPenyakit]?>" placeholder="" readonly>
                                        <a href="#modal-dialog1" data-toggle="modal" class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></a>
                                    </div>
                                    
                                    <button type="submit" name="simpan" class="btn btn-sm btn-primary m-r-5"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <?php }else{ $col = 12; } ?>

                <div class="col-lg-<?=$col?> ui-sortable">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                        <div class="panel-heading ui-sortable-handle">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-refresh"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 style="color: inherit; font-size: 12px; line-height: 20px; margin-bottom: 0; margin-top: 0;">Data Pasien Keluar </h4>
                        </div>

                        <div class="panel-body">
                                        <table id="data-table-default" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="5%" data-orderable="false">No. RM</th>
                                                    <th width="10%" data-orderable="false">Tanggal Keluar</th>
                                                    <th width="20%" data-orderable="false">Nama Pasien</th>
                                                    <th width="10%" data-orderable="false">Bangsal</th>
                                                    <th width="5%" data-orderable="false">Kelas</th>
                                                    <th width="15%" data-orderable="false">Diagnosa</th>
                                                    <!-- <th width="10%" data-orderable="false">Jenis Pembayaran</th> -->
                                                    <th width="10%" data-orderable="false">Status Keluar</th>
                                                     <th width="10%" data-orderable="false">Cara Keluar</th>
                                                     <th width="5%" data-orderable="false">#</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $no = 0;
                                                $sqld = mysql_query("$sqlqu Where a.TglKeluar != '0000-00-00 00:00:00' order by a.TglKeluar desc");
                                                while ($vdat = mysql_fetch_array($sqld)) { $no++;
                                            ?>
                                                <tr>
                                                    <td><?=$vdat[IDPasien]?></td>
                                                    <td><?=tgl_indo($vdat[TglKeluar])?></td>
                                                    <td><?=$vdat[NamaPasien]?></td>
                                                    <td><?=$vdat[NamaRuangan]?></td>
                                                    <td><?=$vdat[NamaKelas]?></td>
                                                    <td><?=$vdat[Diagnosa]?></td>
                                                    <!-- <td><?=$vdat[JenisPembayaran]?></td> -->
                                                    <td><?=$vdat[StatusKeluar]?></td>
                                                    <td><?=$vdat[CaraKeluar]?></td>
                                                    <td><a class="label label-primary" href="?actt=diagnosa_pasien&actv=dp&add=active&idrwyt=<?=$vdat[IDRiwayat]?>"><em class="fa fa-sign-out"></em> &nbsp;Diagnosa</a>&nbsp;<?=$na?></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                    </div>
                </div>
            </div>

<?php 
    if($_GET[add] == "active"){ 
        include "modul/transaksi/modal_diagnosa.php";
    }
?>


<?php
  if (isset($_POST[simpan])) {
    $datetime = $_POST[tglkeluar]." ".date("H:i:s");
      mysql_query("update tblriwayat set IDDiagnosa = '$_POST[idpenyakit]' where IDRiwayat = '$_GET[idrwyt]'");
      echo '<meta http-equiv="refresh" content="0;url=?actt=diagnosa_pasien&actv=dp">';
      exit;
  }
?>