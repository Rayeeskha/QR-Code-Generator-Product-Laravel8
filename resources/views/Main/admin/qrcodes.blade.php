@extends('Main/admin/layout')
@section('page_title', 'Add Qr Codes')
@section('qr_select', 'active')
@section('container')

<div class="row">
<div class="col-xl-12 mx-auto">
	
	<div class="card border-top border-0 border-4 border-primary">
	<div class="card-body p-5">
		<div class="card-title d-flex align-items-center">
			<div><i class="bx bxs-user me-1 font-22 text-primary"></i>
			</div>
			<h5 class="mb-0 text-primary">Add QR Codes</h5>
		</div>
		<hr>
		<form class="row g-3"  action="{{route('user.uploadqrcodes')}}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="col-md-6">
				<label for="inputFirstName" class="form-label">Name</label>
				<input type="text" class="form-control" name="name">

				@error('name')
                    <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                @enderror
			</div>
			<div class="col-md-6">
				<label for="inputLastName" class="form-label">Link</label>
				<input type="link" class="form-control" name="link" placeholder="https://google.com">

				@error('link')
                    <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                @enderror
			</div>
			<div class="col-md-6">
				<label for="inputEmail" class="form-label">Size</label>
				<select name="size" class="single-select">
					<option value="" selected="" disabled="">Select Size</option>
					@foreach($sizes as $size)
					<option value="{{$size->id}}">{{$size->size}}</option>
					@endforeach
				</select>

				@error('size')
                    <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                @enderror

			</div>
			<div class="col-md-6">
				<label for="inputPassword" class="form-label">Color</label>
				<select name="color" class="single-select">
					<option value="" selected="" disabled="">Select Size</option>
					@foreach($colors as $col)
					<option value="{{$col->id}}">{{$col->color}}</option>
					@endforeach
				</select>
				@error('color')
                    <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                @enderror
			</div>
			<div class="col-12">
			<?php if(session()->get('USER_ROLE') == 1): ?>
				<button type="submit" class="btn btn-primary px-5">Add Qr Codes</button>
			<?php else: ?>
				<?php $userInfo =  Helper::get_user(session()->get('USER_ID'));
						$totaluserqrcode = Helper::get_totaluserqrcode(session()->get('USER_ID'));
				?>
				@if(isset($userInfo[0]) || isset($totaluserqrcode[0]))
				@if($userInfo[0]->total_qr > $totaluserqrcode[0]->total_qrcode)
				<button type="submit" class="btn btn-primary px-5">Add Qr Codes</button>
				@else
				<h6 style="color: red">Total QR Code Limit Completed</h6>
				@endif
				@endif
			<?php endif; ?>
			</div>
		</form>
	</div>
</div>





@endsection