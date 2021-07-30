@include('Main/include/css_file')

<body class="bg-login">
	<!--wrapper-->
<div class="wrapper">
<div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
	<div class="container">
		<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
			<div class="col mx-auto">
				<div class="my-4 text-center">
					<img src="assets/images/logo-img.png" width="180" alt="" />
				</div>
				<div class="card">
					<div class="card-body">
						<div class="border p-4 rounded">
							<div class="text-center">
								<h3 class="">Sign Up</h3>
							</div>
							
							</div>
						<div class="form-body">
						<form class="row g-3"  action="{{route('user.registeraccount')}}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="col-md-6">
							<label for="inputFirstName" class="form-label">First Name <span style="color: red">*</span></label>
							<input type="text" class="form-control" name="name">

							@error('name')
			                    <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
			                @enderror
						</div>

						<div class="col-md-6">
							<label for="inputLastName" class="form-label">Last Name</label>
							<input type="text" class="form-control" name="lname">
						</div>
						<div class="col-md-6">
							<label for="inputEmail" class="form-label">Email <span style="color: red">*</span></label>
							<input type="email" class="form-control" name="email">

							@error('email')
			                    <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
			                @enderror
						</div>
						<div class="col-md-6">
							<label for="inputEmail" class="form-label">Mobile <span style="color: red">*</span></label>
							<input type="number" class="form-control" name="mobile">

							@error('mobile')
			                    <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
			                @enderror
						</div>
						
						<div class="col-md-6">
							<label for="inputPassword" class="form-label">Password <span style="color: red">*</span></label>
							<input type="password" class="form-control" name="password">
							@error('password')
			                    <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
			                @enderror
						</div>
						<div class="col-md-6">
							<label for="inputPassword" class="form-label">Profile</label>
							<input type="file" class="form-control" name="profiles">
						</div>
						<div class="col-md-4">
							<label for="inputCity" class="form-label">State <span style="color: red">*</span></label>
							<input type="text" class="form-control" name="State">
							@error('State')
			                    <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
			                @enderror
						</div>
						<div class="col-md-4">
							<label for="inputCity" class="form-label">City <span style="color: red">*</span></label>
							<input type="text" class="form-control" name="city">

							@error('city')
			                    <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
			                @enderror
						</div>
						<div class="col-md-4">
							<label for="inputZip" class="form-label">Pincode</label>
							<input type="text" class="form-control" name="pinocde">
						</div>
						
						<div class="col-12">
							<label for="inputAddress" class="form-label">Address <span style="color: red">*</span></label>
							<textarea class="form-control" name="address" placeholder="Address..." rows="3"></textarea>

							@error('address')
			                    <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
			                @enderror
						</div>
						<div class="col-12">
							<button type="submit" class="btn btn-primary px-5">Add Users</button>
						</div>
					</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end row-->
	</div>
</div>
</div>
<!--end wrapper-->


@include('Main/include/js_file')