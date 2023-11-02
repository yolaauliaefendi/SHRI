<?php
$sqlqu = "SELECT
  a.IDRiwayat, a.IDPasien, a.IDRuangKelas, a.TglMasuk, a.TglKeluar, a.StatusKeluar, a.BaruLama, a.IDRuangAwal, a.TglPindah, b.NamaPasien, c.Jml_TTPakai, d.NamaRuangan, e.NamaKelas
FROM
  tblriwayat a
  INNER JOIN tblpasien b ON a.IDPasien = b.IDPasien
  INNER JOIN tblruang_kelas c ON a.IDRuangKelas = c.IDRuangKelas
  INNER JOIN tblruangan d ON c.IDRuangan = d.IDRuangan
  INNER JOIN tblkelas e ON c.IDKelas = e.IDKelas
Where a.TglKeluar = '0000-00-00 00:00:00'";

$sqlbangsal = "SELECT
  `tblruangan`.`IDRuangan`,
  `tblruangan`.`NamaRuangan`,
  `tbljenisruangan`.`Nama` as JenisRuangan
FROM
  `tbljenisruangan`
  INNER JOIN `tblruangan` ON `tbljenisruangan`.`IDJenisRuangan` =
`tblruangan`.`IDJenisRuangan` where tblruangan.NA = 'N'";
if (empty($_GET[idpb])) {
  $kondisi = "";
}else{
  $kondisi = "and IDRiwayat = '$_GET[idpb]'";
  $ssq = mysql_query("$sqlqu $kondisi");
  $dat = mysql_fetch_array($ssq);
}
$num = mysql_num_rows(mysql_query($sqlqu));
$count = $num+1;
?>
            <ol class="breadcrumb pull-right">
                <li class="breadcrumb-item"><a href="?act=dashboard&actv=d">Home</a></li>
                <li class="breadcrumb-item active">Pasien Pindah</li>
            </ol>

            <h1 class="page-header">Data Pasien Pindah</h1>
                        
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
                            <h4 class="panel-title">Form Input Pasien Pindah</h4>
                        </div>
                        <div class="panel-body">
                            <form method="POST">
                                <fieldset>
                                    <div class="form-group" style="margin-bottom: 0">
                                        <label>No. RM</label>
                                    </div>
                                    <div class="input-group m-b-10">
                                        <input type="text" class="form-control" name="idrmpasien" id="idpasien" value="<?=$dat[IDPasien]?>" placeholder="Isi No. RM" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Pasien</label>
                                        <input type="text" class="form-control" id="namapasien" value="<?=$dat[NamaPasien]?>" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label>Bangsal Awal</label>
                                        <input type="hidden" class="form-control" name="ruangawal" value="<?=$dat[IDRuangKelas]?>" readonly />
                                        <input type="text" class="form-control" value="<?=$dat[NamaRuangan]." - ".$dat[NamaKelas]?>" readonly />
                                    </div>
                                    <div class="form-group" style="margin-bottom: 0">
                                        <label>Bangsal Tujuan</label>
                                    </div>
                                    <div class="input-group m-b-10">
                                        <input type="hidden" name="idruangkelas" id="idruangkelas" value="" required="required">
                                        <input type="text" class="form-control" id="kamar" value="" placeholder="Pilih bangsal" required="required" readonly>
                                        <a href="#modal-dialog1" data-toggle="modal" class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></a>
                                    </div>
                                    <div class="form-group">
                                        <label>Kelas Perawatan</label>
                                        <input type="text" class="form-control" id="kelas" value="" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Pindah</label>
                                        <input type="date" class="form-control" name="tglpindah" value="<?=$dat[TglPindah]?>"/>
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
                            <h4 style="color: inherit; font-size: 12px; line-height: 20px; margin-bottom: 0; margin-top: 0;">Data Pasien Pindah &nbsp;<!-- <a href="?actt=pindah_ruang&actv=pb&add=active" class="btn btn-xs btn-primary m-r-5"><i class="fa fa-plus"></i> Tambah Data</a> --></h4>
                        </div>

                        <div class="panel-body">
                                        <table id="data-table-default" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="1%" data-orderable="false">No. RM</th>
                                                    <th width="10%" data-orderable="false">Nama Pasien</th>
                                                    <th width="10%" data-orderable="false">Bangsal Awal</th>
                                                    <!-- <th width="10%" data-orderable="false">Jenis Pelayanan</th> -->
                                                   
                                                    <th width="10%" data-orderable="false">Tanggal Masuk</th>
                                                    <th width="10%" data-orderable="false">Bangsal Tujuan</th>
                                                    <th width="10%" data-orderable="false">Tanggal Pindah</th>
                                                    <th width="10%" data-orderable="false">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $no = 0;
                                                $sqld = mysql_query("$sqlqu");
                                                while ($vdat = mysql_fetch_array($sqld)) { $no++;
                                                  $ruangx = mysql_fetch_array(mysql_query("select NamaRuangan, NamaKelas from tblruang_kelas a inner join tblruangan b on a.IDRuangan = b.IDRuangan inner join tblkelas c on a.IDKelas = c.IDKelas where a.IDRuangKelas = '$vdat[IDRuangAwal]'"));
                                            ?>
                                                <tr <?php if ($vdat[NA] == "Y") { echo 'style="color: red"'; } ?>>
                                                    <td><?=$vdat[IDPasien]?></td>
                                                    <td><?=$vdat[NamaPasien]?></td>
                                                   <td>
                                                    <?php
                                                      if (empty($vdat[IDRuangAwal])) {
                                                        echo $vdat[NamaRuangan]." - ".$vdat[NamaKelas];
                                                      }else{
                                                        echo $ruangx[NamaRuangan]." - ".$ruangx[NamaKelas];
                                                      }
                                                    ?></td>
                                                    <!-- <td><?=$vdat[Nama]?></td> -->
                                                   
                                                    <td><?=tgl_indo($vdat[TglMasuk])?></td>
                                                    <td>
                                                      <?php
                                                        if (empty($vdat[IDRuangAwal])) {
                                                          echo "";
                                                        }else{
                                                          echo $vdat[NamaRuangan]." - ".$vdat[NamaKelas];
                                                        }
                                                      ?></td>
                                                    <td><?=tgl_indo($vdat[TglPindah])?></td>
                                                    <td><a class="label label-primary" href="?actt=pindah_ruang&actv=pb&add=active&idpb=<?=$vdat[IDRiwayat]?>"><em class="fa fa-edit"></em> &nbsp;Pindah</a>&nbsp;<?=$na?></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
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
                                                <tr <?php if($vc[TTKosong] > 0){ if ($dat[IDRuangKelas] != $vc[IDRuangKelas]) {?>class="pilihKK" data-idruangkelas="<?=$vc[IDRuangKelas]?>" data-kamar="<?=$vc[NamaRuangan]?>" data-kelas="<?=$vc[NamaKelas]?>" <?php }} ?>>
                                                    <td><?=$nc?></td>
                                                    <td>
                                                        <?php if($vc[TTKosong] > 0){
                                                            if ($dat[IDRuangKelas] != $vc[IDRuangKelas]) {
                                                                echo '<a href="#">'.$vc[NamaRuangan].'</a>';
                                                            }else{
                                                                echo $vc[NamaRuangan];
                                                            }
                                                        } else{
                                                            echo $vc[NamaRuangan];
                                                        }?></td>
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
    $tgl1 = substr($dat[TglMasuk],0,10);
    $tgl2 = $_POST[tglpindah];
    if($tgl2 >= $tgl1){
      $datetime = $_POST[tglpindah]." ".date("H:i:s");
      mysql_query("update tblruang_kelas set Jml_TTPakai = $dat[Jml_TTPakai]-'1' where IDRuangKelas = '$dat[IDRuangKelas]'");

      $sqlk = mysql_query("select Jml_TTPakai from tblruang_kelas where IDRuangKelas = '$_POST[idruangkelas]'");
      $vlk = mysql_fetch_array($sqlk);

      mysql_query("update tblriwayat set IDRuangKelas = '$_POST[idruangkelas]',   IDRuangAwal = '$_POST[ruangawal]', TglPindah = '$datetime' WHERE IDRiwayat = '$_GET[idpb]'");

      
      mysql_query("update tblruang_kelas set Jml_TTPakai = $vlk[Jml_TTPakai]+'1' where IDRuangKelas = '$_POST[idruangkelas]'");
      
      echo '<meta http-equiv="refresh" content="0;url=?actt=pindah_ruang&actv=pb">';
    }else{
        echo '<script type="text/javascript">alert("Pastikan pilih tanggal pindah dengan benar...");
        document.location = "?actt=pindah_ruang&actv=pb&add=active&idpb='.$_GET[idpb].'";
    </script>';
    exit();
    }
  }
?>