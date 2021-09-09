@extends('Man.index')
@section('content')
<div class="row">
	<div class="col-md-5">
		<h3 class="dashboard-title">BÁO CÁO KẾT QUẢ BÁN HÀNG HÔM NAY</h3>
	</div>
	<div class="col-md-7 text-right action">
		<button class="btn btn-primary" onclick="reload()"><i class="fa fa-desktop" aria-hidden="true"></i> Reload</button>
	</div>
	<div class="col-md-4">
		<div class="resport-box resport-blue">
			<div class="resport-icon">
				<i class="fa fa-usd" aria-hidden="true"></i>
			</div>
			<div class="resport-data">
				
				<p> Hóa đơn đã thanh toán</p>
				<h4> {{$count1}} Hóa đơn</h4>
				<span>Thành tiền: {{number_format($check1,0)}} vnđ</span>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="resport-box resport-green">
			<div class="resport-icon">
				<i class="fa fa-pencil" aria-hidden="true"></i>
			</div>
			<div class="resport-data">
				<p>Hóa đơn đang phục vụ</p>
				<h4>{{$count0}} Hóa đơn</h4>
				<span>Thành tiền:{{number_format($check0,0)}} vnđ</span>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="resport-box resport-red">
			<div class="resport-icon">
				<i class="fa fa-user" aria-hidden="true"></i>
			</div>
			<div class="resport-data">
				<p>Hóa đơn nhập kho</p>
				<h4>{{$count2}} Hóa đơn nhập</h4>
				<span>Thành tiền:{{number_format($check2,0)}} vnđ</span>
			</div>
		</div>
	</div>
</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div id="curve_chart" style="height: 500px"></div>
	</div >

	<div class="col-md-12">
			<div id="columnchart_values" style="height: 300px;"></div>
	</div>

	 
</div>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Time', 'Payslips', 'Receipts'],
          @foreach($ballot as $key)
          	['{{$key['time']}}h',{{$key['pay']}},{{$key['recep']}}],
          @endforeach
        ]);

        var options = {
          title: 'Đánh giá phiếu thu,chi trong ngày',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }



    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(draw);
    function draw() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Count", { role: "style" } ],
        @foreach($sort as $key2)
        ["{{$key2['name']}}", {{$key2['count']}}, "#1a73e8"],
        @endforeach
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Đánh giá độ tiêu thụ thực đơn trong ngày",
        height: 600,
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }


    </script>
@endsection