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
    <td width="99%" align="left" valign="top">您的位置：住户管理&nbsp;&nbsp;>&nbsp;&nbsp;编辑住户</td>
  </tr>
  <tr>
    <td align="left" valign="top" id="addinfo">
    <a target="mainFrame" onFocus="this.blur()" class="add"></a>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <form method="post" action="{{ route('doeditHold',['id'=>$household->id]) }}">
    {{ csrf_field() }}
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">用户名：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="username" value="{{ $household->username }}" class="text-word">
        @if($errors->has('username'))
				  <span style='color:red'>{{$errors->first('username')}}</span>
			  @endif
        </td>
        </tr>

      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">密码：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="password" name="password" value="{{ $household->password }}" class="text-word">
        </td>
      </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">姓名：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="realname" value="{{ $household->realname }}" class="text-word">
        </td>
        </tr>
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">电话：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="phone" value="{{ $household->phone }}" class="text-word">
        </td>
        </tr>
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">身份证：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="cardId" value="{{ $household->cardId }}" class="text-word">
        </td>
        </tr>

        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">入住时间：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="date" name="start" value="{{ $household->start }}" class="text-word">
        @if($errors->has('start'))
				  <span style='color:red'>{{$errors->first('start')}}</span>
			  @endif
        </td>
        </tr>

        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">入住时长：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <select name="time" value="" id="level">
     
	    <option @if($household->time==1) selected @endif value="1" >&nbsp;&nbsp;1个月</option>
      <option @if($household->time==3) selected @endif value="3" >&nbsp;&nbsp;3个月</option>
      <option @if($household->time==6) selected @endif value="6" >&nbsp;&nbsp;半年</option>
      <option @if($household->time==12) selected @endif value="12" >&nbsp;&nbsp;一年</option>
    
        </select>
        </td>
      </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">住址：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="address" value="{{ $household->address }}" class="text-word">
        </td>
        </tr>
      <!-- <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">小区：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="village" value="{{ $household->village }}" class="text-word">
        </td>
      </tr> -->
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">入住人数：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="peoples" value="{{ $household->peoples }}" class="text-word">
        @if($errors->has('peoples'))
				  <span style='color:red'>{{$errors->first('peoples')}}</span>
			  @endif
        </td>
      </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">缴费标准：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="rent" value="{{ $household->rent }}" class="text-word">
      
        </td>
      </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">签约费用：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="contract" value="{{ $household->contract }}" class="text-word">
        @if($errors->has('contract'))
				  <span style='color:red'>{{$errors->first('contract')}}</span>
			  @endif
        </td>
      </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">折扣：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="number" name="discount" value="{{ $household->discount }}" class="text-word">
        @if($errors->has('discount'))
				  <span style='color:red'>{{$errors->first('discount')}}</span>
			  @endif
        </td>
      </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">备注：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
      
        <textarea name="remarks" id="" cols="40" rows="10">{{ $household->remarks }}</textarea>
        @if($errors->has('remarks'))
				  <span style='color:red'>{{$errors->first('remarks')}}</span>
			  @endif
        </td>
      </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">小区：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <select name="village" value="" id="level">
      @foreach($village as $v)
	    <option @if($v->name==$household->village) selected @endif value="{{ $v->name }}" >&nbsp;&nbsp;{{ $v->name }}</option>
      @endforeach
        </select>
        </td>
      </tr>
      
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">&nbsp;</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input name="" type="submit" value="修改" class="text-but">
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