<?php
$sqlqu = "SELECT
  a.IDRiwayat, a.IDPasien, a.IDRuangKelas, a.IDJenisPembayaran, a.TglMasuk, a.TglKeluar, a.BaruLama, 
  b.NamaPasien, c.Jml_TTPakai, d.NamaRuangan, e.NamaKelas, h.Nama as Diagnosa, a.StatusKeluar, a.CaraKeluar
FROM
  tblriwayat a
 LEFT JOIN tblpasien b ON a.IDPasien = b.IDPasien
 LEFT JOIN tblruang_kelas c ON a.IDRuangKelas = c.IDRuangKelas
 LEFT JOIN tblruangan d ON c.IDRuangan = d.IDRuangan
 LEFT JOIN tblkelas e ON c.IDKelas = e.IDKelas
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

            <h1 class="page-header">Data Pasien Keluar</h1>
                        
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
                            <h4 class="panel-title">Form Input Pasien Keluar</h4>
                        </div>
                        <div class="panel-body">
                            <form method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <label>Tanggal Keluar</label>
                                        <!-- <input type="text" class="form-control" value="<?php if (empty($vdat[idrwyt])) { echo tgl_indo($vdate); }else{ echo tgl_indo($dat[TglKeluar]); }?>" readonly="readonly" /> -->
                                        <input type="date" class="form-control" name="tglkeluar" value="<?=substr($dat[TglKeluar], 0,10)?>"/>
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
                                    
                                    <div class="form-group">
                                        <label>Status Keluar</label>
                                          <select class="default-select2 form-control" name="statuskeluar" required="required" id="status_keluar">
                                              <option value="">-Pilih Status Keluar-</option>
                                              <option value="Hidup" <?php if ($dat[StatusPasien] == "Hidup") { echo 'selected="selected"'; } ?>>Hidup</option>
                                              <option value="Meninggal" <?php if ($dat[StatusPasien] == "Meninggal") { echo 'selected="selected"'; } ?>>Meninggal</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Cara Keluar</label>
                                          <select class="default-select2 form-control" name="carakeluar" id="cara_keluar" required="required">
                                              <option value="">-Pilih Cara Keluar-</option>
                                            
                                        </select>
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
                            <h4 style="color: inherit; font-size: 12px; line-height: 20px; margin-bottom: 0; margin-top: 0;">Data Pasien Dirawat <!-- &nbsp;<a href="?actt=pasien_keluar&actv=pk&add=active" class="btn btn-xs btn-primary m-r-5"><i class="fa fa-plus"></i> Tambah Data</a> --></h4>
                        </div>

                        <div class="panel-body">
                                        <table id="data-table-default" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="5%" data-orderable="false">No. RM</th>
                                                    <th width="10%" data-orderable="false">Tanggal Masuk</th>
                                                    <th width="20%" data-orderable="false">Nama Pasien</th>
                                                    <th width="10%" data-orderable="false">Bangsal</th>
                                                    <th width="5%" data-orderable="false">Kelas</th>
                                                    <!-- <th width="5%" data-orderable="false">Jenis Pasien</th>
                                                    <th width="5%" data-orderable="false">Status Pasien</th>
                                                    <th width="5%" data-orderable="false">Cara Keluar</th> -->
                                                    <th width="5%" data-orderable="false">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $no = 0;
                                                $sqld = mysql_query("$sqlqu Where a.TglKeluar = '0000-00-00 00:00:00'");
                                                while ($vdat = mysql_fetch_array($sqld)) { $no++;
                                                    if ($vdat[NA] == "Y") { 
                                                        $na = '<a href="?actt=pasien_ruang&actv=pr&na=n&idrwyt='.$vdat[idrwyt].'" class="label label-success"><em class="fa fa-check"></em>&nbsp;Enabled</a>';
                                                      }elseif ($vdat[NA] == "N") { 
                                                        $na = '<a href="?actt=pasien_ruang&actv=pr&na=y&idrwyt='.$vdat[idrwyt].'" class="label label-danger"><em class="fa fa-close"></em>&nbsp;Hapus</a>';
                                                    }
                                            ?>
                                                <tr <?php if ($vdat[NA] == "Y") { echo 'style="color: red"'; } ?>>
                                                    <td><?=$vdat[IDPasien]?></td>
                                                    <td><?=tgl_indo($vdat[TglMasuk])?></td>
                                                    <td><?=$vdat[NamaPasien]?></td>
                                                    <td><?=$vdat[NamaRuangan]?></td>
                                                    <td><?=$vdat[NamaKelas]?></td>
                                                    <!-- <td><?=$vdat[JenisPembayaran]?></td>
                                                    <td><?=$vdat[StatusKeluar]?></td>
                                                    <td><?=$vdat[CaraKeluar]?></td> -->
                                                  
                                                    <td><a class="label label-primary" href="?actt=pasien_keluar&actv=pk&add=active&idrwyt=<?=$vdat[IDRiwayat]?>"><em class="fa fa-sign-out"></em> &nbsp;Keluar</a>&nbsp;<?=$na?></td>
                                                </tr>
                                            <?php } ?>
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
                            <h4 style="color: inherit; font-size: 12px; line-height: 20px; margin-bottom: 0; margin-top: 0;">Data Pasien Keluar </h4>
                        </div>

                        <div class="panel-body">
                                        <table id="lookup" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="5%" data-orderable="false">No. RM</th>
                                                    <th width="10%" data-orderable="false">Tanggal Keluar</th>
                                                    <th width="20%" data-orderable="false">Nama Pasien</th>
                                                    <th width="10%" data-orderable="false">Bangsal</th>
                                                    <th width="5%" data-orderable="false">Kelas</th>
                                                    <!-- <th width="10%" data-orderable="false">Jenis Pasien</th> -->
                                                    <th width="10%" data-orderable="false">Status Keluar</th>
                                                     <th width="10%" data-orderable="false">Cara Keluar</th>
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
                                                    <!-- <td><?=$vdat[JenisPembayaran]?></td> -->
                                                    <td><?=$vdat[StatusKeluar]?></td>
                                                    <td><?=$vdat[CaraKeluar]?></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                    </div>
                </div>
            </div>


<?php
  if (isset($_POST[simpan])) {
    $datetime = $_POST[tglkeluar]." ".date("H:i:s");
      mysql_query("update tblriwayat set IDPetugas = '$_SESSION[id]', TglKeluar = '$datetime', StatusKeluar = '$_POST[statuskeluar]', CaraKeluar = '$_POST[carakeluar]' where IDRiwayat = '$_GET[idrwyt]'");
      mysql_query("update tblruang_kelas set Jml_TTPakai = $dat[Jml_TTPakai]-'1' where IDRuangKelas = '$dat[IDRuangKelas]'");
      echo '<meta http-equiv="refresh" content="0;url=?actt=pasien_keluar&actv=pk">';
      exit;
  }

  if ($_GET[na] == "y") {
      mysql_query("update rm_ruang set NA = 'Y' where idrwyt = '$_GET[idrwyt]'");
      echo '<meta http-equiv="refresh" content="0;url=?actt=pasien_ruang&actv=pr">';
      exit;
  }elseif ($_GET[na] == "n") {
      mysql_query("update rm_ruang set NA = 'N' where idrwyt = '$_GET[idrwyt]'");
      echo '<meta http-equiv="refresh" content="0;url=?actt=pasien_ruang&actv=pr">';
      exit;
  }
?>