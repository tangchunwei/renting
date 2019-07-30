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
#search .warning-btn {
  float:right;
  margin-top:3px;
  color: #fff;
  margin-right: 5px;
}
</style>
</head>

<body>
  <!--main_top-->
  <table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
    <tr>
      <td width="99%" align="left" valign="top">当前时间: &nbsp;&nbsp;&nbsp;
        <input type="month" id="selectMonth" value="{{$date}}" min="2018-01" />
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">

        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
          <tr>
            <td width="90%" align="left" valign="middle">
              <form>
                <span>管理员：</span>

                <input type="text" name="keyword" value="{{$req->keyword}}" class="text-word">
                <input name="" type="submit" value="查询" class="text-but">

              </form>
              
              <a href="/admin/payment/details" class="btn btn-default" style="float:right;margin-top:3px;">缴费情况</a>
              @if($warning == 0)
              <a href="{{route('warning')}}" class="btn btn-danger warning-btn">未缴纳</a>
              @endif
            </td>
          
          </tr>
        </table>
       
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        @if($errors->any())
        @foreach($errors->all() as $e)
        <span style='color:red;margin-right:20px;'>{{$e}}</span>
        @endforeach
        @endif
        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
          <tr>
            <th align="center" valign="middle" class="borderright">编号</th>
            <th align="center" valign="middle" class="borderright">住户</th>
            <th align="center" valign="middle" class="borderright">用户名</th>
            <th align="center" valign="middle" class="borderright">缴费期限</th>
            <th align="center" valign="middle" class="borderright">水费</th>
            <th align="center" valign="middle" class="borderright">电费</th>
            <th align="center" valign="middle" class="borderright">房租费</th>
            <th align="center" valign="middle" class="borderright">物业费</th>
          </tr>
          @foreach($data as $k=>$v)
          <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
            <td align="center" valign="middle" class="borderright borderbottom">{{ $v->id }}</td>
            <td align="center" valign="middle" class="borderright borderbottom">
              <a href="{{route('payment.info', ['id'=>$v->id])}}">{{ $v->realname }}</a>
            </td>
            <td align="center" valign="middle" class="borderright borderbottom">{{ $v->username }}</td>
            <td align="center" valign="middle" class="borderright borderbottom">{{ $date }}</td>
            <td align="center" valign="middle" class="borderright borderbottom">{{ $v->water }}
              @if($v->water == '')
              <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#insertPay"
                data-attribute="水费" data-id="{{$v->id}}" data-type="water">添加账单</button>
              @elseif($v->water_state ==0)
              <a href="#" class="icon" title="未缴/可修改" data-toggle="modal" data-target="#updatePay" data-attribute="水费"
                data-id="{{$v->id}}" data-type="water" data-price="{{$v->water}}"><i class="iconfont icon-bianji"></i></a>
              <a href="{{route('fixed',['id'=>$v->id,'type'=>'water'])}}" onclick="return confirm('请确定用户已经缴费了吗？')"
                class="icon" title="确定缴费">已交</a>
              @elseif($v->water_state == 1)
              已交
              @endif
            </td>
            <td align="center" valign="middle" class="borderright borderbottom">{{ $v->elec }}
              @if($v->elec == '')
              <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#insertPay"
                data-attribute="电费" data-id="{{$v->id}}" data-type="electric">添加账单</button>
              @elseif( $v->elec_state ==0)
              <a href="#" class="icon" title="未缴/可修改" data-toggle="modal" data-target="#updatePay" data-attribute="电费"
                data-id="{{$v->id}}" data-type="electric" data-price="{{$v->elec}}"><i class="iconfont icon-bianji"></i></a>
              <a href="{{route('fixed',['id'=>$v->id,'type'=>'electric'])}}" onclick="return confirm('请确定用户已经缴费了吗？')"
                class="icon" title="确定缴费"><i class="iconfont icon-xiayibu"></i></a>

              @elseif($v->elec_state ==1)
              已交
              @endif
            </td>
            <td align="center" valign="middle" class="borderright borderbottom">{{ $v->rent }}
              @if($v->rent == '' )
              <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#insertPay"
                data-attribute="房租费" data-id="{{$v->id}}" data-type="rent">添加账单</button>
              @elseif($v->rent_state ==0)
              <a href="#" class="icon" title="未缴/可修改" data-toggle="modal" data-target="#updatePay" data-attribute="房租费"
                data-id="{{$v->id}}" data-type="rent" data-price="{{$v->rent}}"><i class="iconfont icon-bianji"></i></a>
              <a href="{{route('fixed',['id'=>$v->id,'type'=>'rent'])}}" onclick="return confirm('请确定用户已经缴费了吗？')" class="icon"
                title="确定缴费"><i class="iconfont icon-shezhi"></i></a>

              @elseif($v->rent_state == 1)
              已交
              @endif
            </td>
            <td align="center" valign="middle" class="borderright borderbottom">{{ $v->prop }}
              @if($v->prop =='')
              <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#insertPay"
                data-attribute="物业费" data-id="{{$v->id}}" data-type="property">添加账单</button>
              @elseif($v->prop_state ==0)
              <a href="#" class="icon" title="未缴/可修改" data-toggle="modal" data-target="#updatePay" data-attribute="物业费"
                data-id="{{$v->id}}" data-type="property" data-price="{{$v->prop}}"><i class="iconfont icon-bianji"></i></a>
              <a href="{{route('fixed',['id'=>$v->id,'type'=>'property'])}}" onclick="return confirm('请确定用户已经缴费了吗？')"
                class="icon" title="确定缴费"><i class="iconfont icon-xiayibu"></i></a>
              @elseif($v->prop_state == 1)
              已交
              @endif
            </td>


            <td align="center" valign="middle" class="borderbottom"><span class="gray"></span>
          </tr>
          @endforeach
        </table>
      </td>
    </tr>
    <tr>
      <td align="left" style="text-align:center" valign="top" class="fenye">{{ $data->appends($req->all())->links() }}</td>
    </tr>
  </table>

  <form action="{{route('payment.add')}}" method="post">
    <div class="modal fade" id="insertPay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">添加账单</h4>
          </div>
          <div class="modal-body">

            <div class="panel-body">
              {{csrf_field()}}
              <label for="">确定金额（本月<span id="add-name"></span>）</label>
              <input type="number" name="price" id="add-price" class="form-control"> <br>
              <input type="hidden" name="id" id="add-id">
              <input type="hidden" name="type" id="add-type">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            <button type="submit" class="btn btn-primary">确认添加</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <form action="{{route('payment.edit')}}" method="post">
    <div class="modal fade" id="updatePay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">修改账单</h4>
          </div>
          <div class="modal-body">

            <div class="panel-body">
              {{csrf_field()}}
              <!-- 模拟put方式提交 -->
              <input type="hidden" name="_method" value="put">
              <label for="">确定金额（本月<span id="edit-name"></span>）</label>
              <input type="number" id="edit-price" name="price" class="form-control"> <br>
              <input type="hidden" id="edit-id" name="id">
              <input type="hidden" name="type" id="edit-type">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            <button type="submit" class="btn btn-primary">确认更改</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script>
    var btn = document.querySelectorAll('.btn-default');
    for (var i of btn) {
      i.addEventListener('click', function () {
        // 该this指向的是调用addEventListener的对象
        document.querySelector('#add-name').innerText = this.getAttribute('data-attribute');
        document.querySelector('#add-id').value = this.getAttribute('data-id');
        document.querySelector('#add-type').value = this.getAttribute('data-type');
        // alert('1');
      })
    }
    var as = document.querySelectorAll('.icon');
    for (var i of as) {
      i.addEventListener('click', function (e) {
        // 在modal中填充数据
        document.querySelector('#edit-name').innerText = this.getAttribute('data-attribute');
        document.querySelector('#edit-id').value = this.getAttribute('data-id');
        document.querySelector('#edit-type').value = this.getAttribute('data-type');
        document.querySelector('#edit-price').value = this.getAttribute('data-price');
        // e.stopPropagation();
      })
    }

    var month = document.querySelector('#selectMonth');
    month.addEventListener('change', function (e) {
      // 当时间改变后，重新刷新页面
      window.location.href = '/admin/payment?date='+this.value
    })
    
  </script>
</body>

</html>