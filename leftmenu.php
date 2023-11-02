<?php
   	switch ($_GET[actv]) {
      	case 'd':
	        $d = 'active';
	        break;
	    case 'mp':
	        $mp = 'active';
	        break;
	    case 'pr':
	        $pr = 'active';
	        break;
	    case 'pb':
	        $pb = 'active';
	        break;
	    case 'pk':
	        $pk = 'active';
	        break;
	    case 'dp':
	        $dp = 'active';
	        break;
	    case 'mpe':
	        $mpe = 'active';
	        break;
	    case 'mu':
	        $mu = 'active';
	        break;
	    case 'mjp':
	        $mjp = 'active';
	        break;
	    case 'mk':
	        $k = 'active';
	        $mk = 'active';
	        break;
	    case 'mks':
	        $k = 'active';
	        $mks = 'active';
	        break;
	    case 'mjb':
	        $mjb = 'active';
	        break;
	    case 'mjk':
	    	$k = 'active';
	        $mjk = 'active';
	        break;
	    case 'mkk':
	    	$k = 'active';
	        $mkk = 'active';
	        break;
	    case 'lp':
	    	$lp = 'active';
	    	$le = 'active';
	        break;
	    case 'lrp':
	    	$lrp = 'active';
	    	$le = 'active';
	        break;
	    case 'lb':
	    	$lb = 'active';
	    	$le = 'active';
	        break;
	    case 'lin':
	    	$li = 'active';
	    	$lin = 'active';
	        break;
	    case 'gbj':
	    	$li = 'active';
	    	$gbj = 'active';
	        break;
	    case 'ltp':
	    	$li = 'active';
	    	$ltp = 'active';
	        break;
	    case 'lir':
	    	$le = 'active';
	    	$lir = 'active';
	        break;
	    case 'kri':
	    	$le = 'active';
	    	$kri = 'active';
	        break;
	    case 'msp':
	    	$msp = 'active';
	        break;
	    case 'mus':
	    	$mus = 'active';
	        break;
      	default:
         	$d = 'active';
         	break;
   }
?>
		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<a href="javascript:;" data-toggle="nav-profile">
							<div class="cover with-shadow"></div>
							<div class="image">
								<img src="assets/img/user/user.png" alt="" />
							</div>
							<div class="info">
								<?=$val[Nama]?>
								<small><?=$val[Username].' - '.$val[NamaLevel]?></small>
							</div>
						</a>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header">Transaksi Pelayanan</li>
					<li class="has-sub <?=$d?>">
						<a href="?act=#&actv=d">
						    <i class="fa fa-th-large"></i>
						    <span>Dashboard</span>
					    </a>
					</li>
					<?php
					if ($_SESSION[level] == 1 or $_SESSION[level] == 2) {
					?>
					<li class="has-sub <?=$pr?>">
						<a href="?actt=pasien_ruang&actv=pr">
						    <i class="fa fa-clipboard"></i>
						    <span>Pasien Masuk</span>
					    </a>
					</li>
					<li class="has-sub <?=$pb?>">
						<a href="?actt=pindah_ruang&actv=pb">
						    <i class="fa fa-clipboard"></i>
						    <span>Pasien Pindah</span>
					    </a>
					</li>
					<li class="has-sub <?=$pk?>">
						<a href="?actt=pasien_keluar&actv=pk">
						    <i class="fa fa-clipboard"></i>
						    <span>Pasien Keluar</span>
					    </a>
					</li>
					
					<li class="has-sub <?=$dp?>">
						<a href="?actt=diagnosa_pasien&actv=dp">
						    <i class="fa fa-clipboard"></i>
						    <span>Diagnosa Pasien</span>
					    </a>
					</li>
					<?php } 
					if ($_SESSION[level] == 1 or $_SESSION[level] == 3 or $_SESSION[level] == 4){
					?>
					<li class="nav-header">Laporan</li>
					<li class="<?=$lin?>">
								<a href="?actl=laporan_indikator_pri&actv=lin">
								    <span>Laporan Rawat Inap</span>
							    </a>
							</li>
					<li class="<?=$kri?>">
								<a href="?actl=laporan_kegiatan_pri&actv=kri">
								    <span>Laporan Rekapitulasi SHRI</span>
							    </a>
							</li>
							<li class="<?=$gbj?>">
								<a href="?actl=grafik_barber_johnson&actv=gbj">
								    <span>Grafik Barber Johson</span>
							    </a>
							</li>
					<!-- <li class="has-sub <?=$li?>">
					    <a href="javascript:;">
					        <span class="pull-right"><i class="fa fa-caret-down"></i></span>
					        <i class="fa fa-leanpub"></i>
						    <span>Laporan Internal</span>
						</a>
						<ul class="sub-menu">
						    <li class="<?=$lin?>">
								<a href="?actl=laporan_indikator_pri&actv=lin">
								    <span>Laporan Indikator Pelayanan Rawat Inap</span>
							    </a>
							</li>
							<li class="<?=$gbj?>">
								<a href="?actl=grafik_barber_johnson&actv=gbj">
								    <span>Grafik Barber Johnson</span>
							    </a>
							</li>
							<li class="<?=$ltp?>">
								<a href="?actl=laporan_tt&actv=ltp">
								    <span>Laporan Tempat Tidur</span>
							    </a>
							</li>
						</ul>
					</li> -->
					<?php } if ($_SESSION[level] == 1) {
					?>
					<!-- <li class="has-sub <?=$le?>">
					    <a href="javascript:;">
					        <span class="pull-right"><i class="fa fa-caret-down"></i></span>
					        <i class="fa fa-leanpub"></i>
						    <span>Laporan Eksternal</span>
						</a>
						<ul class="sub-menu">
							<li class="<?=$lir?>">
								<a href="?actl=laporan_indikator_prs&actv=lir">
								    <span>Laporan Indikator Pelayanan Rumah Sakit</span>
							    </a>
							</li>
						    <li class="<?=$lp?>">
								<a href="?actl=laporan_penyakit&actv=lp">
								    <span>Laporan 10 Besar Penyakit</span>
							    </a>
							</li>
							<li class="<?=$lrp?>">
								<a href="?actl=laporan_riwayat_penyakit&actv=lrp">
								    <span>Laporan Riwayat Penyakit</span>
							    </a>
							</li>
							<li class="<?=$kri?>">
								<a href="?actl=laporan_kegiatan_pri&actv=kri">
								    <span>Laporan Kegiatan Pelayanan Rawat Inap</span>
							    </a>
							</li>
							<li class="<?=$lb?>">
								<a href="?actl=laporan_bangsal&actv=lb">
								    <span>Laporan Fasilitas Tempat Tidur</span>
							    </a>
							</li>
						</ul>
					</li> -->
					<?php }if ($_SESSION[level] == 1 or $_SESSION[level] == 3) { ?>
					<li class="nav-header">Data Master</li>
					<li class="has-sub <?=$mp?>">
						<a href="?actm=mpasien&actv=mp">
						    <i class="fa fa-qrcode"></i>
						    <span>Data Pasien</span>
					    </a>
					</li>
					<li class="has-sub <?=$mpe?>">
						<a href="?actm=mpenyakit&actv=mpe">
						    <i class="fa fa-cogs"></i>
						    <span>Data Diagnosa</span>
					    </a>
					</li>
					<li class="has-sub <?=$k?>">
					    <a href="javascript:;">
					        <span class="pull-right"><i class="fa fa-caret-down"></i></span>
					        <i class="fa fa-leanpub"></i>
						    <span>Data Bangsal</span>
						</a>
						<ul class="sub-menu">
						    <li class="<?=$mk?>"><a href="?actm=mkamar&actv=mk">Bangsal</a></li>
						    <li class="<?=$mks?>"><a href="?actm=mkelas&actv=mks">Kelas</a></li>
						    <li class="<?=$mkk?>"><a href="?actm=mkamar_kelas&actv=mkk">Bangsal Kelas</a></li>
						</ul>
					</li>
					<!-- <li class="has-sub <?=$mjp?>">
						<a href="?actm=mjenis_pelayanan&actv=mjp">
						    <i class="fa fa-cogs"></i>
						    <span>Data Jenis Pelayanan</span>
					    </a>
					</li>
					<li class="has-sub <?=$mjb?>">
						<a href="?actm=mjenis_pembayaran&actv=mjb">
						    <i class="fa fa-cogs"></i>
						    <span>Data Jenis Pembayaran</span>
					    </a>
					</li> -->
					<?php } if($_SESSION[level] == 1) {
					?>
					<li class="has-sub <?=$mu?>">
						<a href="?actm=mpetugas&actv=mu">
						    <i class="fa fa-cogs"></i>
						    <span>Data User</span>
					    </a>
					</li>
					<?php } ?>
					<!-- <li class="has-sub <?=$msp?>">
						<a href="?actm=mspesialis&actv=msp">
						    <i class="fa fa-cogs"></i>
						    <span>Data Spesialis</span>
					    </a>
					</li>
					<li class="has-sub <?=$mus?>">
						<a href="?actm=muser&actv=mus">
						    <i class="fa fa-cogs"></i>
						    <span>Data User</span>
					    </a>
					</li> -->

			        <!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->