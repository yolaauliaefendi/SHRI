<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
		<!-- begin #header -->
		<div id="header" class="header navbar-inverse">
			<!-- begin navbar-header -->
			<div class="navbar-header">
				<a href="?" class="navbar-brand"><img src="assets/img/logo/logo5.jpg"> <strong style="font-weight: bold;color: #1f2225;font-size: 12px;">RSIA MUTIARA BUNDA PADANG</strong></a>
				<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<ul class="navbar-nav">
				<li class="navbar-user">
					<a class="dropdown-toggle">
						<span class="d-md-inline">Sensus Harian Rawat Inap</span>
					</a>
				</li>
			</ul>
			<ul class="navbar-nav navbar-right">
				<li class="dropdown navbar-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<img src="assets/img/user/user.png" alt="" /> 
						<span class="d-none d-md-inline"><?=$val[Nama]?></span> <b class="caret"></b>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<!-- <a href="?act=profil&full=content-full-width" class="dropdown-item">Profil</a> -->
						<!-- <div class="dropdown-divider"></div> -->
						<a href="?act=logout" class="dropdown-item">Log Out</a>
					</div>
				</li>
			</ul>
			<!-- end header navigation right -->
		</div>
		<!-- end #header -->