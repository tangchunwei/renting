<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理系统</title>
<link rel="shortcut icon" href="images/favicon.ico" />
<link href="/css/css.css" type="text/css" rel="stylesheet" />
</head>
<!--框架样式-->
<frameset rows="95,*,30" cols="*" frameborder="no" border="0" framespacing="0">
<!--top样式-->
	<frame src="/admin/indexTop" name="topframe" scrolling="no" noresize id="topframe" title="topframe" />
<!--contact样式-->
	<frameset id="attachucp" framespacing="0" border="0" frameborder="no" cols="194,12,*" rows="*">
		<frame scrolling="auto" noresize="" frameborder="no" name="leftFrame" src="/admin/indexLeft"></frame>
		<frame id="leftbar" scrolling="no" noresize="" name="switchFrame" src="/admin/indexSwich"></frame>
		@if(session('jurisdiction') == '新闻管理员')
		<frame scrolling="auto" noresize="" border="0" name="mainFrame" src="/admin/editNew"></frame>
		@else
		<frame scrolling="auto" noresize="" border="0" name="mainFrame" src="/admin/indexMain"></frame>
		@endif
	</frameset>
<!--bottom样式-->
	<frame src="/admin/indexBottom" name="bottomFrame" scrolling="No" noresize="noresize" id="bottomFrame" title="bottomFrame" />
</frameset><noframes></noframes>
<!--不可以删除-->
</html>