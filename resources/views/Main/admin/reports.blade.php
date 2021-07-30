@extends('Main/admin/layout')
@section('page_title', 'Qr Reports')
@section('users_select', 'active')
@section('container')

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-2">
	<div class="col">
		<div class="card border-primary border-bottom border-3 border-0">
			<div class="card-body">
				<div id="deviceChart" style="width: 490px; height: 300px;"></div>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="card border-danger border-bottom border-3 border-0">
			<div class="card-body">
				<div id="deviceOSChart" style="width: 490px; height: 300px;"></div>
			</div>
		</div>
	</div>
	
  <div class="col">
    <div class="card border-success border-bottom border-3 border-0">
      <div class="card-body">
        <div id="deviceBrowserChart" style="width: 490px; height: 300px;"></div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card border-success border-bottom border-3 border-0">
      <div class="card-body">
       <div style="text-align: center;">
        <h1>Total Count</h1>
        
          <?php 
              $totalcount = 0;
              if($qrtraffic){
                foreach($qrtraffic as $list){
                  $totalcount += $list->totaleacess;
                }
              }
            ?>
         <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4"><h3 style="border-radius: 50%;border: 1px dashed silver">{{$totalcount}}</h3></div>
          <div class="col-md-4"></div>
           
         </div>
        <h4><a href="{{url('qrcode/detailsreports/'.$qrcode[0]->id)}}"><span class="fa fa-tasks"></span>&nbsp;Details Reports</a></h4>
       </div>
      </div>
    </div>
  </div>
</div>

<div class="card">
	<div class="table-responsive">
		<table id="example" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Qr Code</th>
					<th>Date</th>
					<th>Count</th>
				</tr>
			</thead>
			@if($qrtraffic)
			@foreach($qrtraffic as $qr)
      <tr>
				<td>
          <?php 
            if(isset($qrcode[0])){
              echo $qrcode[0]->name;
            }
          ?>
        </td>
        <td>{{date('d M Y', strtotime($qr->created_at))}}</td>
        <td>{{$qr->totaleacess}}</td>
			</tr>
			@endforeach
			@endif
			
		</table>
	</div>
</div>


<?php 
  $devicechart = "";
  foreach($total_device as $device){
      $devicechart .= "['".$device->device."', ".$device->total_device."], ";
  }
  $devicechart = rtrim($devicechart, ",");
?>


<?php 
  $osdevicechart = "";
  foreach($osdevice as $operatingsystem){
      $osdevicechart .= "['".$operatingsystem->OS."', ".$operatingsystem->total_os."], ";
  }
  $osdevicechart = rtrim($osdevicechart, ",");
?>


<?php 
  $browserchart = "";
  foreach($browserdetection as $drowser){
      $browserchart .= "['".$drowser->browser."', ".$drowser->total_browser_dt."], ";
  }
  $browserchart = rtrim($browserchart, ",");
?>



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(deviceChart);
      google.charts.setOnLoadCallback(drawOsChart);
      google.charts.setOnLoadCallback(drawBrowserChart);

      function deviceChart() {
		var data = google.visualization.arrayToDataTable([
          ['Device', 'Total User'],
          <?= $devicechart; ?>
        
        ]);

        var options = {
          title: 'Device Detection'
        };

        var chart = new google.visualization.PieChart(document.getElementById('deviceChart'));

        chart.draw(data, options);
      }

       function drawOsChart() {

        var data = google.visualization.arrayToDataTable([
          ['Device', 'Operating System'],
          <?= $osdevicechart; ?>
        
        ]);

        var options = {
          title: 'Operating System Detection'
        };

        var chart = new google.visualization.PieChart(document.getElementById('deviceOSChart'));

        chart.draw(data, options);
      }

      

      
       function drawBrowserChart() {

        var data = google.visualization.arrayToDataTable([
          ['Device', 'Drowser Detection'],
          <?= $browserchart; ?>
        
        ]);

        var options = {
          title: 'Browser Detection'
        };

        var chart = new google.visualization.PieChart(document.getElementById('deviceBrowserChart'));

        chart.draw(data, options);
      }
    </script>

    
  </head>
  
</html>

@endsection