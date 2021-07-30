<header>
	<div class="topbar d-flex align-items-center">
		<nav class="navbar navbar-expand">
			<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
			</div>
			<div class="search-bar flex-grow-1"></div>
			<div class="top-menu ms-auto">
				<ul class="navbar-nav align-items-center">
					<li class="nav-item dropdown dropdown-large">
						<div class="dropdown-menu dropdown-menu-end">
							<div class="header-notifications-list"></div>
						</div>
					</li>
					<li class="nav-item dropdown dropdown-large">
						<div class="dropdown-menu dropdown-menu-end">
							<div class="header-message-list"> </div>
						</div>
					</li>
				</ul>
			</div>
			<div class="user-box dropdown">
				<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					@if(session()->get('USER_PROFILE') !== 0)
					<img src="{{asset('storage/users/'.session()->get('USER_PROFILE'))}}" class="user-img" alt="user avatar">
					
					@endif
					<div class="user-info ps-3">
						<p class="user-name mb-0">{{session()->get('USER_NAME')}}</p>
						<p class="designattion mb-0">Khan Software Team</p>
					</div>
				</a>
				<ul class="dropdown-menu dropdown-menu-end">
					<li><a class="dropdown-item" href="{{url('profile/settings')}}"><i class="bx bx-user"></i><span>Profile</span></a>
					</li>
					<li><a class="dropdown-item" href="{{url('profile/changepassword')}}"><i class="bx bx-cog"></i><span>Change Password</span></a>
					</li>
					<li>
						<div class="dropdown-divider mb-0"></div>
					</li>
					<li><a class="dropdown-item" href="logout"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</header>