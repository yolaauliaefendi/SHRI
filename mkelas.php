<?php
$sqlqu = "select * from tblkelas where NA = 'N'";
if (empty($_GET[idkls])) {
  $kondisi = "";
}else{
  $kondisi = "where IDKelas = '$_GET[idkls]'";
  $ssq = mysql_query("$sqlqu $kondisi");
  $dat = mysql_fetch_array($ssq);
}
$num = mysql_num_rows(mysql_query($sqlqu));
$count = $num+1;
?>
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="?act=dashboard&actv=d">Home</a></li>
				<li class="breadcrumb-item active">Kelas</li>
			</ol>

			<h1 class="page-header">Kelas <small>Pendaftaran kelas baru</small></h1>
						
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
                            <h4 class="panel-title">Formulir Pendaftaran Kelas</h4>
                        </div>
                        <div class="panel-body">
                            <form method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <label>ID Kelas</label>
                                        <input type="text" class="form-control" value="<?php if(empty($_GET[idkls])){ echo $count; } else{ echo $dat[IDKelas]; }?>" readonly="readonly" />
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Kelas</label>
                                        <select class="default-select2 form-control" name="nama" required="required">
                                              <option value="">-Pilih Kelas-</option>
                                              <option value="VVIP" <?php if ($dat[NamaKelas] == "VVIP") { echo 'selected="selected"'; } ?>>VVIP</option>
                                              <option value="VIP" <?php if ($dat[NamaKelas] == "VIP") { echo 'selected="selected"'; } ?>>VIP</option>
                                              <option value="I" <?php if ($dat[NamaKelas] == "I") { echo 'selected="selected"'; } ?>>I</option>
                                              <option value="II" <?php if ($dat[NamaKelas] == "II") { echo 'selected="selected"'; } ?>>II</option>
                                              <option value="III" <?php if ($dat[NamaKelas] == "III") { echo 'selected="selected"'; } ?>>III</option>
                                              <option value="Kelas Khusus" <?php if ($dat[NamaKelas] == "Kelas Khusus") { echo 'selected="selected"'; } ?>>Kelas Khusus</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <input type="text" class="form-control" value="<?php if (empty($_GET[idkls])) { echo 'Aktif'; }else{ if ($dat[NA] == "Y") { echo 'Tidak Aktif'; }elseif ($dat[NA] == "N") { echo 'Aktif'; } }?>" readonly="readonly" />
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
                            <h4 class="panel-title">Data Kelas</h4>
                        </div>

                        <div class="panel-body">
            							<table id="data-table-default" class="table table-striped table-bordered">
            								<thead>
            									<tr>
            										<th width="1%" data-orderable="false">No</th>
            										<th width="20%" data-orderable="false">Nama Kelas</th>
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
                                                    <td><?=$vdat[NamaKelas]?></td>
            										<td>
            										<?php 
            		                                  if ($vdat[NA] == "Y") { 
            		                                    echo '<div class="label label-danger">Disabled</div>'; 
            		                                    $na = '<a href="?actm=mkelas&actv=mks&na=n&idkls='.$vdat[IDKelas].'" class="label label-success"><em class="fa fa-check"></em>&nbsp;Enabled</a>';
            		                                  }elseif ($vdat[NA] == "N") { 
            		                                    echo '<div class="label label-success">Enabled</div>'; 
            		                                    $na = '<a href="?actm=mkelas&actv=mks&na=y&idkls='.$vdat[IDKelas].'" class="label label-danger"><em class="fa fa-close"></em>&nbsp;Hapus</a>';
            		                                  }
            		                                ?>
            										</td>
            										<td><a class="label label-primary" href="?actm=mkelas&actv=mks&idkls=<?=$vdat[IDKelas]?>"><em class="fa fa-edit"></em> &nbsp;Edit</a>&nbsp;<?=$na?></td>
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
    if (empty($_GET[idkls])) {
      mysql_query("insert into tblkelas (NamaKelas) values ('$_POST[nama]')");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mkelas&actv=mks">';
    }else{
      mysql_query("update tblkelas set NamaKelas = '$_POST[nama]' where IDKelas = '$_GET[idkls]'");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mkelas&actv=mks">';
    }
  }

  if ($_GET[na] == "y") {
      mysql_query("update tblkelas set NA = 'Y' where IDKelas = '$_GET[idkls]'");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mkelas&actv=mks">';
  }elseif ($_GET[na] == "n") {
      mysql_query("update tblkelas set NA = 'N' where IDKelas = '$_GET[idkls]'");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mkelas&actv=mks">';
  }
?>