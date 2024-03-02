<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
			</li>
			
		</ul>
	</nav>


	<!-- Main Sidebar Container -->
	<aside class="main-sidebar sidebar-dark-primary elevation-4">
	
		<!-- Sidebar -->
		<div class="sidebar">
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
				<li class="nav-item">
					<a href="/penjualan" class="nav-link <?= $_SERVER['REQUEST_URI'] == '/' ? 'active' : '' ?>">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>Penjualan</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="/subjects" class="nav-link <?= $_SERVER['REQUEST_URI'] == '/barang' ? 'active' : '' ?>">
						<i class="nav-icon fas fa-book"></i>
						<p>Master Barang</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->
	</aside>