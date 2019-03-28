<!doctype html>
<html lang="en">

<head>
	<title>Typography</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/vendor/linearicons/style.css">
	<link rel="stylesheet" href="/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="/css/core.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<!-- GOOGLE FONTS -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet"> -->
	<!-- ICONS -->
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="container-fluid"><br>
			<div class="panel panel-headline">
				<div class="panel-body">
					<p><code>财务报表：</code> <a href="/admin/export">导出数据</a></p>
					<hr>
					<p><code>用户缴费情况(全)：</code> <a href="/admin/allPayment">导出数据</a></p>
					<hr>
					<p><code>日报表：</code><input type="date" name="" id="day"></p>
					
					<hr>
					<p ><code>月报表：</code><input type="month" name="" id="month"></p>
					
					<hr>
					
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
    <script>
        let day = document.querySelector('#day');
        day.addEventListener('change', function (){
            location.href = '/admin/dayPayment?day='+this.value;
        })
        
        let month = document.querySelector('#month');
        month.addEventListener('change', function (){
            location.href = '/admin/monthPayment?month='+this.value;
        })
    </script>
</body>

</html>