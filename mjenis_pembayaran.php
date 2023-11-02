<?php
$sqlqu = "select * from tbljenispembayaran";
if (empty($_GET[idjpembayaran])) {
  $kondisi = "";
}else{
  $kondisi = "where IDJenisPembayaran = '$_GET[idjpembayaran]'";
  $ssq = mysql_query("$sqlqu $kondisi");
  $dat = mysql_fetch_array($ssq);
}
$num = mysql_num_rows(mysql_query($sqlqu));
$count = $num+1;
?>
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="?act=dashboard&actv=d">Home</a></li>
				<li class="breadcrumb-item active">Jenis Pembayaran</li>
			</ol>

			<h1 class="page-header">Jenis Pembayaran <small>Pendaftaran jenis pembayaran baru</small></h1>
						
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
                            <h4 class="panel-title">Formulir Pendaftaran Jenis Pembayaran</h4>
                        </div>
                        <div class="panel-body">
                            <form method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <label>ID Jenis Pembayaran</label>
                                        <input type="text" class="form-control" value="<?php if(empty($_GET[idjpembayaran])){ echo $count; } else{ echo $dat[IDJenisPembayaran]; }?>" readonly="readonly" />
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Jenis Pembayaran</label>
                                        <input type="text" class="form-control" name="nama" value="<?=$dat[Nama]?>" />
                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>
                                        <input type="text" class="form-control" value="<?php if (empty($_GET[idjpembayaran])) { echo 'Aktif'; }else{ if ($dat[NA] == "Y") { echo 'Tidak Aktif'; }elseif ($dat[NA] == "N") { echo 'Aktif'; } }?>" readonly="readonly" />
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
                            <h4 class="panel-title">Data Jenis Pembayaran</h4>
                        </div>

                        <div class="panel-body">
            							<table id="data-table-default" class="table table-striped table-bordered">
            								<thead>
            									<tr>
            										<th width="1%" data-orderable="false">No</th>
            										<th width="20%" data-orderable="false">Nama Jenis Pembayaran</th>
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
            										<td>
            										<?php 
            		                                  if ($vdat[NA] == "Y") { 
            		                                    echo '<div class="label label-danger">Disabled</div>'; 
            		                                    $na = '<a href="?actm=mjenis_pembayaran&actv=mjb&na=n&idjpembayaran='.$vdat[IDJenisPembayaran].'" class="label label-success"><em class="fa fa-check"></em>&nbsp;Enabled</a>';
            		                                  }elseif ($vdat[NA] == "N") { 
            		                                    echo '<div class="label label-success">Enabled</div>'; 
            		                                    $na = '<a href="?actm=mjenis_pembayaran&actv=mjb&na=y&idjpembayaran='.$vdat[IDJenisPembayaran].'" class="label label-danger"><em class="fa fa-close"></em>&nbsp;Disabled</a>';
            		                                  }
            		                                ?>
            										</td>
            										<td><a class="label label-primary" href="?actm=mjenis_pembayaran&actv=mjb&idjpembayaran=<?=$vdat[IDJenisPembayaran]?>"><em class="fa fa-edit"></em> &nbsp;Edit</a>&nbsp;<?=$na?></td>
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
    if (empty($_GET[idjpembayaran])) {
      mysql_query("insert into tbljenispembayaran (Nama) values ('$_POST[nama]')");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mjenis_pembayaran&actv=mjb">';
    }else{
      mysql_query("update tbljenispembayaran set Nama = '$_POST[nama]' where IDJenisPembayaran = '$_GET[idjpembayaran]'");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mjenis_pembayaran&actv=mjb">';
    }
  }

  if ($_GET[na] == "y") {
      mysql_query("update tbljenispembayaran set NA = 'Y' where IDJenisPembayaran = '$_GET[idjpembayaran]'");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mjenis_pembayaran&actv=mjb">';
  }elseif ($_GET[na] == "n") {
      mysql_query("update tbljenispembayaran set NA = 'N' where IDJenisPembayaran = '$_GET[idjpembayaran]'");
      echo '<meta http-equiv="refresh" content="0;url=?actm=mjenis_pembayaran&actv=mjb">';
  }
?>