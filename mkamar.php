<?php
$sqlqu = "SELECT
  `tblruangan`.`IDRuangan`,
  `tblruangan`.`NamaRuangan`,
  `tblruangan`.`IDJenisPelayanan`,
  `tblruangan`.`NA`
FROM
  `tblruangan` where `tblruangan`.`NA` = 'N'";
if (empty($_GET[idkamar])) {
  $kondisi = "";
}else{
  $kondisi = "where IDRuangan = '$_GET[idkamar]'";
  $ssq = mysql_query("$sqlqu $kondisi");
  $dat = mysql_fetch_array($ssq);
}
$num = mysql_num_rows(mysql_query($sqlqu));
$count = $num+1;
?>
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="?act=dashboard&actv=d">Home</a></li>
				<li class="breadcrumb-item active">Bangsal</li>
			</ol>

			<h1 class="page-header">Bangsal <small>Input Bangsal</small></h1>
						
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
                            <h4 class="panel-title">Form Input Bangsal</h4>
                        </div>
                        <div class="panel-body">
                            <form method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <label>ID Bangsal</label>
                                        <input type="text" class="form-control" value="<?php if(empty($_GET[idkamar])){ echo $count; } else{ echo $dat[IDRuangan]; }?>" readonly="readonly" />
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Bangsal</label>
                                        <input type="text" class="form-control" name="nama" value="<?=$dat[NamaRuangan]?>" />
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Jenis Pelayanan</label>
                                          <select class="default-select2 form-control" name="idjpelayanan" required="required">
                                              <option value="">-Pilih Jenis Pelayanan-</option>
                                              <?php
                                                $query1 = mysql_query("select IDJenisPelayanan, Nama from tbljenispelayanan where NA = 'N'");
                                                while ($vq1 = mysql_fetch_array($query1)) {
                                                  ?><option value="<?=$vq1[IDJenisPelayanan]?>" <?php if ($dat[IDJenisPelayanan] == $vq1[IDJenisPelayanan]) { echo 'selected="selected"'; } ?>><?=$vq1[Nama]?></option><?php
                                                }
                                              ?>
                                        </select>
                                    </div> -->
                                    <div class="form-group">
                                        <label>Status</label>
                                        <input type="text" class="form-control" value="<?php if (empty($_GET[idkamar])) { echo 'Aktif'; }else{ if ($dat[NA] == "Y") { echo 'Tidak Aktif'; }elseif ($dat[NA] == "N") { echo 'Aktif'; } }?>" readonly="readonly" />
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
                            <h4 class="panel-title">Data Bangsal</h4>
                        </div>

                        <div class="panel-body">
            							<table id="data-table-default" class="table table-striped table-bordered">
            								<thead>
            									<tr>
            										<th width="1%" data-orderable="false">No</th>
            										<th width="20%" data-orderable="false">Nama Bangsal</th>
                                <!-- <th width="10%" data-orderable="false">Jenis Pelayanan</th> -->
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
            										<!-- <td><?=$vdat[Nama]?></td> -->
            										<td>
            										<?php 
            		                                  if ($vdat[NA] == "Y") { 
            		                                    echo '<div class="label label-danger">Disabled</div>'; 
            		                                    $na = '<a href="?actm=mkamar&actv=mk&na=n&idkamar='.$vdat[IDRuangan].'" class="label label-success"><em class="fa fa-check"></em>&nbsp;Enabled</a>';
            		                                  }elseif ($vdat[NA] == "N") { 
            		                                    echo '<div class="label label-success">Enabled</div>'; 
            		                                    $na = '<a href="?actm=mkamar&actv=mk&na=y&idkamar='.$vdat[IDRuangan].'" class="label label-danger"><em class="fa fa-close"></em>&nbsp;Hapus</a>';
            		                                  }
            		                                ?>
            										</td>
            										<td><a class="label label-primary" href="?actm=mkamar&actv=mk&idkamar=<?=$vdat[IDRuangan]?>"><em class="fa fa-edit"></em> &nbsp;Edit</a>&nbsp;<?=$na?></td>
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
    if (empty($_GET[idkamar])) {
      mysql_query("insert into tblruangan (IDJenisPelayanan, NamaRuangan) values ('$_POST[idjpelayanan]', '$_POST[nama]')");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mkamar&actv=mk">';
    }else{
      mysql_query("update tblruangan set IDJenisPelayanan = '$_POST[idjpelayanan]', NamaRuangan = '$_POST[nama]' where IDRuangan = '$_GET[idkamar]'");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mkamar&actv=mk">';
    }
  }

  if ($_GET[na] == "y") {
      mysql_query("update tblruangan set NA = 'Y' where IDRuangan = '$_GET[idkamar]'");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mkamar&actv=mk">';
  }elseif ($_GET[na] == "n") {
      mysql_query("update tblruangan set NA = 'N' where IDRuangan = '$_GET[idkamar]'");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mkamar&actv=mk">';
  }
?>