@extends('Main/admin/layout')
@section('page_title', 'Manage Sizes')
@section('users_select', 'active')
@section('container')


<div class="card">
	<div class="card-body">
		<h6 class="mb-0 text-uppercase">Add Size</h6><br>
		<form class="row g-3"  action="{{route('user.addsize')}}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="col-md-6">
				<input type="text" class="form-control" name="size" placeholder="Enter Size" required="">
			</div>
			<div class="col-md-6">
			<button type="submit" class="btn btn-primary px-5">Add Size</button>
		</div>
	</form>
	</div>
</div>

<div class="card">
	<div class="card-body">
		<h6 class="mb-0 text-uppercase">Manage Size</h6>
	<hr/>
		<div class="table-responsive">
			<table id="example2" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Size</th>
						<th>Status</th>
						<th>Added by</th>
						<th>Created date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($sizes as $list)
					<?php  $user  =  Helper::get_user($list->added_by); ?>
					<tr>
						<td>{{$list->size}}</td>
						<td>
							@if($list->status == "Active")
	                    	<a href="{{url('admin/user/changesizestatus/')}}/{{$list->id}}/Deactive"><span class="badge badge-primary" style="background: blue;color: white">{{$list->status}}</span></a>
	                    	@else
	                    	<a href="{{url('admin/user/changesizestatus/')}}/{{$list->id}}/Active"><span class="badge badge-danger" style="background: red">{{$list->status}}</</span></a>
	                    	@endif
						</td>
						<td>{{$user[0]->name}}</td>
						<td>{{date('d M Y', strtotime($list->added_on))}}</td>
						<td>
							<a href="javascript:void(0)" class="fa fa-edit" onclick="edit_size('{{$list->id}}')"></a>
							<a onclick="return confirm('Are you sure you want to delete  ?')"  href="{{url('admin/user/deletesize/')}}/{{$list->id}}" class="fa fa-trash" style="padding: 15px;color: red">
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


<!--------Edit Size Modal ------->
<!-- Edit Modal -->
<div class="modal fade" id="editSizeMOdal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Size</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <a href="{{url('admin/managesize')}}"><span aria-hidden="true">&times;</span></a>
        </button>
      </div>
      <form class="row g-3"  action="{{route('user.updatesizes')}}" method="post" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="id" id="size_id" value="">
      	<div class="modal-body">
        	<input type="text" class="form-control" id="size" name="size" placeholder="Enter Size" required="">
		</div>
      <div class="modal-footer">
        	<button type="submit" class="btn btn-primary">Update Size</button>
		</div>
	</form>
    </div>
  </div>
</div>
<!--------Edit Size Modal ------->

<script type="text/javascript">
	function edit_size(id){
		$('#editSizeMOdal').modal('show');
		$.ajax({
            type:"GET",
            url:"/admin/user/edit_size/"+id,
            success:function(response){
                console.log(response);
                $('#size_id').val(response.sizesrdata[0].id)
                $('#size').val(response.sizesrdata[0].size);
            }
        });
	}
</script>

@endsection