<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主要内容区main</title>
<link href="/css/css.css" type="text/css" rel="stylesheet" />
<link href="/css/main.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="/images/main/favicon.ico" />
<style>
body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#searchmain{ font-size:12px;}
#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
#search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(/images/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(/images/main/add.jpg) no-repeat 0px 6px; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF}
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
.bggray{ background:#f9f9f9; font-size:14px; font-weight:bold; padding:10px 10px 10px 0; width:120px;}
.main-for{ padding:10px;}
.main-for input.text-word{ width:310px; height:36px; line-height:36px; border:#ebebeb 1px solid; background:#FFF; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; padding:0 10px;}
.main-for select{ width:310px; height:36px; line-height:36px; border:#ebebeb 1px solid; background:#FFF; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666;}
.main-for input.text-but{ width:100px; height:40px; line-height:30px; border: 1px solid #cdcdcd; background:#e6e6e6; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#969696; float:left; margin:0 10px 0 0; display:inline; cursor:pointer; font-size:14px; font-weight:bold;}
#addinfo a{ font-size:14px; font-weight:bold; padding:0px 0 0px 20px; line-height:45px;}

</style>
</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top">您的位置：续租管理&nbsp;&nbsp;>&nbsp;&nbsp;添加续租</td>
  </tr>
  <tr>
    <td align="left" valign="top" id="addinfo">
    <a target="mainFrame" onFocus="this.blur()" class="add"></a>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <form method="post" action="{{ route('doAdd_xuzu') }}">
    {{ csrf_field() }}
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
    
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">姓名：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="realname" value="{{ old('realname') }}" class="text-word">
        @if($errors->has('realname'))
				  <span style='color:red'>{{$errors->first('realname')}}</span> 
			  @endif
        </td>
        </tr>
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">电话：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="phone" value="{{ old('phone') }}" class="text-word">
        @if($errors->has('phone'))
				  <span style='color:red'>{{$errors->first('phone')}}</span> 
			  @endif
        </td>
        </tr>
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">身份证：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="cardId" value="{{ old('cardId') }}" class="text-word">
        @if($errors->has('cardId'))
				  <span style='color:red'>{{$errors->first('cardId')}}</span> 
			  @endif
        </td>
        </tr>

        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">续租时长：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <select name="time" value="" id="level">
     
	    <option @if(old('time')=='1') selected @endif value="1" >&nbsp;&nbsp;1个月</option>
        <option @if(old('time')=='3') selected @endif value="3" >&nbsp;&nbsp;3个月</option>
        <option @if(old('time')=='6') selected @endif value="6" >&nbsp;&nbsp;半年</option>
        <option @if(old('time')=='12') selected @endif value="12" >&nbsp;&nbsp;一年</option>
    
        </select>
        </td>
      </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">住址：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="address" value="{{ old('address') }}" class="text-word">
        @if($errors->has('address'))
				  <span style='color:red'>{{$errors->first('address')}}</span> 
			  @endif
        </td>
        </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">缴费标准：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="rent" value="" class="text-word">
        @if($errors->has('rent'))
				  <span style='color:red'>{{$errors->first('rent')}}</span> 
			  @endif
        </td>
      </tr>
     

      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">小区：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <select name="village" value="" id="level">
      @foreach($village as $v)
	    <option @if(old('village')==$v->name) selected @endif value="{{ $v->name }}">&nbsp;&nbsp;{{ $v->name }}</option>
      @endforeach
        </select>
        @if($errors->has('village'))
				  <span style='color:red'>{{$errors->first('village')}}</span> 
			  @endif
        </td>
        
      </tr>

      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">审核状态：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <select name="state" value="" id="level">

        <option @if(old('state')=='审核中') selected @endif value="审核中" >&nbsp;&nbsp;审核中</option>
        <option @if(old('state')=='审核通过') selected @endif value="审核通过" >&nbsp;&nbsp;审核通过</option>
        <option @if(old('state')=='审核不通过') selected @endif value="审核不通过" >&nbsp;&nbsp;审核不通过</option>
   
        </select>
        </td>
      </tr>
      
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">&nbsp;</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input name="" type="submit" value="添加" class="text-but">
        <input name="" type="reset" value="重置" class="text-but"></td>
        </tr>
    </table>
    </form>
    </td>
    </tr>
</table>
</body>
</html>
<script>
  window.onload=function(){
    var a=document.getElementsByTagName("input");
    for(var i=0,len=a.length;i<len;i++){
      if(a[i].getAttribute("type")=='text'){a[i].setAttribute('autocomplete','off')}
    }
  }
</script> 