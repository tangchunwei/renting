<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<title>掌上公租房</title>
	<link rel="stylesheet" type="text/css" href="/css/weixin/base.css" />
	<link rel="stylesheet" type="text/css" href="/css/weixin/index.css" />
	<link rel="stylesheet" href="/css/iconfont.css">
	<style>
		.iconfont {
			font-family:"iconfont" !important;
			font-size:2.5rem;
			font-style:normal;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			}

		.name .warn {
			background-color: #e51c23;
		}
	</style>
</head>

<body>
	<div class="top clearfix">
		<img src="/images/weixin/logo.png" />
		<div class="name">{{session('realname')}}	
			<span>{{$ishouse}}</span>  
			@if($iswarn == 0)
			<span  onclick="location.href='{{route('order')}}' " class="warn">
				未缴纳
			</span>
			@endif
		</div>
		<div class="idnum">&#xe9a7;
			<span>{{session('cardId')}}</span>
		</div>
		<div class="phone">&#xe60d;
			<span>{{session('phone')}}</span>
		</div>
		<div class="addr" onclick="location.href='{{route('weixin_ditu')}}' ">&#xe654;
			<span>{{session('village')}}</span>
		</div>
		<div class="handle">
			<span>&#xe678;</span>
			<!-- <span>&#xe604;</span> -->
		</div>
	</div>
	<!--我的账单-->
	<div class="myorder">
		<span>&#xe6b0;</span>我的账单
		<span style="float: right;">&#xe602;</span>
	</div>
	<div class="orderdetail">
		<div>
		@if(session()->has('contract'))
			<div class="price">{{session('contract')}}</div>
			<div>签约费用</div>
		@else
			<div class="price">0.00</div>
			<div>未支付-签约费用</div>
		@endif
		</div>
		<div>
			<div class="price">{{$rent}}</div>
			<div>未支付-租金</div>
		</div>
		<div>
			<div class="price">{{$paid}}</div>
			<div>已支付</div>
		</div>
	</div>
	<!--本月清单-->
	<div class="myorder">
		<span>&#xe703;</span>费用清单
		<span style="float: right;">&#xe602;</span>
	</div>
	<div class="orderdetail">
		<div>
			<div class="price">{{$elec}}</div>
			<div>电费</div>
		</div>
		<div>
			<div class="price">{{$water}}</div>
			<div>水费</div>
		</div>
		<div>
			<div class="price">{{$prop}}</div>
			<div>物业费</div>
		</div>
	</div>
	<div class="list clearfix">
		<div onclick="location.href='{{route('weixin_warranty_claim')}}' ">
			<div class="ico" style="color: #FF9800;">&#xe747;</div>
			<div class="tit">保修申请</div>
		</div>
		<div onclick="location.href='{{route('weixin_warranty_list')}}' ">
			<div class="ico" style="color: #55B154;">&#xe627;</div>
			<div class="tit">保修查询</div>
		</div>
		<div onclick="location.href='{{route('weixin_xuzu')}}' ">
			<div class="ico" style="color: #55B154;">&#xe637;</div>
			<div class="tit">我要续租</div>
		</div>
		<div onclick="location.href='{{route('weixin_tuizu')}}' ">
			<div class="ico" style="color: red;">&#xe637;</div>
			<div class="tit">提前退租</div>
		</div>
		<div onclick="location.href='{{route('weixin_fwbg')}}' ">
			<div class="ico" style="color: #FF4081;">&#xe603;</div>
			<div class="tit">房屋变更</div>
		</div>
		<div onclick="location.href='{{route('order')}}' ">
			<div class="ico" style="color: #5972FB;">&#xe61c;</div>
			<div class="tit">在线缴费</div>
		</div>
		<div onclick="location.href='{{route('weixin_htlb')}}' ">
			<div class="ico" style="color: #FF9F11;">&#xe613;</div>
			<div class="tit">合同查询</div>
		</div>
		<div onclick="location.href='{{route('weixin_bindphone')}}' ">
			<div class="ico" style="color: #259B24;">&#xe617;</div>
			<div class="tit">修改手机</div>
		</div>
		<div onclick="location.href='{{route('retrieve1')}}' ">
			<div class="ico" style="color: #259B24"><i class="iconfont icon-jiesuo"></i></div>
			<div class="tit">修改密码</div>
		</div>
	</div>
	<script>
		var jwt = "{{$jwt}}";
		if(jwt) {
		    localStorage.setItem('jwt', jwt);
		}
	</script>
</body>
</html>