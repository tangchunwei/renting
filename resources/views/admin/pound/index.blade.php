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

<style>
body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#searchmain{ font-size:12px;}
#search { background-color: #548fc9;}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
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
</style>
</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top">您的位置：手续费管理&nbsp;&nbsp;>&nbsp;&nbsp;主页</td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
  		<tr>
   		 <td width="90%" align="left" valign="middle">
	        <form>
              <span>管理员：</span>
              
              <input type="text" name="keyword" value="" class="text-word">
              <input type="submit" value="查询" class="text-but">
              
	        </form>

         </td>
            <td align="right" valign="middle">
                <a href="/admin/pound/create" class="btn btn-default btn-sm" style="margin-right:10px;">添加</a>

            </td>
  		</tr>
	</table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
     
    @if($errors->has('error'))
				<span style='color:red'>{{$errors->first('error')}}</span>
        
    @endif
    @if(session('success'))
    <span style='color:green'>{{session('success')}}</span>
    @endif
    <tr>
        <th align="center" valign="middle" class="borderright">编号</th>
        <th align="center" valign="middle" class="borderright">收费项</th>
        <th align="center" valign="middle" class="borderright">金额</th>
        <th align="center" valign="middle" class="borderright">备注</th>
        <th align="center" valign="middle" class="borderright">状态</th> 
        <th align="center" valign="middle">操作</th>
      </tr>
    @foreach($data as $k=>$v)
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="center" valign="middle" class="borderright borderbottom">{{ $v->id }}</td>
        <td align="center" valign="middle" class="borderright borderbottom">{{ $v->toll_item }}</td>
        <td align="center" valign="middle" class="borderright borderbottom">{{ $v->sum }}</td>
     
        <td align="center" valign="middle" class="borderright borderbottom">
            {{ $v->remark }}
        </td>
        <td align="center" valign="middle" class="borderright borderbottom">
            {{ $v->status_code }}
        </td>
        <td align="center" valign="middle" class="borderbottom">
        <a href="{{route('pound.edit',['id'=>$v->id])}}"  target="mainFrame" onFocus="this.blur()" class="btn btn-default btn-xs">修改</a>
       
          <form action="/admin/pound/{{$v->id}}" style="display:inline;" method="post" onclick="return confirm('请确定是否要删除？ ')">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input class="btn btn-warning btn-xs" type="submit" value="删除">
          </form>
        </td>
      </tr>
      @endforeach
    </table></td>
    </tr>
    <tr>
    <td align="left" style="text-align:center" valign="top" class="fenye"></td>
  </tr>
</table>

 

  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>