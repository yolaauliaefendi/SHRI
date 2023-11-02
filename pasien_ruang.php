<?php
//query dari database untuk menampilkan data Pasien Masuk
// inner join on = untuk menghubungkan relasi antar tabel
$sqlqu = "SELECT a.IDRiwayat, a.IDPasien, a.IDRuangKelas, a.TglMasuk, a.IDJenisPembayaran, a.TglKeluar, a.BaruLama, b.NamaPasien, b.JenisKelamin, c.Jml_TTPakai, d.NamaRuangan, e.NamaKelas FROM tblriwayat a INNER JOIN tblpasien b ON a.IDPasien = b.IDPasien INNER JOIN tblruang_kelas c ON a.IDRuangKelas = c.IDRuangKelas INNER JOIN tblruangan d ON c.IDRuangan = d.IDRuangan INNER JOIN tblkelas e ON c.IDKelas = e.IDKelas
Where a.TglKeluar = '0000-00-00 00:00:00'";
if (empty($_GET[idrwyt])) {
  $kondisi = "";
}else{
  $kondisi = "and IDRiwayat = '$_GET[idrwyt]'";
  $ssq = mysql_query("$sqlqu $kondisi");
  $dat = mysql_fetch_array($ssq);
}
$num = mysql_num_rows(mysql_query($sqlqu));
$count = $num+1;
?>
            <ol class="breadcrumb pull-right">
                <li class="breadcrumb-item"><a href="?act=dashboard&actv=d">Home</a></li>
                <li class="breadcrumb-item active">Data Pasien Masuk</li>
            </ol>

            <h1 class="page-header">Data Pasien Masuk</h1>
            <div class="row">
            <?php if($_GET[add] == "active"){ $col = 8; ?>
                <div class="col-lg-4 ui-sortable">
                    <div class="panel panel-inverse">
                        <div class="panel-heading ui-sortable-handle">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-refresh"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Form Input Pasien Masuk</h4>
                        </div>
                        <div class="panel-body">
                            <form method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <label>Tanggal Masuk</label>
                                        <!-- <input type="text" class="form-control" value="<?php if (empty($_GET[idrwyt])) { echo tgl_indo($vdate); }else{ echo tgl_indo($dat[TglMasuk]); }?>" readonly="readonly" /> -->
                                        <input type="date" class="form-control" name="tglmasuk" value="<?=substr($dat[TglMasuk], 0,10)?>"/>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 0">
                                        <label>No. RM</label>
                                    </div>
                                    <div class="input-group m-b-10">
                                        <input type="text" class="form-control" name="idpasien" id="idpasien" value="<?=$dat[IDPasien]?>" placeholder="Isi No. RM" readonly>
                                        <a href="#modal-dialog" data-toggle="modal" class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></a>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Pasien</label>
                                        <input type="text" class="form-control" id="namapasien" value="<?=$dat[NamaPasien]?>" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <input type="text" class="form-control" id="jeniskelamin" value="<?=$dat[JenisKelamin]?>" readonly />
                                    </div>
                                    <div class="form-group" style="margin-bottom: 0">
                                        <label>Bangsal</label>
                                    </div>
                                    <div class="input-group m-b-10">
                                        <input type="hidden" name="idruangkelas" id="idruangkelas" value="<?=$dat[IDRuangKelas]?>">
                                        <input type="text" class="form-control" id="kamar" value="<?=$dat[NamaRuangan]?>" placeholder="Pilih bangsal" readonly>
                                        <a href="#modal-dialog1" data-toggle="modal" class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></a>
                                    </div>
                                    <div class="form-group">
                                        <label>Kelas Perawatan</label>
                                        <input type="text" class="form-control" id="kelas" value="<?=$dat[NamaKelas]?>" readonly />
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Status Pasien</label>
                                          <select class="default-select2 form-control" name="statuspasien" required="required">
                                              <option value="">-Pilih Status Pasien-</option>
                                              <?php
                                                $query1 = mysql_query("select IDJenisPembayaran, Nama from tbljenispembayaran where NA = 'N'");
                                                while ($vq1 = mysql_fetch_array($query1)) {
                                                  ?><option value="<?=$vq1[IDJenisPembayaran]?>" <?php if ($dat[IDJenisPembayaran] == $vq1[IDJenisPembayaran]) { echo 'selected="selected"'; } ?>><?=$vq1[Nama]?></option><?php
                                                }
                                              ?>
                                        </select>
                                    </div> -->
                                    
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
                            <h4 style="color: inherit; font-size: 12px; line-height: 20px; margin-bottom: 0; margin-top: 0;">Data Pasien Masuk &nbsp;<a href="?actt=pasien_ruang&actv=pr&add=active" class="btn btn-xs btn-primary m-r-5"><i class="fa fa-plus"></i> Tambah Data</a></h4>
                        </div>

                        <div class="panel-body">
                                        <table id="data-table-default" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="5%" data-orderable="false">No. RM</th>
                                                    <th width="15%" data-orderable="false">Tanggal Masuk</th>
                                                    <th width="20%" data-orderable="false">Nama Pasien</th>
                                                    <th width="10%" data-orderable="false">Jenis Kelamin</th>
                                                    <th width="15%" data-orderable="false">Nama Bangsal</th>
                                                    <!-- <th width="10%" data-orderable="false">Jenis Pelayanan</th> -->
                                                    <th width="13%" data-orderable="false">Kelas</th>
                                                    <!-- <th width="10%" data-orderable="false">Status Pasien</th> -->
                                                    <th width="20%" data-orderable="false">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $no = 0;
                                                $sqld = mysql_query("$sqlqu");
                                                while ($vdat = mysql_fetch_array($sqld)) { $no++;
                                                    if ($vdat[NA] == "Y") { 
                                                        $na = '<a href="?actt=pasien_ruang&actv=pr&na=n&idrwyt='.$vdat[IDRiwayat].'" class="label label-success"><em class="fa fa-check"></em>&nbsp;Enabled</a>';
                                                      }elseif ($vdat[NA] == "N") { 
                                                        $na = '<a href="?actt=pasien_ruang&actv=pr&na=y&idrwyt='.$vdat[IDRiwayat].'" class="label label-danger"><em class="fa fa-close"></em>&nbsp;Hapus</a>';
                                                    }
                                            ?>
                                                <tr <?php if ($vdat[NA] == "Y") { echo 'style="color: red"'; } ?>>
                                                    <td><?=$vdat[IDPasien]?></td>
                                                    <td><?=tgl_indo($vdat[TglMasuk])?></td>
                                                    <td><?=$vdat[NamaPasien]?></td>
                                                    <td><?=$vdat[JenisKelamin]?></td>
                                                    <!-- <td><?=$vdat[Nama]?></td> -->
                                                    <td><?=$vdat[NamaRuangan]?></td>
                                                    <td><?=$vdat[NamaKelas]?></td>
                                                    <!-- <td><?=$vdat[JenisPembayaran]?></td> -->
                                                   
                                                    <td><a class="label label-primary" href="?actt=pasien_ruang&actv=pr&add=active&idrwyt=<?=$vdat[IDRiwayat]?>"><em class="fa fa-edit"></em> &nbsp;Edit</a>&nbsp;<a href="?actt=pasien_ruang&actv=pr&hps=<?=$vdat[IDRiwayat]?>" class="label label-danger"><em class="fa fa-close"></em>&nbsp;Hapus</a></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                    </div>
                </div>
            </div>

                            <div class="modal fade" id="modal-dialog">
                                <div class="modal-dialog" style="max-width:70%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Data Pasien</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                        <table id="lookup" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="1%" data-orderable="false">No. RM</th>
                                                    <th width="20%" data-orderable="false">Nama Pasien</th>
                                                    <th width="10%" data-orderable="false">Jenis Kelamin</th>
                                                    <th width="10%" data-orderable="false">Alamat</th>
                                                    <th width="10%" data-orderable="false">Telp</th>
                                                    <th width="10%" data-orderable="false">Umur</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $nx = 0;
                                                $sqlx = mysql_query("select * from tblpasien where NA = 'N'");
                                                while ($vx = mysql_fetch_array($sqlx)) { $nx++;
                                            ?>
                                                <tr class="pilihPsn" data-idPasien="<?=$vx[IDPasien]?>" data-nmPasien="<?=$vx[NamaPasien]?>" data-nmJk="<?=$vx[JenisKelamin]?>">
                                                    <td><?=$vx[IDPasien]?></td>
                                                    <td><a href="#"><?=$vx[NamaPasien]?></a></td>
                                                    <td><?php if($vx[JenisKelamin] == 'P'){ echo "Perempuan"; }elseif ($vx[JenisKelamin] == 'L') { echo "Laki-laki"; } ?></td>
                                                    <td><?=$vx[Alamat]?></td>
                                                    <td><?=$vx[Telp]?></td>
                                                    <td><?=$vx[Umur]?></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="modal-dialog1">
                                <div class="modal-dialog" style="max-width:70%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Data Bangsal Kelas</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                        <table id="lookup1" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="1%" data-orderable="false">No</th>
                                                    <th width="20%" data-orderable="false">Nama Bangsal</th>
                                                    <th width="10%" data-orderable="false">Kelas Perawatan</th>
                                                    <th width="10%" data-orderable="false">Jumlah TT</th>
                                                    <th width="10%" data-orderable="false">TT Pakai</th>
                                                    <th width="10%" data-orderable="false">TT Kosong</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $nc = 0;
                                                $sqlc = mysql_query("SELECT
  `tblruangan`.`NamaRuangan`,
  `tblruang_kelas`.`IDRuangKelas`,
  `tblkelas`.`NamaKelas`,
  `tblruang_kelas`.`JumlahTT`,
  `tblruang_kelas`.`Jml_TTPakai`,
  `tblruang_kelas`.`JumlahTT` - `tblruang_kelas`.`Jml_TTPakai` as TTKosong
FROM
  `tblruang_kelas`
  INNER JOIN `tblruangan` ON `tblruangan`.`IDRuangan` =
`tblruang_kelas`.`IDRuangan`
  INNER JOIN `tblkelas` ON `tblruang_kelas`.`IDKelas` = `tblkelas`.`IDKelas` where tblruang_kelas.NA = 'N'");
                                                while ($vc = mysql_fetch_array($sqlc)) { $nc++;
                                            ?>
                                                <tr class="pilihKK" data-idruangkelas="<?=$vc[IDRuangKelas]?>" data-kamar="<?=$vc[NamaRuangan]?>" data-kelas="<?=$vc[NamaKelas]?>">
                                                    <td><?=$nc?></td>
                                                    <td><a href="#"><?=$vc[NamaRuangan]?></a></td>
                                                    <td><?=$vc[NamaKelas]?></td>
                                                    <td><?=$vc[JumlahTT]?></td>
                                                    <td><?=$vc[Jml_TTPakai]?></td>
                                                    <td><?=$vc[TTKosong]?></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
<?php
  if (isset($_POST[simpan])) {
    $datetime = $_POST[tglmasuk]." ".date("H:i:s");
    $sqlk = mysql_query("select Jml_TTPakai from tblruang_kelas where IDRuangKelas = '$_POST[idruangkelas]'");
    $vlk = mysql_fetch_array($sqlk);

    if (empty($_GET[idrwyt])) {
      mysql_query("insert into tblriwayat (IDPasien, IDRuangKelas, IDJenisPembayaran,  TglMasuk, BaruLama) values ('$_POST[idpasien]', '$_POST[idruangkelas]', '$_POST[statuspasien]',  '$datetime', '$_POST[brlm]')");
      mysql_query("update tblruang_kelas set Jml_TTPakai = $vlk[Jml_TTPakai]+'1' where IDRuangKelas = '$_POST[idruangkelas]'");
      echo '<meta http-equiv="refresh" content="0;url=?actt=pasien_ruang&actv=pr">';
    }else{
      mysql_query("update tblriwayat set IDPasien = '$_POST[idpasien]', IDRuangKelas = '$_POST[idruangkelas]', IDJenisPembayaran = '$_POST[statuspasien]', TglMasuk = '$datetime', BaruLama = '$_POST[brlm]' where IDRiwayat = '$_GET[idrwyt]'");
      echo '<meta http-equiv="refresh" content="0;url=?actt=pasien_ruang&actv=pr">';
    }
  }

  if (isset($_GET[hps])) {
      mysql_query("delete from tblriwayat where IDRiwayat = '$_GET[hps]'");
      echo '<meta http-equiv="refresh" content="0;url=?actt=pasien_ruang&actv=pr">';
  }
?>