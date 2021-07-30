@extends('Main/admin/layout')
@section('page_title', 'Manage Colors')
@section('users_select', 'active')
@section('container')


<div class="card">
	<div class="card-body">
		<h6 class="mb-0 text-uppercase">Add Colors</h6><br>
		<form class="row g-3"  action="{{route('user.addcolors')}}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="col-md-6">
				<input type="text" class="form-control" name="colors" placeholder="Enter Colors" required="">
			</div>
			<div class="col-md-6">
			<button type="submit" class="btn btn-primary px-5">Add Color</button>
		</div>
	</form>
	</div>
</div>

<div class="card">
	<div class="card-body">
		<h6 class="mb-0 text-uppercase">Manage Color</h6>
	<hr/>
		<div class="table-responsive">
			<table id="example2" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Colors</th>
						<th>Status</th>
						<th>Added by</th>
						<th>Created date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($colors as $list)
					<?php  $user  =  Helper::get_user($list->added_by); ?>
					<tr>
						<td>{{$list->color}}</td>
						<td>
							@if($list->status == "Active")
	                    	<a href="{{url('admin/user/changecolorstatus/')}}/{{$list->id}}/Deactive"><span class="badge badge-primary" style="background: blue;color: white">{{$list->status}}</span></a>
	                    	@else
	                    	<a href="{{url('admin/user/changecolorstatus/')}}/{{$list->id}}/Active"><span class="badge badge-danger" style="background: red">{{$list->status}}</</span></a>
	                    	@endif
						</td>
						<td>{{$user[0]->name}}</td>
						<td>{{date('d M Y', strtotime($list->added_on))}}</td>
						<td>
							<button href="javascript:void(0)" class="fa fa-edit editcolorbtn" value="{{$list->id}}" style="color: blue"></button>


							<a onclick="return confirm('Are you sure you want to delete  ?')"  href="{{url('admin/user/deletecolors/')}}/{{$list->id}}" class="fa fa-trash" style="padding: 15px;color: red">
	                    	</a>
						</td>
					</tr>

					@endforeach
					
				</tbody>
				
			</table>
		</div>
	</div>
</div>
</div>
</div>

<!-- Button trigger modal -->

<!-- Edit Modal -->
<div class="modal fade" id="editColormodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Color</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <a href="{{url('admin/managecolor')}}"><span aria-hidden="true">&times;</span></a>
        </button>
      </div>
      <form class="row g-3"  action="{{route('user.updatecolors')}}" method="post" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="id" id="color_id" value="">
      	<div class="modal-body">
        	<input type="text" class="form-control" id="color_name" name="color_name" placeholder="Enter Colors" required="">
		</div>
      <div class="modal-footer">
        	<button type="submit" class="btn btn-primary">Update Color</button>
		</div>
	</form>
    </div>
  </div>
</div>

@endsection