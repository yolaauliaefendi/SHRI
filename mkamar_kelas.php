<?php
$sqlqu = "SELECT
  `tblruang_kelas`.`IDRuangKelas`,
  `tblruang_kelas`.`IDRuangan`,
  `tblruangan`.`NamaRuangan`,
  `tblruang_kelas`.`IDKelas`,
  `tblkelas`.`NamaKelas`,
  `tblruang_kelas`.`JumlahTT`,
  `tblruang_kelas`.`Jml_TTPakai`,
  `tblruang_kelas`.`NA`,
    `tblruang_kelas`.`JumlahTT` - `tblruang_kelas`.`Jml_TTPakai` as TTKosong
FROM
  `tblruang_kelas`
  INNER JOIN `tblruangan` ON `tblruangan`.`IDRuangan` =
`tblruang_kelas`.`IDRuangan`
  INNER JOIN `tblkelas` ON `tblruang_kelas`.`IDKelas` = `tblkelas`.`IDKelas` where tblruang_kelas.NA = 'N'";
if (empty($_GET[idkmr_kls])) {
  $kondisi = "";
}else{
  $kondisi = "where IDRuangKelas = '$_GET[idkmr_kls]'";
  $ssq = mysql_query("$sqlqu $kondisi");
  $dat = mysql_fetch_array($ssq);
}
$num = mysql_num_rows(mysql_query($sqlqu));
$count = $num+1;
?>
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="?act=dashboard&actv=d">Home</a></li>
				<li class="breadcrumb-item active">Bangsal Kelas</li>
			</ol>

			<h1 class="page-header">Bangsal Kelas <small>Pendaftaran bangsal kelas baru</small></h1>
						
			<div class="row">
			    <div class="col-lg-4 ui-sortable">
                    <div class="panel panel-inverse">
                        <div class="panel-heading ui-sortable-handle">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-refresh"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Formulir Pendaftaran Bangsal Kelas</h4>
                        </div>
                        <div class="panel-body">
                            <form method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <label>ID Bangsal Kelas</label>
                                        <input type="text" class="form-control" value="<?php if(empty($_GET[idkmr_kls])){ echo $count; } else{ echo $dat[IDRuangKelas]; }?>" readonly="readonly" />
                                    </div>
                                    <div class="form-group">
                                        <label>Bangsal</label>
                                          <select class="default-select2 form-control" name="idkamar" required="required">
                                              <option value="">-Pilih Bangsal-</option>
                                              <?php
                                                $query1 = mysql_query("select IDRuangan, NamaRuangan from tblruangan where NA = 'N'");
                                                while ($vq1 = mysql_fetch_array($query1)) {
                                                  ?><option value="<?=$vq1[IDRuangan]?>" <?php if ($dat[IDRuangan] == $vq1[IDRuangan]) { echo 'selected="selected"'; } ?>><?=$vq1[NamaRuangan]?></option><?php
                                                }
                                              ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kelas</label>
                                          <select class="default-select2 form-control" name="idkelas" required="required">
                                              <option value="">-Pilih Kelas-</option>
                                              <?php
                                                $query2 = mysql_query("select IDKelas, NamaKelas from tblkelas where NA = 'N'");
                                                while ($vq2 = mysql_fetch_array($query2)) {
                                                  ?><option value="<?=$vq2[IDKelas]?>" <?php if ($dat[IDKelas] == $vq2[IDKelas]) { echo 'selected="selected"'; } ?>><?=$vq2[NamaKelas]?></option><?php
                                                }
                                              ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Tempat Tidur</label>
                                        <input type="number" class="form-control" name="jumTT" value="<?=$dat[JumlahTT]?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <input type="text" class="form-control" value="<?php if (empty($_GET[idkmr_kls])) { echo 'Aktif'; }else{ if ($dat[NA] == "Y") { echo 'Tidak Aktif'; }elseif ($dat[NA] == "N") { echo 'Aktif'; } }?>" readonly="readonly" />
                                    </div>
                                    <button type="submit" name="simpan" class="btn btn-sm btn-primary m-r-5"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 ui-sortable">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                        <div class="panel-heading ui-sortable-handle">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-refresh"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Data Bangsal Kelas</h4>
                        </div>

                        <div class="panel-body">
            							<table id="data-table-default" class="table table-striped table-bordered">
            								<thead>
            									<tr>
            										<th width="1%" data-orderable="false">No</th>
                                                    <th width="20%" data-orderable="false">Bangsal</th>
                                                    <th width="20%" data-orderable="false">Kelas</th>
                                                    <th width="20%" data-orderable="false">Jumlah TT</th>
                                                    <th width="20%" data-orderable="false">Jumlah TT Pakai</th>
            										<th width="20%" data-orderable="false">Jumlah TT Kosong</th>
            										<th width="10%" data-orderable="false">Status</th>
            										<th width="10%" data-orderable="false">#</th>
            									</tr>
            								</thead>
            								<tbody>
            								<?php
            	                              	$no = 0;
            	                              	$sqld = mysql_query("$sqlqu");
            	                              	while ($vdat = mysql_fetch_array($sqld)) { $no++;
            	                           	?>
            									<tr <?php if ($vdat[NA] == "Y") { echo 'style="color: red"'; } ?>>
            										<td><?=$no?></td>
                                                    <td><?=$vdat[NamaRuangan]?></td>
                                                    <td><?=$vdat[NamaKelas]?></td>
                                                    <td><?=$vdat[JumlahTT]?></td>
                                                    <td><?=$vdat[Jml_TTPakai]?></td>
                                                    <td><?=$vdat[TTKosong]?></td>
            										<td>
            										<?php 
            		                                  if ($vdat[NA] == "Y") { 
            		                                    echo '<div class="label label-danger">Disabled</div>'; 
            		                                    $na = '<a href="?actm=mkamar_kelas&actv=mkk&na=n&idkmr_kls='.$vdat[IDRuangKelas].'" class="label label-success"><em class="fa fa-check"></em>&nbsp;Enabled</a>';
            		                                  }elseif ($vdat[NA] == "N") { 
            		                                    echo '<div class="label label-success">Enabled</div>'; 
            		                                    $na = '<a href="?actm=mkamar_kelas&actv=mkk&na=y&idkmr_kls='.$vdat[IDRuangKelas].'" class="label label-danger"><em class="fa fa-close"></em>&nbsp;Hapus</a>';
            		                                  }
            		                                ?>
            										</td>
            										<td><a class="label label-primary" href="?actm=mkamar_kelas&actv=mkk&idkmr_kls=<?=$vdat[IDRuangKelas]?>"><em class="fa fa-edit"></em> &nbsp;Edit</a>&nbsp;<?=$na?></td>
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
    if (empty($_GET[idkmr_kls])) {
      mysql_query("insert into tblruang_kelas (IDRuangan, IDKelas, JumlahTT) values ('$_POST[idkamar]', '$_POST[idkelas]', '$_POST[jumTT]')");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mkamar_kelas&actv=mkk">';
    }else{
      mysql_query("update tblruang_kelas set IDRuangan = '$_POST[idkamar]', IDKelas = '$_POST[idkelas]', JumlahTT = '$_POST[jumTT]' where IDRuangKelas = '$_GET[idkmr_kls]'");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mkamar_kelas&actv=mkk">';
    }
  }

  if ($_GET[na] == "y") {
      mysql_query("update tblruang_kelas set NA = 'Y' where IDRuangKelas = '$_GET[idkmr_kls]'");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mkamar_kelas&actv=mkk">';
  }elseif ($_GET[na] == "n") {
      mysql_query("update tblruang_kelas set NA = 'N' where IDRuangKelas = '$_GET[idkmr_kls]'");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mkamar_kelas&actv=mkk">';
  }
?>