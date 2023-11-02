<?php
$sqlqu = "select a.IDPetugas, a.NIP, a.Nama, a.JenisKelamin, a.Alamat, a.Agama, a.Kewarganegaraan, a.Telp, a.IDLevel, a.NA, b.NamaLevel, c.Username, c.IDUser from tblpetugas a inner join tbllevel b on a.IDLevel = b.IDLevel INNER JOIN tbluser c on a.IDPetugas = c.IDPetugas where a.NA = 'N'";
if (empty($_GET[idpetugas])) {
  $kondisi = "";
}else{
  $kondisi = "where a.IDPetugas = '$_GET[idpetugas]'";
  $ssq = mysql_query("$sqlqu $kondisi");
  $dat = mysql_fetch_array($ssq);
}
$num = mysql_num_rows(mysql_query("select * from tblpetugas"));
$count = $num+1;
?>
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="?act=dashboard&actv=d">Home</a></li>
				<li class="breadcrumb-item active">User</li>
			</ol>

			<h1 class="page-header">User <small>Input User</small></h1>
						
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
                            <h4 class="panel-title">For Input User</h4>
                        </div>
                        <div class="panel-body">
                            <form method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <label>NIP</label>
                                        <input type="number" name="nip" class="form-control" placeholder="Masukkan NIP" maxlength="11" value="<?php if(empty($_GET[idpetugas])){ } else{ echo $dat[NIP]; }?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" class="form-control" name="nama" value="<?=$dat[Nama]?>" />
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
                                    <div class="form-group">
                                        <label>Sebagai</label>
                                          <select class="default-select2 form-control" name="idlevel" required="required">
                                              <option value="">-Pilih Sebagai-</option>
                                              <?php
                                                $query1 = mysql_query("select IDLevel, NamaLevel from tbllevel where NA = 'N'");
                                                while ($vq1 = mysql_fetch_array($query1)) {
                                                  ?><option value="<?=$vq1[IDLevel]?>" <?php if ($dat[IDLevel] == $vq1[IDLevel]) { echo 'selected="selected"'; } ?>><?=$vq1[NamaLevel]?></option><?php
                                                }
                                              ?>
                                        </select>
                                    </div>
                                    <hr/>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control" placeholder="Masukkan usename" value="<?=$dat[Username]?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Masukkan password" />
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
                            <h4 class="panel-title">Data Petugas</h4>
                        </div>

                        <div class="panel-body">
            							<table id="data-table-default" class="table table-striped table-bordered">
            								<thead>
            									<tr>
            										<th width="1%" data-orderable="false">No</th>
                                                    <th width="30%" data-orderable="false">NIP</th>
            										<th width="30%" data-orderable="false">Nama Lengkap</th>
                                                    <th width="10%" data-orderable="false">Jenis Kelamin</th>
                                                    <th width="10%" data-orderable="false">Agama</th>
                                                    <th width="10%" data-orderable="false">Alamat</th>
                                                    <th width="10%" data-orderable="false">Kewarganegaraan</th>
                                                    <th width="10%" data-orderable="false">Telp</th>
                                                    <th width="10%" data-orderable="false">Hak Akses  </th>
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
                                                    <td><?=$vdat[NIP]?></td>
                                                    <td><?=$vdat[Nama]?></td>
                                                    <td><?php if($vdat[JenisKelamin] == 'P'){ echo "Perempuan"; }elseif ($vdat[JenisKelamin] == 'L') { echo "Laki-laki"; } ?></td>
                                                    <td><?=$vdat[Agama]?></td>
                                                    <td><?=$vdat[Alamat]?></td>
                                                    <td><?=$vdat[Kewarganegaraan]?></td>
                                                    <td><?=$vdat[Telp]?></td>
                                                    <td><?=$vdat[NamaLevel]?></td>
            										<td>
            										<?php 
            		                                  if ($vdat[NA] == "Y") { 
            		                                    echo '<div class="label label-danger">Disabled</div>'; 
            		                                    $na = '<a href="?actm=mpetugas&actv=mu&na=n&idpetugas='.$vdat[IDPetugas].'" class="label label-success"><em class="fa fa-check"></em>&nbsp;Enabled</a>';
            		                                  }elseif ($vdat[NA] == "N") { 
            		                                    echo '<div class="label label-success">Enabled</div>'; 
            		                                    $na = '<a href="?actm=mpetugas&actv=mu&na=y&idpetugas='.$vdat[IDPetugas].'" class="label label-danger"><em class="fa fa-close"></em>&nbsp;Hapus</a>';
            		                                  }
            		                                ?>
            										</td>
            										<td><a class="label label-primary" href="?actm=mpetugas&actv=mu&idpetugas=<?=$vdat[IDPetugas]?>"><em class="fa fa-edit"></em> &nbsp;Edit</a>&nbsp;<?=$na?></td>
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
    if (empty($_GET[idpetugas])) {
      mysql_query("insert into tblpetugas (NIP, Nama, JenisKelamin, Alamat, Agama, Kewarganegaraan, Telp, IDLevel) values ('$_POST[nip]', '$_POST[nama]', '$_POST[jk]', '$_POST[alamat]', '$_POST[agama]', '$_POST[kewarganegaraan]', '$_POST[telp]', '$_POST[idlevel]')");
      mysql_query("insert into tbluser (IDPetugas, Username, Password, IDLevel) values ('$count', '$_POST[username]', md5('$_POST[password]'), '$_POST[idlevel]')");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mpetugas&actv=mu">';
    }else{
      mysql_query("update tblpetugas set NIP = '$_POST[nip]', Nama = '$_POST[nama]', JenisKelamin = '$_POST[jk]', Alamat = '$_POST[alamat]', Agama = '$_POST[agama]', Kewarganegaraan = '$_POST[kewarganegaraan]', Telp = '$_POST[telp]', IDLevel = '$_POST[idlevel]' where IDPetugas = '$_GET[idpetugas]'");
      if (empty($_POST[password])) {
        $pas = "";
      }else{
        $pas = "Password = md5('$_POST[password]'),";
      }
      mysql_query("update tbluser set Username = '$_POST[username]', $pas IDLevel = '$_POST[idlevel]' where IDPetugas = '$_GET[idpetugas]'");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mpetugas&actv=mu">';
    }
  }

  if ($_GET[na] == "y") {
      mysql_query("update tblpetugas set NA = 'Y' where IDPetugas = '$_GET[idpetugas]'");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mpetugas&actv=mu">';
  }elseif ($_GET[na] == "n") {
      mysql_query("update tblpetugas set NA = 'N' where IDPetugas = '$_GET[idpetugas]'");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mpetugas&actv=mu">';
  }
?>