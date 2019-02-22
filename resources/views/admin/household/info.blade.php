<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>主要内容区main</title>
  <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
  <link href="/css/css.css" type="text/css" rel="stylesheet" />
  <link href="/css/main.css" type="text/css" rel="stylesheet" />
  <link rel="shortcut icon" href="/images/main/favicon.ico" />
  <link rel="stylesheet" href="/css/page.css">
  <link rel="stylesheet" href="/css/iconfont.css">

  <style>
    body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#searchmain{ font-size:12px;}
#search { background-color: #548fc9;}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;color:#fff;}
#search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(/images/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{  padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF; float:right}
#search a:hover.add{ text-decoration:underline; color:#d2e9ff;}
#main-tab{ border:1px solid #eaeaea; background:#FFF; font-size:12px;}
#main-tab th{ font-size:12px; background:url(/images/main/list_bg.jpg) repeat-x; height:32px; line-height:32px;}
#main-tab td{ font-size:12px; line-height:40px;}
#main-tab td a{ font-size:12px; color:#548fc9;}
#main-tab td a:hover{color:#565656; text-decoration:underline;}
.bordertop{ border-top:1px solid #ebebeb}
.borderright{ border-right:1px solid #ebebeb}
.borderbottom{ border-bottom:1px solid #ebebeb}
.borderleft{ border-left:1px solid #ebebeb}
.gray{ color:#dbdbdb;}
td.fenye{ padding:10px 0 0 0; text-align:right;}
.bggray{ background:#f9f9f9}
th {
    text-align: center;
}
.select-list {
  display: inline;
  width: 100px;
  margin-left:50px;
}
</style>
</head>

<body>
<h3>
  <span style="color:#999;font-size:14px;">当前用户:</span>  {{$user->realname}} <small>({{$user->username}})</small>

  <div style="float:right;margin-right:50px;">
    <select class="form-control select-list" id="select_list"> 
      <option value="electric" @if($key === 'electric') selected @endif>电费</option>
      <option value="rent" @if($key === 'rent') selected @endif>房租</option>
      <option value="property" @if($key === 'property') selected @endif>物业费</option>
      <option value="water" @if($key === 'water') selected @endif>水费</option>
    </select>
    <a href="javaScript:;" onClick="javascript :history.back(-1);" class="btn btn-default">返回</a>
  </div>
</h3>

  <!--main_top-->
  <table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
    <tr>
      <td align="left" valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
          <tr>
            <th align="center" valign="middle" class="borderright">编号</th>
            <th align="center" valign="middle" class="borderright">金额</th>
            <th align="center" valign="middle" class="borderright">已支付</th>
            <th align="center" valign="middle" class="borderright">缴费期限</th>
            <th align="center" valign="middle" class="borderright">缴费状态</th>
          </tr>
          @foreach($data as $k=>$v)
          <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
            <td align="center" valign="middle" class="borderright borderbottom">{{ $v->id }}</td>
            <td align="center" valign="middle" class="borderright borderbottom">{{ $v->money }}</td>
            <td align="center" valign="middle" class="borderright borderbottom">{{ $v->cost }}</td>
            <td align="center" valign="middle" class="borderright borderbottom">{{ $v->date }}</td>
            <td align="center" valign="middle" class="borderright borderbottom">
              @if($v->state === 0)
                <span style="color:red;">未支付</span>  
              @elseif($v->state === 1)
                <span style="color:green;">已支付</span> 
              @endif
            </td>
      
            <td align="center" valign="middle" class="borderbottom"><span class="gray"></span>
          </tr>
          @endforeach
        </table>
      </td>
    </tr>
    <tr>
      <td align="left" style="text-align:center" valign="top" class="fenye"></td>
    </tr>
  </table>

  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script>
    
    var month = document.querySelector('#select_list');
    month.addEventListener('change', function (e) {
      // 当时间改变后，重新刷新页面
      window.location.href = '/admin/payment/{{$user->id}}?keyword='+this.value
    })
  </script>
</body>

</html>