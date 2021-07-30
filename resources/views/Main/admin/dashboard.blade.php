@extends('Main/admin/layout')
@section('page_title', 'Dashboard')
@section('container')

<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
   <div class="col">
	 <div class="card radius-10 border-start border-0 border-3 border-info">
		<div class="card-body">
			<div class="d-flex align-items-center">
				<div>
					<p class="mb-0 text-secondary">Total USERS</p>
					<h4 class="my-1 text-info">
						<?php if($users){echo count($users); }else{ echo "0"; }  ?>
					</h4>
				</div>
				<div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-cart'></i>
				</div>
			</div>
		</div>
	 </div>
   </div>
   <div class="col">
	<div class="card radius-10 border-start border-0 border-3 border-danger">
	   <div class="card-body">
		   <div class="d-flex align-items-center">
			   <div>
				   <p class="mb-0 text-secondary">Total Created QR Code</p>
				   <h4 class="my-1 text-danger">
				   	<?php  if (isset($total_qr[0])) { echo $total_qr[0]->total_qrcode;  }else{ echo "0"; } ?>

				   </h4>
				</div>
			   <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class='bx bxs-wallet'></i>
			   </div>
		   </div>
	   </div>
	</div>
  </div>
  <div class="col">
	<div class="card radius-10 border-start border-0 border-3 border-success">
	   <div class="card-body">
		   <div class="d-flex align-items-center">
			   <div>
				   <p class="mb-0 text-secondary">Total Wallate Qr Code</p>
				   <h4 class="my-1 text-success">
				   		<?php 
				   			$totalqr = Helper::get_user_qr_total_wallate_qr(); 
			   				if ($totalqr) {
			   					echo $totalqr;
			   				}else{
			   					echo "0";
			   				}
				   		?>
					</h4>
				</div>
			   <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-bar-chart-alt-2' ></i>
			   </div>
		   </div>
	   </div>
	</div>
  </div>
  <div class="col">
	<div class="card radius-10 border-start border-0 border-3 border-warning">
	   <div class="card-body">
		   <div class="d-flex align-items-center">
			   <div>
				   <p class="mb-0 text-secondary">Total QR Hits</p>
				   <h4 class="my-1 text-warning">
				   	<?php $total_hits  = Helper::get_user_qr_total_qr_hits();
				   			if ($total_hits) {
				   				echo $total_hits;
				   			}else{
				   				echo "0";
				   			}
				   	 ?>

				   </h4>
				</div>
			   <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='bx bxs-group'></i>
			   </div>
		   </div>
	   </div>
	</div>
  </div> 
</div><!--end row-->

<div class="row">
   <div class="col-12 col-lg-6">
      <div class="card radius-10">
		  <div class="card-body">
			<div id="deviceChart" style="width: 490px; height: 300px;"></div>
		  </div>
	 </div>
	</div>
	<div class="col-12 col-lg-6">
	 <div class="card radius-10">
		  <div class="card-body">
			<div id="deviceOSChart" style="width: 490px; height: 300px;"></div>
		  </div>
	 </div>
   </div>
   <div class="col-12 col-lg-6">
	 <div class="card radius-10">
		  <div class="card-body">
			<div id="deviceBrowserChart" style="width: 490px; height: 300px;"></div>
		  </div>
	 </div>
   </div>
    <div class="col-12 col-lg-6">
	 <div class="card radius-10">
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
       	</div>
		</div>
	 </div>
   </div>

  
	 </div><!--end row-->

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

@endsection