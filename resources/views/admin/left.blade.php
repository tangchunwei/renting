<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>左侧导航menu</title>
<link href="/css/css.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/js/sdmenu.js"></script>
<script type="text/javascript">
	// <![CDATA[
	var myMenu;
	window.onload = function() {
		myMenu = new SDMenu("my_menu");
		myMenu.init();
	};
	// ]]>
</script>
<style type=text/css>
html{ SCROLLBAR-FACE-COLOR: #538ec6; SCROLLBAR-HIGHLIGHT-COLOR: #dce5f0; SCROLLBAR-SHADOW-COLOR: #2c6daa; SCROLLBAR-3DLIGHT-COLOR: #dce5f0; SCROLLBAR-ARROW-COLOR: #2c6daa;  SCROLLBAR-TRACK-COLOR: #dce5f0;  SCROLLBAR-DARKSHADOW-COLOR: #dce5f0; overflow-x:hidden;}
body{overflow-x:hidden; background:url(/images/main/leftbg.jpg) left top repeat-y #f2f0f5; width:194px;}
</style>
</head>
<body onselectstart="return false;" ondragstart="return false;" oncontextmenu="return false;">
<div id="left-top">
	<div><img src="/images/main/member.gif" width="44" height="44" /></div>
    <span>用户：{{session('name')}}<br>角色：{{session('jurisdiction')}}</span>
</div>
    <div style="float: left" id="my_menu" class="sdmenu">
    @if(session('jurisdiction') != '新闻管理员')
      <div>
        <span>住户和房屋管理</span>
        <a href="/admin/index2" target="mainFrame" onFocus="this.blur()">首页</a>
        <a href="/admin/indexMain" target="mainFrame" onFocus="this.blur()">入住管理</a>
        <a href="/admin/xuzu" target="mainFrame" onFocus="this.blur()">续租管理</a>
        <a href="/admin/tuizu" target="mainFrame" onFocus="this.blur()">退租管理</a>
        <a href="/admin/house" target="mainFrame" onFocus="this.blur()">房屋出租状态查询</a>
        <a href="/admin/house_change" target="mainFrame" onFocus="this.blur()">房屋变更</a>
        <a href="/admin/list_household" target="mainFrame" onFocus="this.blur()">住户信息查询</a>
        <a href="/admin/select_house" target="mainFrame" onFocus="this.blur()">房屋出租记录查询</a>
        <a href="/admin/village" target="mainFrame" onFocus="this.blur()">小区管理</a>
        <a href="/admin/payment" target="mainFrame" onFocus="this.blur()">收费管理</a>
        <a href="/admin/examine" target="mainFrame" onFocus="this.blur()">审核管理</a>
        <a href="/admin/repair" target="mainFrame" onFocus="this.blur()">报修管理</a>
        <a href="/admin/pound" target="mainFrame" onFocus="this.blur()">手续费管理</a>
        <a href="/admin/export">导出数据</a>
      </div>
      @endif
      @if(session('jurisdiction') != '住户和房屋管理员')
      <div class="collapsed">
        <span>新闻管理</span>
        <a href="/admin/editNew" target="mainFrame" onFocus="this.blur()">新闻编辑</a>
        <a href="/admin/addNew" target="mainFrame" onFocus="this.blur()">新闻发布</a>
        <a href="/admin/queryNew" target="mainFrame" onFocus="this.blur()">新闻记录查询</a>
      </div>
      @endif
      @if(session('jurisdiction') == '超级管理员')
      <div class="collapsed">
        <span>操作员管理</span>
        <a href="/admin/jurList" target="mainFrame" onFocus="this.blur()">设置操作员权限</a>
        <a href="/admin/juris" target="mainFrame" onFocus="this.blur()">修改管理权限</a>
        <a href="/admin/agreement_see" target="mainFrame" onFocus="this.blur()">协议管理</a>
  
      </div>
      @endif
    </div>
</body>
</html>