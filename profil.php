<?php
$tglhr = date_create("$val[TanggalLahir]");
?>
			<!-- begin profile -->
			<div class="profile">
				<div class="profile-header">
					<!-- BEGIN profile-header-cover -->
					<div class="profile-header-cover"></div>
					<!-- END profile-header-cover -->
					<!-- BEGIN profile-header-content -->
					<div class="profile-header-content">
						<!-- BEGIN profile-header-img -->
						<div class="profile-header-img">
							<img src="assets/img/user/<?=$val[Foto]?>?>" alt="">
						</div>
						<!-- END profile-header-img -->
						<!-- BEGIN profile-header-info -->
						<div class="profile-header-info">
							<h4 class="m-t-10 m-b-5"><?=$val[Nama].', '.$val[Gelar]?></h4>
							<p class="m-b-10"><?=$val[NIP]?></p>
							<p class="m-b-10"><?=$val[Username].' - '.$val[NamaJabatan]?></p>
						</div>
						<!-- END profile-header-info -->
					</div>
					<!-- END profile-header-content -->
					<!-- BEGIN profile-header-tab -->
					<ul class="profile-header-tab nav nav-tabs">
						<li class="nav-item"><a class="nav-link active">DETAIL PROFIL PEGAWAI</a></li>
					</ul>
					<!-- END profile-header-tab -->
				</div>
			</div>
			<!-- end profile -->
			<!-- begin profile-content -->
            <div class="profile-content">
            	<!-- begin tab-content -->
            	<div class="tab-content p-0">
						<!-- begin table -->
						<form method="POST" enctype="multipart/form-data">
						<div class="table-responsive">
							<table class="table table-profile">
								<thead>
									<tr>
										<th></th>
										<th>
											<h4><?=$val[Nama].', '.$val[Gelar]?> <small><?=$val[Username]?></small></h4>
										</th>
									</tr>
								</thead>
								<tbody>
									<tr class="highlight">
										<td class="field">NIP</td>
										<td><input type="number" class="form-control input-inline input-xs" name="nip" value="<?=$val[NIP]?>" /></td>
									</tr>
									<tr class="divider">
										<td colspan="2"></td>
									</tr>
									<tr>
										<td class="field">Nama Lengkap</td>
										<td><input type="text" class="form-control input-inline input-xs" name="namapegawai" value="<?=$val[Nama]?>" /></td>
									</tr>
									<tr>
										<td class="field">Tempat Lahir</td>
										<td><input type="text" class="form-control input-inline input-xs" name="tempatlhr" value="<?=$val[TempatLahir]?>" /></td>
									</tr>
									<tr>
										<td class="field">Tanggal Lahir</td>
										<td><input type="text" class="form-control input-inline input-xs" name="tgllhr" placeholder="mm/dd/yyyy" id="datepicker-autoClose" value="<?=date_format($tglhr, "m/d/Y")?>" /></td>
									</tr>
									<tr>
										<td class="field">Jenis Kelamin</td>
										<td><div class="form-group">
                                        <div class="form-check-inline">
                                          <input class="form-check-input" type="radio" name="jk" id="defaultInlineRadio1" value="L" <?php if($val[JenisKelamin] == 'L'){ echo 'checked=""';} ?>>
                                          <label class="form-check-label" for="defaultInlineRadio1">Laki-laki</label>
                                        </div>
                                        <div class="form-check-inline">
                                          <input class="form-check-input" type="radio" name="jk" id="defaultInlineRadio1" value="P" <?php if($val[JenisKelamin] == 'P'){ echo 'checked=""';} ?>>
                                          <label class="form-check-label" for="defaultInlineRadio1">Perempuan</label>
                                        </div>
                                    </div></td>
                                    <tr>
										<td class="field">Alamat</td>
										<td><textarea class="form-control input-inline input-xs" name="alamat" style="height: 40px;"><?=$val[Alamat]?></textarea></td>
									</tr>
									</tr>
									<tr class="divider">
										<td colspan="2"></td>
									</tr>
									<tr class="highlight">
										<td class="field">Status Kepegawaian</td>
										<td><span><?=$val[StatusKepeg]?></span></td>
									</tr>
									<tr class="divider">
										<td colspan="2"></td>
									</tr>
									<tr>
										<td class="field">Pendidikan Terakhir</td>
										<td>
											<select class="form-control input-inline input-xs" name="idpendidikan" required="required">
												<option value="">-Pilih Pendidikan Terakhir-</option>
                                              <?php
                                                $query2 = mysql_query("select IDPendidikan, NamaPendidikan from pendidikan where NA = 'N'");
                                                while ($vq2 = mysql_fetch_array($query2)) {
                                                  ?><option value="<?=$vq2[IDPendidikan]?>" <?php if ($val[IDPendidikan] == $vq2[IDPendidikan]) { echo 'selected="selected"'; } ?>><?=$vq2[IDPendidikan].' - '.$vq2[NamaPendidikan]?></option><?php
                                                }
                                              ?>
											</select>
										</td>
									</tr>
									<tr>
										<td class="field">Tahun Lulus</td>
										<td><input type="number" class="form-control input-inline input-xs" name="tahunlulus" value="<?=$val[TahunLulus]?>" /></td>
									</tr>
									<tr>
										<td class="field">Tahun Mulai Mengajar</td>
										<td><span><?=tgl_indo($val[TanggalBekerja])?></span></td>
									</tr>
									<tr>
										<td class="field">Mata Pelajaran Utama Yang Diampu</td>
										<td><span><?=$val[StatusKepeg]?></span></td>
									</tr>
									<tr class="highlight">
										<td class="field">Jabatan</td>
										<td><span><?=$val[NamaJabatan]?></span></td>
									</tr>
									<tr>
										<td class="field">Foto</td>
										<td><input type="file" class="form-control input-inline" name="foto" /></br>
										<small>*Maksimal besar size foto < 1 MB</small></td>
									</tr>
									<tr>
										<td class="field">Password</td>
										<td><input data-toggle="password" data-placement="after" class="input-inline form-control" type="password" minlength="5" name="password" placeholder="password" />
                                        <small>*Minimal panjang password 5 karakter</small></td>
									</tr>
									<tr class="divider">
										<td colspan="2"></td>
									</tr>
									<tr class="highlight">
										<td class="field">&nbsp;</td>
										<td class="p-t-10 p-b-10">
											<button type="submit" name="update" class="btn btn-primary width-150">Update</button>										</td>
									</tr>
								</tbody>
							</table>
						</div>
						</form>
						<!-- end table -->
				</div>
            	<!-- end tab-content -->
            </div>
			<!-- end profile-content -->

<?php
if (isset($_POST[update])) {
	$tgllhr = date_create("$_POST[tgllhr]");
    $htgllhr = date_format($tgllhr, "Y-m-d");

    $ekstensi_diperbolehkan = array('png','jpg','jpeg','JPG','PNG','JPEG');
    $foto = $_FILES['foto']['name'];
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['foto']['size'];
    $fotobaru = $val[Username].".".$ekstensi;

    if (empty($foto)) {
      $vfoto = ", '',";
    }else{
      $vfoto = ", '$fotobaru',";
    }
	    if (empty($_POST[password])) {
            $pas = "";
          }elseif (empty($foto)) {
            $fotho = "";
          }else{
            $pas = ", Password = md5('$_POST[password]')";
            $fotho = ", Foto = '$fotobaru'";
          }

          $update = "update pegawai set Nama = '$_POST[namapegawai]', NIP = '$_POST[nip]', JenisKelamin = '$_POST[jk]', TempatLahir = '$_POST[tempatlhr]', TanggalLahir = '$htgllhr', Alamat = '$_POST[alamat]', IDPendidikan = '$_POST[idpendidikan]', TahunLulus = '$_POST[tahunlulus]' $fotho $pas where IDPegawai = '$_SESSION[id]'";
          
            if (empty($foto)) {
                mysql_query("$update");
                echo '<meta http-equiv="refresh" content="0;url=?act=profil&full=content-full-width">';
            }else{
                if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                  if ($ukuran < 1000000) {
                    mysql_query("$update");
                    move_uploaded_file($_FILES['foto']['tmp_name'], "assets/img/user/".$fotobaru);
                    echo '<meta http-equiv="refresh" content="0;url=?act=profil&full=content-full-width">';
                  }else{
                    echo '<script type="text/javascript">alert("Ukuran file terlalu besar...")
                            document.location ="?act=profil&full=content-full-width";
                          </script>';
                  }
                }else{
                  echo '<script type="text/javascript">alert("Ekstensi file yang diupload tidak diperbolehkan...")
                            document.location ="?act=profil&full=content-full-width";
                          </script>';
                }
            }
}
?>