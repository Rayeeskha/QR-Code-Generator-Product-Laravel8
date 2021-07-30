@extends('Main/admin/layout')
@section('page_title', 'Manage Users')
@section('users_select', 'active')
@section('container')

<div class="card">
	<div class="card-body">
		<h6 class="mb-0 text-uppercase">Manage Users</h6>
	<hr/>
		<div class="table-responsive">
			<table id="example2" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Mobile</th>
						<th>Password</th>
						<th>Total QR Codes</th>
						<th>Total QR Hits</th>
						<th>Profile</th>
						<th>State</th>
						<th>City</th>
						<th>Pincode</th>
						<th>Address</th>
						<th>Added  By</th>
						<th>Status</th>
						<th>Added date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@if($users)
						@foreach($users as $list)
							<?php 
								$total_qr_code =  Helper::get_totaluserqrcode($list->id);
								$total_qr_hits=  Helper::get_user_qr_total_hits($list->id);
								if (isset($total_qr_code[0]) || isset($total_qr_hits[0])) {
									$total_qr_code_limit = $total_qr_code[0]->total_qrcode;
									$total_qr_hits_limit =  $total_qr_hits[0]->total_qr_hits;
								}else{
									$total_qr_code_limit = 0;
									$total_qr_hits_limit = 0;
								}
							 ?>
							<tr>
								<td>{{$list->name}}&nbsp;{{$list->lname}}</td>
								<td><a href="mailto:{{$list->email}}">{{$list->email}}</a></td>
								<td><a href="tel:{{$list->mobile}}">{{$list->mobile}}</a></td>
								<td>{{$list->dummypass}}</td>
								<td>{{$total_qr_code_limit}} /{{$list->total_qr}} </td>
								<td>{{$total_qr_hits_limit}}/{{$list->total_hits}}</td>
								<td>
									@if($list->profiles !== '')
									<img src="{{asset('storage/users/'.$list->profiles)}}" style="width: 100px;border-radius: 3%;margin-top: 10px;height: 50px" alet="profile">
			                        @endif
			                    </td>
			                    <td>{{$list->State}}</td>
			                    <td>{{$list->city}}</td>
			                    <td>{{$list->pinocde}}</td>
			                    <td>{{$list->address}}</td>
			                    <td>{{$list->added_by}}</td>
			                    <td>
			                    	@if($list->status == "Active")
			                    	<a href="{{url('admin/user/changeuserstatus/')}}/{{$list->id}}/Deactive"><span class="badge badge-primary" style="background: blue;color: white">{{$list->status}}</span></a>
			                    	@else
			                    	<a href="{{url('admin/user/changeuserstatus/')}}/{{$list->id}}/Active"><span class="badge badge-danger" style="background: red">{{$list->status}}</</span></a>
			                    	@endif
			                    	
			                    </td>
			                    <td>{{$list->created_at}}</td>
			                    <td>
			                    	<a href="{{url('admin/user/editusers/')}}/{{$list->id}}" class="fa fa-edit">
									<a onclick="return confirm('Are you sure you want to delete  ?')"  href="{{url('admin/user/deleteuser/')}}/{{$list->id}}" class="fa fa-trash" style="padding: 15px;color: red">
			                    	</a>
			                    </td>
							</tr>
						@endforeach
					@else
						<h6 style="color: red">Records not found</h6>
					@endif
				</tbody>
				
			</table>
		</div>
	</div>
</div>
</div>
</div>


@endsection