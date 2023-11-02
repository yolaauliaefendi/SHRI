			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item active">Dashboard</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Dashboard</h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
				<!-- begin col-3 -->
				<div class="col-lg-3 col-md-6">
					<div class="widget widget-stats bg-red">
						<div class="stats-icon"><i class="fa fa-check-circle"></i></div>
						<div class="stats-info">
							<h4>TOTAL PASIEN MASUK</h4>
							<p><?php 
							$count = mysql_num_rows(mysql_query("Select * from tblriwayat where TglKeluar = '0000-00-00 00:00:00'"));
							echo $count." Pasien";
							 ?></p>	
						</div>
						<div class="stats-link">
							<a>&nbsp;<i class="fa fa-arrow-alt-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-lg-3 col-md-6">
					<div class="widget widget-stats bg-orange">
						<div class="stats-icon"><i class="fa fa-times-circle"></i></div>
						<div class="stats-info">
							<h4>TOTAL PASIEN KELUAR</h4>
							<p><?php 
							$count = mysql_num_rows(mysql_query("Select * from tblriwayat where TglKeluar != '0000-00-00 00:00:00'"));
							echo $count." Pasien";
							 ?></p>	
						</div>
						<div class="stats-link">
							<a>&nbsp;<i class="fa fa-arrow-alt-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-lg-3 col-md-6">
					<div class="widget widget-stats bg-grey-darker">
						<div class="stats-icon"><i class="fa fa-users"></i></div>
						<div class="stats-info">
							<h4>TOTAL PETUGAS</h4>
							<p><?php 
							$count = mysql_num_rows(mysql_query("select a.IDPetugas, a.NIP, a.Nama, a.JenisKelamin, a.Alamat, a.Agama, a.Kewarganegaraan, a.Telp, a.IDLevel, a.NA, b.NamaLevel, c.Username, c.IDUser from tblpetugas a inner join tbllevel b on a.IDLevel = b.IDLevel INNER JOIN tbluser c on a.IDPetugas = c.IDPetugas where a.NA = 'N'"));
							echo $count." Petugas";
							 ?></p>	
						</div>
						<div class="stats-link">
							<a>&nbsp;<i class="fa fa-arrow-alt-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-lg-3 col-md-6">
					<div class="widget widget-stats bg-black-lighter">
						<div class="stats-icon"><i class="fa fa-clock"></i></div>
						<div class="stats-info">
							<h4>WAKTU</h4>
							<p><?php print date('H:i:s'); ?></p>

						</div>
						<div class="stats-link">
							<a>&nbsp;<i class="fa fa-arrow-alt-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
			</div>
			<!-- end row -->
			<!-- begin row -->
			
					
				</div>
			</div>
			<!-- end row -->



