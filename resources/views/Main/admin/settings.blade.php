@extends('Main/admin/layout')
@section('page_title', 'Profile Settings')
@section('users_select', 'active')
@section('container')

<div class="row">
<div class="col-xl-12 mx-auto">
	
	<div class="card border-top border-0 border-4 border-primary">

	<div class="card-body p-5">
		
		<div class="card-title d-flex align-items-center">
			<div><i class="bx bxs-user me-1 font-22 text-primary"></i>
			</div>
			<h5 class="mb-0 text-primary">Profile Settings</h5>
		</div>
		<hr>
		<form class="row g-3"  action="{{route('user.updateprofile')}}" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" value="{{$profile[0]->id}}">
			@csrf
			<div class="col-md-6">
				<label for="inputFirstName" class="form-label">First Name <span style="color: red">*</span></label>
				<input type="text" class="form-control" name="name" value="{{$profile[0]->name}}">

				@error('name')
                    <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                @enderror
			</div>

			<div class="col-md-6">
				<label for="inputLastName" class="form-label">Last Name</label>
				<input type="text" class="form-control" name="lname" value="{{$profile[0]->lname}}">
			</div>
			
			<div class="col-md-6">
				<label for="inputEmail" class="form-label">Mobile <span style="color: red">*</span></label>
				<input type="number" class="form-control" name="mobile" value="{{$profile[0]->mobile}}">

				@error('mobile')
                    <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                @enderror
			</div>
			
			<div class="col-md-6">
				<label for="inputPassword" class="form-label">Profile</label>
				<input type="file" class="form-control" name="profiles">
			</div>
			<div class="col-md-6">
				<label for="inputCity" class="form-label">State <span style="color: red">*</span></label>
				<input type="text" class="form-control" name="State" value="{{$profile[0]->State}}">
				@error('State')
                    <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                @enderror
			</div>
			<div class="col-md-6">
				<label for="inputCity" class="form-label">City <span style="color: red">*</span></label>
				<input type="text" class="form-control" name="city" value="{{$profile[0]->city}}">

				@error('city')
                    <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                @enderror
			</div>
			<div class="col-md-6">
				<label for="inputZip" class="form-label">Pincode</label>
				<input type="text" class="form-control" name="pinocde" value="{{$profile[0]->pinocde}}">
			</div>
			
			<div class="col-12">
				<label for="inputAddress" class="form-label">Address <span style="color: red">*</span></label>
				<textarea class="form-control" name="address" placeholder="Address..." rows="3">{{$profile[0]->address}}</textarea>

				@error('address')
                    <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                @enderror
			</div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary px-5">Update Profile</button>
			</div>
		</form>
	</div>
</div>


@endsection