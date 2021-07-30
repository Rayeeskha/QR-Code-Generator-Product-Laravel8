@extends('Main/admin/layout')
@section('page_title', 'Qr Reports')
@section('qr_select', 'active')
@section('container')

<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<h6 class="mb-0 text-uppercase">QR Code Detail Reports</h6>
			</div>
			<div class="col-md-6">
				<a href="{{url('qrcode/reports/')}}/{{$qrcode[0]->qr_code_id}}" class="btn btn-primary">Back</a>
			</div>
		</div>
		
			<hr/>
		<div class="table-responsive">
			<table id="example2" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Device</th>
						<th>OS</th>
						<th>Browser</th>
						<th>City</th>
						<th>State</th>
						<th>Country</th>
						<th>IP Address</th>
						<th>Added On</th>
					</tr>
					</thead>
					@if($qrcode)
					@foreach($qrcode as $list)
					<tr>
						<td>{{$list->device}}</td>
						<td>{{$list->OS}}</td>
						<td>{{$list->browser}}</td>
						<td>{{$list->city}}</td>
						<td>{{$list->state}}</td>
						<td>{{$list->country}}</td>
						<td>{{$list->ip_address}}</td>
						<td>{{date('d M Y', strtotime($list->added_on_str))}}</td>
					</tr>

					@endforeach
					@endif
				
				<tbody>
					
					
				</tbody>
				
			</table>
		</div>
	</div>
</div>
</div>
</div>


@endsection