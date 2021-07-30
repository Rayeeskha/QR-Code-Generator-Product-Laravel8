@extends('Main/admin/layout')
@section('page_title', 'Edit Qr Codes')
@section('qr_select', 'active')
@section('container')

<div class="row">
<div class="col-xl-12 mx-auto">
	
	<div class="card border-top border-0 border-4 border-primary">
	<div class="card-body p-5">
		<div class="card-title d-flex align-items-center">
			<div><i class="bx bxs-user me-1 font-22 text-primary"></i>
			</div>
			<h5 class="mb-0 text-primary">Edit QR Codes</h5>
		</div>
		<hr>
		<form class="row g-3"  action="{{route('user.updateqrcodes')}}" method="post" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="id" value="{{$qrcodes[0]->id}}">
			<div class="col-md-6">
				<label for="inputFirstName" class="form-label">Name</label>
				<input type="text" class="form-control" name="name" value="{{$qrcodes[0]->name}}">

				@error('name')
                    <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                @enderror
			</div>
			<div class="col-md-6">
				<label for="inputLastName" class="form-label">Link</label>
				<input type="link" class="form-control" name="link" placeholder="https://google.com" value="{{$qrcodes[0]->link}}">

				@error('link')
                    <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                @enderror
			</div>
			<div class="col-md-6">
				<label for="inputEmail" class="form-label">Size</label>
				<select name="size" class="single-select">
					<option value="" selected="" disabled="">Select Size</option>
					@foreach($sizes as $size)
					@if($qrcodes[0]->size == $size->id)
					<option value="{{$size->id}}" selected="">{{$size->size}}</option>
					@else
					<option value="{{$size->id}}">{{$size->size}}</option>
					@endif
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
						@if($qrcodes[0]->color == $col->id)
						<option value="{{$col->id}}" selected="">{{$col->color}}</option>
						@else
						<option value="{{$col->id}}">{{$col->color}}</option>
						@endif
					@endforeach
				</select>
				@error('color')
                    <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                @enderror
			</div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary px-5">Update Qr Codes</button>
			</div>
		</form>
	</div>
</div>





@endsection