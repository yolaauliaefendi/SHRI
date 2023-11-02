<?php
$sqlqu = "select * from tbldiagnosa where NA = 'N'";
if (empty($_GET[iddiagnosa])) {
  $kondisi = "";
}else{
  $kondisi = "where IDDiagnosa = '$_GET[iddiagnosa]'";
  $ssq = mysql_query("$sqlqu $kondisi");
  $dat = mysql_fetch_array($ssq);
}
$num = mysql_num_rows(mysql_query($sqlqu));
$count = $num+1;
?>
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="?act=dashboard&actv=d">Home</a></li>
				<li class="breadcrumb-item active">Penyakit</li>
			</ol>

			<h1 class="page-header">Penyakit <small>Pendaftaran penyakit baru</small></h1>
						
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
                            <h4 class="panel-title">Formulir Pendaftaran Penyakit</h4>
                        </div>
                        <div class="panel-body">
                            <form method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <label>ID Penyakit</label>
                                        <input type="text" class="form-control" value="<?php if(empty($_GET[iddiagnosa])){ echo $count; } else{ echo $dat[IDDiagnosa]; }?>" readonly="readonly" />
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Penyakit</label>
                                        <input type="text" class="form-control" name="nama" value="<?=$dat[Nama]?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>Kode ICD-10</label>
                                        <input type="text" class="form-control" name="kdicd" value="<?=$dat[KodeICD]?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <input type="text" class="form-control" name="deskripsi" value="<?=$dat[Deskripsi]?>" />
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
                            <h4 class="panel-title">Data Penyakit</h4>
                        </div>

                        <div class="panel-body">
            							<table id="data-table-default" class="table table-striped table-bordered">
            								<thead>
            									<tr>
            										<th width="1%" data-orderable="false">No</th>
            										<th width="20%" data-orderable="false">Nama Penyakit</th>
                                                    <th width="10%" data-orderable="false">Kode Icd-10</th>
                                                    <th width="10%" data-orderable="false">Deskripsi</th>
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
                                                    <td><?=$vdat[Nama]?></td>
                                                    <td><?=$vdat[KodeICD]?></td>
                                                    <td><?=$vdat[Deskripsi]?></td>
            										<td>
            										<?php 
            		                                  if ($vdat[NA] == "Y") { 
            		                                    echo '<div class="label label-danger">Disabled</div>'; 
            		                                    $na = '<a href="?actm=mpenyakit&actv=mpe&na=n&iddiagnosa='.$vdat[IDDiagnosa].'" class="label label-success"><em class="fa fa-check"></em>&nbsp;Enabled</a>';
            		                                  }elseif ($vdat[NA] == "N") { 
            		                                    echo '<div class="label label-success">Enabled</div>'; 
            		                                    $na = '<a href="?actm=mpenyakit&actv=mpe&na=y&iddiagnosa='.$vdat[IDDiagnosa].'" class="label label-danger"><em class="fa fa-close"></em>&nbsp;Hapus</a>';
            		                                  }
            		                                ?>
            										</td>
            										<td><a class="label label-primary" href="?actm=mpenyakit&actv=mpe&iddiagnosa=<?=$vdat[IDDiagnosa]?>"><em class="fa fa-edit"></em> &nbsp;Edit</a>&nbsp;<?=$na?></td>
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
    if (empty($_GET[iddiagnosa])) {
      mysql_query("insert into tbldiagnosa (Nama, KodeICD, Deskripsi) values ('$_POST[nama]', '$_POST[kdicd]', '$_POST[deskripsi]')");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mpenyakit&actv=mpe">';
    }else{
      mysql_query("update tbldiagnosa set Nama = '$_POST[nama]', KodeICD = '$_POST[kdicd]', Deskripsi = '$_POST[deskripsi]' where IDDiagnosa = '$_GET[iddiagnosa]'");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mpenyakit&actv=mpe">';
    }
  }

  if ($_GET[na] == "y") {
      mysql_query("update tbldiagnosa set NA = 'Y' where IDDiagnosa = '$_GET[iddiagnosa]'");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mpenyakit&actv=mpe">';
  }elseif ($_GET[na] == "n") {
      mysql_query("update tbldiagnosa set NA = 'N' where IDDiagnosa = '$_GET[iddiagnosa]'");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mpenyakit&actv=mpe">';
  }
?>