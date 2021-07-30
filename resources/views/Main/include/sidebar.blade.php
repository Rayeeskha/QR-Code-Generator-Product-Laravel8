<!--wrapper-->
<div class="wrapper">
<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
	<div class="sidebar-header">
		<div>
			<img src="{{asset('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
		</div>
		<div>
			<h4 class="logo-text">Khan</h4>
		</div>
		<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
		</div>
	</div>
	<!--navigation-->
	<ul class="metismenu" id="menu">
		<li>
			<a href="{{url('admin/dashboard')}}">
				<div class="parent-icon"><i class='bx bx-home-circle'></i>
				</div>
				<div class="menu-title">Dashboard</div>
			</a>
		</li>
		
		<li>
			<a href="javascript:;" class="has-arrow">
				<div class="parent-icon"><i class='bx bx-user-circle'></i>
				</div>
				<div class="@yield('users_select') menu-title">Users</div>
			</a>
			<ul>
				<li> <a href="{{url('admin/addusers')}}"><i class="bx bx-right-arrow-alt"></i>Add Users</a>
				</li>
				<li> <a href="{{url('admin/manageusers')}}"><i class="bx bx-right-arrow-alt"></i>Manage Users</a>
				</li>
				
			</ul>
		</li>
		
		<li>
			<a class="has-arrow" href="javascript:;">
				<div class="parent-icon"><i class="bx bx-grid-alt"></i>
				</div>
				<div class="@yield('qr_select') menu-title">QR Codes</div>
			</a>
			<ul>
				<li> <a href="{{url('admin/managesize')}}"><i class="bx bx-right-arrow-alt"></i>Manage Size</a>
				</li>
				<li> <a href="{{url('admin/managecolor')}}"><i class="bx bx-right-arrow-alt"></i>Manage Color</a>
				</li>
				<li> <a href="{{url('admin/addqrcodes')}}"><i class="bx bx-right-arrow-alt"></i>Add QR Codes</a>
				</li>

				<li> <a href="{{url('admin/manageqrcodes')}}"><i class="bx bx-right-arrow-alt"></i>Manage QR Codes</a>
				</li>
			</ul>
		</li>
		
	</ul>
	<!--end navigation-->
</div>
<!--end sidebar wrapper -->