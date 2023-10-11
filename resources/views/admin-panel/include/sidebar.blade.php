<!-- Sidebar Start -->
<aside class="left-sidebar">
	<!-- Sidebar scroll-->
	<div>
		<div class="brand-logo d-flex align-items-center justify-content-between">
			<a href="index.html" class="text-nowrap logo-img">
				<img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/dark-logo.svg"
					class="dark-logo" width="180" alt="" />
				<img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/light-logo.svg"
					class="light-logo" width="180" alt="" />
			</a>
			<div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
				<i class="ti ti-x fs-8 text-muted"></i>
			</div>
		</div>
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav scroll-sidebar" data-simplebar>
			<ul id="sidebarnav">
				<!-- ============================= -->
				<!-- Home -->
				<!-- ============================= -->
				<li class="nav-small-cap">
					<i class="ti ti-dots nav-small-cap-icon fs-4"></i>
					<span class="hide-menu">Home</span>
				</li>
				<!-- =================== -->
				<!-- Dashboard -->
				<!-- =================== -->
				<li class="sidebar-item {{ Route::is('admin-panel.dashboard') ? 'selected' : '' }}">
 					<a class="sidebar-link" href="{{ route('admin-panel.dashboard') }}" aria-expanded="false">
						<span>
							<i class="ti ti-dashboard"></i>
						</span>
						<span class="hide-menu">Dashboard</span>
					</a>
				</li>
				<li class="sidebar-item {{ Route::is('admin-panel.user.*') ? 'selected' : '' }}">
					<a class="sidebar-link" href="{{ route('admin-panel.user.index') }}" aria-expanded="false">
					   <span>
							<i class="ti ti-users"></i>
					   </span>
					   <span class="hide-menu">User</span>
				   </a>
			   </li>
			   <li class="sidebar-item {{ Route::is('admin-panel.criteria.*') ? 'selected' : '' }}">
					<a class="sidebar-link" href="{{ route('admin-panel.criteria.index') }}" aria-expanded="false">
						<span>
							<i class="ti ti-category-filled"></i>
						</span>
						<span class="hide-menu">Kriteria</span>
					</a>
				</li>
				<li class="sidebar-item {{ Route::is('admin-panel.criminal.*') ? 'selected' : '' }}">
					<a class="sidebar-link" href="{{ route('admin-panel.criminal.index') }}" aria-expanded="false">
						<span>
							<i class="ti ti-user-x"></i>
						</span>
						<span class="hide-menu">PTP</span>
					</a>
				</li>
				<li class="sidebar-item {{ Route::is('admin-panel.evidence.*') ? 'selected' : '' }}">
					<a class="sidebar-link" href="{{ route('admin-panel.evidence.index') }}" aria-expanded="false">
						<span>
							<i class="ti ti-archive-filled"></i>
						</span>
						<span class="hide-menu">Barang Bukti</span>
					</a>
				</li>
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
