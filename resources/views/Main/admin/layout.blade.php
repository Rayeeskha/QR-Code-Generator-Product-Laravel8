@include('Main/include/css_file')
@include('Main/include/sidebar')
@include('Main/include/navbar')
<!--start page wrapper -->
	<div class="page-wrapper">
		<div class="page-content">
			<!-- Dashboard wrapper section  -->
			@if(Session::has('success'))
			<div class="alert border-0 border-start border-5 border-success alert-dismissible fade show py-2">
				<div class="d-flex align-items-center">
					<div class="font-35 text-success"><i class='bx bxs-check-circle'></i>
					</div>
					<div class="ms-3">
						<h6 class="mb-0 text-success">Success</h6>
						<div>{{session('success')}}</div>
					</div>
				</div>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			@endif
			@if(Session::has('error'))
			<div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
				<div class="d-flex align-items-center">
					<div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
					</div>
					<div class="ms-3">
						<h6 class="mb-0 text-white">Error</h6>
						<div class="text-white">{{session('error')}}</div>
					</div>
				</div>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			@endif


			@section('container')

			
			
 			@show 

 		<!-- Dashboard wrapper section  -->
		</div>
	</div>
<!--End Back To Top Button-->
<footer class="page-footer">
	<p class="mb-0">Copyright © 2021. All right reserved. by Khan Rayees</p>
</footer>
@include('Main/include/js_file')