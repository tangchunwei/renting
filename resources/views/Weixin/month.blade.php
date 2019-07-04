<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<title>本月清单</title>
	<link rel="stylesheet" type="text/css" href="/css/weixin/base.css" />
	<link rel="stylesheet" type="text/css" href="/css/weixin/month_list.css" />
</head>

<body>
	<div class="wrap">
		<div class="title">我的费用清单</div>
		<div class="tips">请选择要支付的账单</div>

		@foreach($rent as $k => $v)
		<div class="list" data-id="{{$v->id}}" data-table="rent">
			<label class="item clearfix">
				<!-- <input type="radio" name="type" value="">房租 {{$v->date}} -->
				{{$v->date}}&nbsp;房租
				<small>未支付</small>
				<span style="color: red;float: right;font-size: 16px;">{{$v->money - $v->cost}}</span>
			</label>
		</div>
		@endforeach
		@foreach($water as $k => $v)
		<div class="list" data-id="{{$v->id}}" data-table="water">
			<label class="item clearfix">
				<!-- <input type="radio" name="type" value="">房租 {{$v->date}} -->
				{{$v->date}}&nbsp;水费
				<small>未支付</small>
				<span style="color: red;float: right;font-size: 16px;">{{$v->money - $v->cost}}</span>
			</label>
		</div>
		@endforeach
		@foreach($elec as $k => $v)
		<div class="list" data-id="{{$v->id}}" data-table="elec">
			<label class="item clearfix">
				<!-- <input type="radio" name="type" value="">房租 {{$v->date}} -->
				{{$v->date}}&nbsp;电费
				<small>未支付</small>
				<span style="color: red;float: right;font-size: 16px;">{{$v->money - $v->cost}}</span>
			</label>
		</div>
		@endforeach
		@foreach($prop as $k => $v)
		<div class="list" data-id="{{$v->id}}" data-table="prop">
			<label class="item clearfix">
				<!-- <input type="radio" name="type" value="">房租 {{$v->date}} -->
				{{$v->date}}&nbsp;物业费
				<small>未支付</small>
				<span style="color: red;float: right;font-size: 16px;">{{$v->money - $v->cost}}</span>
			</label>
		</div>
		@endforeach

	</div>

</body>

</html>
<script>
	// var form = document.getElementById('form');
	// function subform() {
	// 	if ($(":radio:checked").length == 0) {
	// 		alert('请选择缴费项')
	// 	}
	// 	else {
	// 		form.submit();
	// 	}
	// }
	let divs = document.querySelectorAll('.list');
	divs.forEach(div => {
		div.addEventListener('click', function(){
			window.location.href = '/order/create?id='+this.dataset.id+'&table='+this.dataset.table;
		})
	})
	// div.addEventListener('click', function(){
	// 	console.log(this.dataset);
	// })
</script>