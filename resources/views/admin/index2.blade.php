<!doctype html>
<html lang="en">

<head>
	<title>Home</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/vendor/linearicons/style.css">
	<link rel="stylesheet" href="/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="/css/core.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="/css/demo.css">
	<!-- GOOGLE FONTS -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet"> -->
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="/images/coreapple-icon.png">
	<!-- <link rel="icon" type="image/png" sizes="96x96" href="/images/core/favicon.png"> -->
	<link rel="stylesheet" href="/css/cr_table.css">
	<style>
		th {
			text-align: center;
		}
	</style>
</head>

<body>
	<!-- WRAPPER -->

		<div id="echart" style="width:100%"></div>

</body>

</html>

<script src="/vendor/jquery/jquery.min.js"></script>
	<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="/vendor/chartist/js/chartist.min.js"></script>
	<script src="/scripts/klorofil-common.js"></script>
    <script src="/js/echarts.min.js"></script>
    <script>
      
   
	window.onresize = function(){
        var winH=$(window).height();
        $('#echart').height(winH);
    };
    $(window).resize();
    function quot(str){
			s1=str.replace(/&quot;/g,'"');
			return JSON.parse(s1)
		}
		let arr = quot("{{$data}}");
    $(function(){
        // app.title = '堆叠柱状图';
    var myChart = echarts.init( document.getElementById('echart'));
    var options = {
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b}: {c}"
        },
        legend: {
            orient: 'vertical',
            x: 'left',
            data:['直达','营销广告','搜索引擎','邮件营销','联盟广告','视频广告','百度','谷歌','必应','其他']
        },
        series: [
            {
                name:'公房管理中心',
                type:'pie',
                selectedMode: 'single',
                radius: [0, '30%'],

                label: {
                    normal: {
                        position: 'center',
                        color: '#fff',
                        fontSize: 18,
                    }
                },
                labelLine: {
                    normal: {
                        show: false
                    }
                },
            
                data:[
                    // {value:1400, name:''},
                    {value:1400, name:'公房管理中心'}
                ]
            },
            {
                name:'住户数量',
                type:'pie',
                radius: ['40%', '55%'],
                label: {
                    normal: {
                        formatter: '{a|{a}}{abg|}\n{hr|}\n  {b|{b}：}{c}  ',
                        backgroundColor: '#eee',
                        borderColor: '#aaa',
                        borderWidth: 1,
                        borderRadius: 4,
                        // shadowBlur:3,
                        // shadowOffsetX: 2,
                        // shadowOffsetY: 2,
                        // shadowColor: '#999',
                        // padding: [0, 7],
                        rich: {
                            a: {
                                color: '#999',
                                lineHeight: 22,
                                align: 'center'
                            },
                            // abg: {
                            //     backgroundColor: '#333',
                            //     width: '100%',
                            //     align: 'right',
                            //     height: 22,
                            //     borderRadius: [4, 4, 0, 0]
                            // },
                            hr: {
                                borderColor: '#aaa',
                                width: '100%',
                                borderWidth: 0.5,
                                height: 0
                            },
                            // b: {
                            //     fontSize: 16,
                            //     lineHeight: 33
                            // },
                            per: {
                                color: '#eee',
                                backgroundColor: '#334455',
                                padding: [2, 4],
                                borderRadius: 2
                            }
                        }
                    }
                },
                data:[
                    @foreach($data as $v)
                    {value:{{$v->count}}, name:'{{$v->name}}'},
                    @endforeach
                    // {value:310, name:'邮件营销'},
                    // {value:234, name:'联盟广告'},
                    // {value:135, name:'视频广告'},
                    // {value:1048, name:'百度'},
                    // {value:251, name:'谷歌'},
                    // {value:147, name:'必应'},
                    // {value:102, name:'其他'},
                    // {value:101, name:'其他1'}
                
                ]
            }
        ]
    };
    myChart.setOption(options);
    myChart.on('click', function (param){

        var name=param.name;
        window.location.href="/admin/house#"+name
        // if(name=="用户数"){

        // window.location.href="${base}/admin/user/list.htm";

        // }else if(name=="栏目数"){

        // window.location.href="${base}/admin/classify/list.htm";

        // }else if(name=="新闻数"){

        // window.location.href="${base}/admin/news/list.htm";

        // }else{

        // window.location.href="${base}/admin/file/list.htm";

        // }

        });
    })
    
    </script>
