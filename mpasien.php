<?php
$sqlqu = "select * from tblpasien where NA = 'N'";
if (empty($_GET[idpasien])) {
  $kondisi = "";
}else{
  $kondisi = "where IDPasien = '$_GET[idpasien]'";
  $ssq = mysql_query("$sqlqu $kondisi");
  $dat = mysql_fetch_array($ssq);
  $read = "readonly";
}
$num = mysql_num_rows(mysql_query($sqlqu));
$count = $num+1;
?>
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="?act=dashboard&actv=d">Home</a></li>
				<li class="breadcrumb-item active">Pasien</li>
			</ol>

			<h1 class="page-header">Pasien <small>Input Pasien</small></h1>
						
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
                            <h4 class="panel-title">Form Input Pasien</h4>
                        </div>
                        <div class="panel-body">
                            <form method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <label>No RM</label>
                                        <input type="text" class="form-control" value="<?=$dat[IDPasien]?>" name="idrm" <?=$read?> />
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Pasien</label>
                                        <input type="text" class="form-control" name="nama" value="<?=$dat[NamaPasien]?>" />
                                    </div>
                                    <label>Jenis Kelamin</label>
                                    <div class="form-group">
                                        <div class="radio radio-css radio-inline">
                                          <input type="radio" name="jk" id="inlineCssRadio1" value="L" <?php if($dat[JenisKelamin] == 'L'){ echo 'checked=""';} ?>>
                                          <label for="inlineCssRadio1">Laki-laki</label>
                                        </div>
                                        <div class="radio radio-css radio-inline">
                                          <input type="radio" name="jk" id="inlineCssRadio2" value="P" <?php if($dat[JenisKelamin] == 'P'){ echo 'checked=""';} ?>>
                                          <label for="inlineCssRadio2">Perempuan</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="tgllhr" value="<?=$dat[TanggalLahir]?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>Agama</label>
                                          <select class="default-select2 form-control" name="agama" required="required">
                                              <option value="">-Pilih Agama-</option>
                                              <option value="Islam" <?php if ($dat[Agama] == "Islam") { echo 'selected="selected"'; } ?>>Islam</option>
                                              <option value="Hindu" <?php if ($dat[Agama] == "Hindu") { echo 'selected="selected"'; } ?>>Hindu</option>
                                              <option value="Kristen" <?php if ($dat[Agama] == "Kristen") { echo 'selected="selected"'; } ?>>Kristen</option>
                                              <option value="Budha" <?php if ($dat[Agama] == "Budha") { echo 'selected="selected"'; } ?>>Budha</option>
                                              <option value="Katholik" <?php if ($dat[Agama] == "Katholik") { echo 'selected="selected"'; } ?>>Katholik</option>
                                              <option value="Lainnya" <?php if ($dat[Agama] == "Lainnya") { echo 'selected="selected"'; } ?>>Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text" class="form-control" name="alamat" value="<?=$dat[Alamat]?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>Kewarganegaraan</label>
                                        <input type="text" class="form-control" name="kewarganegaraan" value="<?=$dat[Kewarganegaraan]?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>Telepon</label>
                                        <input type="number" class="form-control" name="telp" value="<?=$dat[Telp]?>" />
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
                            <h4 class="panel-title">Data Pasien</h4>
                        </div>

                        <div class="panel-body">
            							<table id="data-table-default" class="table table-striped table-bordered">
            								<thead>
            									<tr>
            										<th width="1%" data-orderable="false">No</th>
                                                    <th width="20%" data-orderable="false">RM</th>
            										<th width="20%" data-orderable="false">Nama Pasien</th>
                                                    <th width="10%" data-orderable="false">Jenis Kelamin</th>
                                                    <th width="10%" data-orderable="false">Tanggal Lahir</th>
                                                    <th width="10%" data-orderable="false">Agama</th>
                                                    <th width="10%" data-orderable="false">Alamat</th>
                                                    <th width="10%" data-orderable="false">Kewarganegaraan</th>
                                                    <th width="10%" data-orderable="false">Telp</th>
                                                    <th width="10%" data-orderable="false">Umur</th>
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
                                                    <td><?=$vdat[IDPasien]?></td>
                                                    <td><?=$vdat[NamaPasien]?></td>
                                                    <td><?php if($vdat[JenisKelamin] == 'P'){ echo "Perempuan"; }elseif ($vdat[JenisKelamin] == 'L') { echo "Laki-laki"; } ?></td>
                                                    <td><?=tgl_indo($vdat[TanggalLahir])?></td>
                                                    <td><?=$vdat[Agama]?></td>
                                                    <td><?=$vdat[Alamat]?></td>
                                                    <td><?=$vdat[Kewarganegaraan]?></td>
                                                    <td><?=$vdat[Telp]?></td>
            										<td><?=date("Y")-substr($vdat[TanggalLahir], 0, 4)?></td>
            										<td>
            										<?php 
            		                                  if ($vdat[NA] == "Y") { 
            		                                    echo '<div class="label label-danger">Disabled</div>'; 
            		                                    $na = '<a href="?actm=mpasien&actv=mp&na=n&idpasien='.$vdat[IDPasien].'" class="label label-success"><em class="fa fa-check"></em>&nbsp;Enabled</a>';
            		                                  }elseif ($vdat[NA] == "N") { 
            		                                    echo '<div class="label label-success">Enabled</div>'; 
            		                                    $na = '<a href="?actm=mpasien&actv=mp&na=y&idpasien='.$vdat[IDPasien].'" class="label label-danger"><em class="fa fa-close"></em>&nbsp;Hapus</a>';
            		                                  }
            		                                ?>
            										</td>
            										<td><a class="label label-primary" href="?actm=mpasien&actv=mp&idpasien=<?=$vdat[IDPasien]?>"><em class="fa fa-edit"></em> &nbsp;Edit</a>&nbsp;<?=$na?></td>
            									</tr>
            								<?php } ?>
            								</tbody>
            							</table>
            						</div>
                    </div>
                </div>
            </div>

<?php //perintah menyimpan
  if (isset($_POST[simpan])) {
    if (empty($_GET[idpasien])) {
      mysql_query("insert into tblpasien (IDPasien, NamaPasien, JenisKelamin, TanggalLahir, Agama, Alamat, Kewarganegaraan, Telp) values ('$_POST[idrm]', '$_POST[nama]', '$_POST[jk]', '$_POST[tgllhr]', '$_POST[agama]', '$_POST[alamat]', '$_POST[kewarganegaraan]', '$_POST[telp]')");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mpasien&actv=mp">';
    }else{
        //untuk mengedit
      mysql_query("update tblpasien set NamaPasien = '$_POST[nama]', JenisKelamin = '$_POST[jk]', TanggalLahir = '$_POST[tgllhr]', Agama = '$_POST[agama]', Alamat = '$_POST[alamat]', Kewarganegaraan = '$_POST[kewarganegaraan]', Telp = '$_POST[telp]' where IDPasien = '$_GET[idpasien]'");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mpasien&actv=mp">';
    }
  }

  if ($_GET[na] == "y") {
      mysql_query("update tblpasien set NA = 'Y' where IDPasien = '$_GET[idpasien]'");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mpasien&actv=mp">';
  }elseif ($_GET[na] == "n") {
      mysql_query("update tblpasien set NA = 'N' where IDPasien = '$_GET[idpasien]'");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mpasien&actv=mp">';
  }
?>