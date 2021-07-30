@extends('Main/admin/layout')
@section('page_title', 'Manage QR Codes')
@section('users_select', 'active')
@section('container')

<div class="card">
	<div class="card-body">
		<h6 class="mb-0 text-uppercase">Manage QR Codes</h6>
	<hr/>
		<div class="table-responsive">
			<table id="example2" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>QR Code</th>
						<th>Link</th>
						<th>Color</th>
						<th>Size</th>
						<th>Added by</th>
						<th>Status</th>
						<th>Created date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@if($qrcodes)
						@foreach($qrcodes as $list)
						<?php  $size  =  Helper::get_sizes($list->size); ?>
						<?php  $color =  Helper::get_color($list->color); ?>
						<?php  $user  =  Helper::get_user($list->added_by); ?>
							<tr>
								<td>{{$list->name}}</td>
								<td>
									<a href="https://chart.apis.google.com/chart?cht=qr&chs={{$size[0]->size}}&chco={{$color[0]->color}}&chl={{url('qr/qrtraffic')}}/{{$list->id}}" target="_blank">

									<!--  <img src="https://chart.apis.google.com/chart?cht=qr&chs={{$size[0]->size}}&chl={{$list->link}}&chco={{$color[0]->color}}" width="100"> --> 

									 <img src="https://chart.apis.google.com/chart?cht=qr&chs={{$size[0]->size}}&chco={{$color[0]->color}}&chl={{url('qr/qrtraffic')}}/{{$list->id}}" width="100"> 

									</a>
								</td>
								<td><a href="{{$list->link}}" target="_blank">{{$list->link}}</a>
								</td>
								<td>{{$color[0]->color}}
									<span style="background-color: #{{$color[0]->color}}">&nbsp;&nbsp;&nbsp;</span>
								</td>
								<td>{{$size[0]->size}}</td>
								<td>{{$user[0]->name}}</td>
								
			                    <td>
			                    	@if($list->status == "Active")
			                    	<a href="{{url('admin/user/changeqrstatus/')}}/{{$list->id}}/Deactive"><span class="badge badge-primary" style="background: blue;color: white">{{$list->status}}</span></a>
			                    	@else
			                    	<a href="{{url('admin/user/changeqrstatus/')}}/{{$list->id}}/Active"><span class="badge badge-danger" style="background: red">{{$list->status}}</</span></a>
			                    	@endif
			                    </td>
			                    <td>{{$list->created_at}}</td>
			                    <td>
			                    	

			                    	<a href="{{url('admin/user/editqrcode/')}}/{{$list->id}}" class="fa fa-edit">
			                    	
			                    		
									<a onclick="return confirm('Are you sure you want to delete  ?')"  href="{{url('admin/user/deleteqrcode/')}}/{{$list->id}}" class="fa fa-trash" style="padding: 15px;color: red">
			                    	</a>
			                    	<a href="{{url('qrcode/reports/')}}/{{$list->id}}" class="fa fa-bug" style="padding: 1px;color: blue"></a>

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