<?php
//微信公众号
//微信--显示登录页
Route::get('/','weixin\LoginController@login')->name('weixin_login');
//微信--登录验证
Route::post('/','weixin\LoginController@dologin')->name('weixin_dologin');
// jwt 验证
Route::get('/jwt','weixin\LoginController@jwt')->name('jwt');
//微信--主页
Route::get('/index','weixin\IndexController@index')->name('weixin_index');
//微信--显示保修申请
Route::get('/warranty_claim','weixin\WarrantyController@index')->name('weixin_warranty_claim');
//微信--接受报修图片
Route::post('/warranty_claim','weixin\WarrantyController@getImages')->name('weixin_warranty_claim_getImages');
//微信--接收用户报修数据
Route::post('/warranty_message','weixin\WarrantyController@getMessage')->name('weixin_warranty_claim_getMessage');
//显示报修列表
Route::get('/warranty_list','weixin\WarrlistController@store')->name('weixin_warranty_list');
//报修失败
Route::get('/warranty_failed','weixin\WarrantyController@failed')->name('weixin_warranty_failed');
//显示续租
Route::get('/xuzu','weixin\XuzuController@index')->name('weixin_xuzu');
//续租申请
Route::post('/xuzu','weixin\XuzuController@store')->name('weixin_xuzu');
//显示退租
Route::get('/tuizu','weixin\TuizuController@index')->name('weixin_tuizu');
//退租申请
Route::post('/tuizu','weixin\TuizuController@store')->name('weixin_tuizu');
//显示房屋变更界面
Route::get('/fwbg','weixin\FwbgController@index')->name('weixin_fwbg');
//处理房屋变更界面
Route::post('/fwbg','weixin\FwbgController@store')->name('weixin_fwbg');
//显示合同列表
Route::get('/htlb','weixin\HtController@htlb')->name('weixin_htlb');
//显示合同详情
Route::get('/htxq/{id}','weixin\HtController@htxq')->name('weixin_htxq');
//显示手机修改
Route::get('/bindphone','weixin\BindPhoneController@index')->name('weixin_bindphone');
//操作成功跳转
Route::get('/success','weixin\SuccessController@success')->name('weixin_success');
//微信--地图
Route::get('/ditu','weixin\IndexController@ditu')->name('weixin_ditu');
//微信--小区一览
Route::get('/xiaoquyilan','weixin\IndexController@xiaoqu')->name('weixin_xiaoquyilan');
//微信--房型展示
Route::get('/fanxinzhanshi','weixin\IndexController@fanxinzhanshi')->name('weixin_fanxinzhanshi');
//微信--房型展示1
Route::get('/fanxinzhanshi1','weixin\IndexController@fanxinzhanshi1')->name('weixin_fanxinzhanshi1');
//微信--测试
Route::get('/test','weixin\TestController@index')->name('weixin_test');
// 订单页
Route::get('/order','weixin\OrderController@index')->name('order');
Route::get('/order/create','weixin\OrderController@create')->name('order.create');
Route::get('/orderSuccess','weixin\OrderController@success')->name('order.success');
Route::get('/order/test','weixin\OrderController@test')->name('order.test');
Route::post('/order/store','weixin\OrderController@store')->name('order.test');
// ajax刷新状态
Route::get('/ajaxOrder','weixin\OrderController@ajaxOrder')->name('ajaxOrder');
// 微信--支付
Route::get('/wxpay','weixin\WxpayController@pay')->name('wxpay');
Route::post('/notify','weixin\WxpayController@notify');

// 用户修改密码和找回密码
Route::get('/retrieve1', 'weixin\IndexController@retrieve1')->name('retrieve1');
Route::get('/retrieve2', 'weixin\IndexController@retrieve2')->name('retrieve2');

// 后台人口--登录页
Route::get('/admin','AdminController@admin_login')->name('admin_login');
Route::post('/admin_doLogin','AdminController@admin_doLogin')->name('admin_doLogin');

// 后台退出
Route::get('/admin_logout','AdminController@admin_logout')->name('admin_logout');
Route::middleware('adminLogin')->group(function () {
    // 报修
    Route::get('/admin/repair','RepairController@index')->name('repair.index');
    Route::get('/admin/repair/edit','RepairController@edit')->name('repair.edit');
    // 房屋图表
    Route::get('/admin/index2','AdminController@index2')->name('index');
    Route::get('/admin/show','admin\HouseController@show')->name('show');
    // 后台主页开始
    Route::get('/admin/index','AdminController@index')->name('admin_index');
    Route::get('/admin/indexTop','AdminController@indexTop');
    Route::get('/admin/indexLeft','AdminController@indexLeft');
    Route::get('/admin/indexSwich','AdminController@indexSwich');
    Route::get('/admin/indexMain','AdminController@indexMain')->name('indexMain');
    Route::get('/admin/indexBottom','AdminController@indexBottom');
    // 后台主页结束
    //变更房屋
    Route::get('/admin/house_change','HouseController@house_change')->name('house_change');
    Route::post('/admin/house_doChange','HouseController@house_doChange')->name('house_doChange');
    //查看协议
    Route::get('/admin/agreement_see','AgreementController@see')->name("agreement_see");
    Route::get('/admin/agreement_add','AgreementController@add')->name("agreement_add");
    Route::post('/admin/agreement_store','AgreementController@store')->name("agreement_store");
    Route::get('/admin/agreement_edit/{id}','AgreementController@edit')->name("agreement_edit");
    Route::post('/admin/agreement_doEdit','AgreementController@doEdit')->name("agreement_doEdit");
    // 删除住户
    Route::get('/admin/deleteHousehold/{id}','AdminController@delHousehold')->name('deleteHousehold');

    // 录入住户
    Route::get('/admin/addHousehold','AdminController@addHousehold')->name('addHousehold');
    // 执行录入
    Route::post('admin/doaddHold','AdminController@doaddHold')->name('doaddHold');

    // 编辑住户
    Route::get('/admin/editHousehold/{id}','AdminController@editHousehold')->name('editHousehold');

    // 执行编辑
    Route::post('/admin/doeditHold/{id}','AdminController@doeditHold')->name('doeditHold');



    // 小区管理开始
    // 小区管理
    Route::get('/admin/village','AdminController@village')->name('village');

    // 删除小区
    Route::get('/admin/delVillage/{id}','AdminController@delVillage')->name('delVillage');

    // 编辑小区
    Route::get('/admin/editVillage/{id}','AdminController@editVillage')->name('editVillage');
    // 执行编辑
    Route::post('/admin/doeditVillage/{id}','AdminController@doeditVillage')->name('doeditVillage');

    // 新增小区
    Route::get('/admin/addVillage','AdminController@addVillage')->name('addVillage');
    // 执行新增
    Route::post('/admin/doaddVillage','AdminController@doaddVillage')->name('doaddVillage');
    // 小区管理结束

    // 续租退租
    // 续租开始
    Route::get('/admin/xuzu','XzTzController@xuzu')->name('xuzu');

    // 续租审核
    // 审核通过
    Route::get('/admin/xzStateY/{id}','XzTzController@xzStateY')->name('xzStateY');
    // 审核不通过
    Route::get('/admin/xzStateN/{id}','XzTzController@xzStateN')->name('xzStateN');

    // 删除续租
    Route::get('/admin/del_xuzu/{id}','XzTzController@del_xuzu')->name('del_xuzu');

    // 编辑续租
    Route::get('/admin/edit_xuzu/{id}','XzTzController@edit_xuzu')->name('edit_xuzu');
    // 执行编辑
    Route::post('/admin/doeditXuzu/{id}','XzTzController@doeditXuzu')->name('doeditXuzu');

    // 添加续租
    Route::get('/admin/add_xuzu','XzTzController@add_xuzu')->name('add_xuzu');
    // 执行添加
    Route::post('/admin/doAdd_xuzu','XzTzController@doAdd_xuzu')->name('doAdd_xuzu');
    // 续租结束

    // 退租开始
    Route::get('/admin/tuizu','XzTzController@tuizu')->name('tuizu');

    // 退租审核
    // 审核通过
    Route::get('/admin/tzStateY/{id}','XzTzController@tzStateY')->name('tzStateY');
    // 审核不通过
    Route::get('/admin/tzStateN/{id}','XzTzController@tzStateN')->name('tzStateN');

    // 删除退租
    Route::get('/admin/del_tuizu/{id}','XzTzController@del_tuizu')->name('del_tuizu');

    // 编辑退租
    Route::get('/admin/edit_tuizu/{id}','XzTzController@edit_tuizu')->name('edit_tuizu');
    // 执行编辑
    Route::post('/admin/doeditTuizu/{id}','XzTzController@doeditTuizu')->name('doeditTuizu');

    // 添加退租
    Route::get('/admin/add_tuizu','XzTzController@add_tuizu')->name('add_tuizu');
    // 执行添加
    Route::post('/admin/doAdd_tuizu','XzTzController@doAdd_tuizu')->name('doAdd_tuizu');
    // 续租结束

    // 房屋出租状态
    Route::get('/admin/house','HouseController@house')->name('house');

    // 新增房屋
    Route::get('/admin/add_house','HouseController@add_house')->name('add_house');
    // 执行新增
    Route::post('/admin/doAdd_house','HouseController@doAdd_house')->name('doAdd_house');
    Route::get('/admin/house/edit/{id}','HouseController@edit')->name('house.edit');
    Route::post('/admin/house/update','HouseController@update')->name('house.update');

    // 删除房屋
    Route::get('/admin/del_house/{id}','HouseController@del_house')->name('del_house');


    //住户信息查询
    Route::get('/admin/list_household','HouseholdController@list')->name('list_household');
    //房屋出租记录查询、
    Route::get('/admin/select_house','HouseholdController@houseSelect')->name('select_house');
    //收费管理
    Route::get('/admin/payment','admin\PayController@index')->name('payment.index');
    Route::post('/admin/payment','admin\PayController@add')->name('payment.add');
    Route::put('/admin/payment','admin\PayController@edit')->name('payment.edit');
    Route::get('/admin/payment/details', 'admin\PayController@details')->name('details');
    // 预警
    Route::get('/admin/payment/warning', 'admin\PayController@warning')->name('warning');



    //新闻添加
    Route::get('/admin/addNew','NewController@add')->name('addNew');
    Route::post('/admin/doAddNew','NewController@doAdd')->name('doAddNew');
    Route::get('/admin/editNew','NewController@edit')->name('editNew');
    Route::post('/admin/doEditNew','NewController@doEdit')->name('doEditNew');

    Route::get('/admin/queryNew','NewController@query')->name('queryNew');
    // 删除新闻
    Route::get('/admin/delNew/{id}','NewController@del')->name('delNew');
    //权限管理
    Route::get('/admin/jurList','admin\JurController@list')->name('jurList');

    Route::post('/admin/addUser','admin\JurController@add')->name('addUser');
    Route::post('/admin/editUser','admin\JurController@edit')->name('editUser');

    Route::get('/admin/delUser/{id}','admin\JurController@del')->name('delUser');

    Route::get('/admin/juris','admin\JurController@jurisList')->name('jurisList');
    Route::post('/admin/addJuris','admin\JurController@addJuris')->name("addJuris");
    Route::get('/admin/delJuris/{id}','admin\JurController@delJuris')->name('delJuris');

    // 表格审核
    Route::get('/admin/examine','ExamineController@list')->name('examineList');
    Route::post('/admin/examineEdit','ExamineController@edit')->name('examineEdit');
    Route::post('/admin/download','ExamineController@download')->name('download');

    // 房屋报表
    Route::get('/admin/form',function() {
        return view('admin.table.form');
    });
    Route::get('/admin/export','admin\ExportController@index')->name('export');
    Route::get('/admin/allPayment','admin\ExportController@all');
    Route::get('/admin/dayPayment','admin\ExportController@day');
    Route::get('/admin/monthPayment','admin\ExportController@month');
    // 确定已收费
    Route::get('/admin/fixed_charges', 'admin\PayController@fixed')->name('fixed');
    // 收费管理，用户的历史记录 params $id
    Route::get('/admin/payment/{id}', 'admin\PayController@info')->name('payment.info');

    // 手续费
    Route::resource('/admin/pound', 'admin\PoundController');
    
});

//后台2
// 中心登录
Route::get('/core','CoreController@login')->name('core_login');
Route::post('/core','CoreController@doLogin')->name('cr_doLogin');
Route::middleware('coreLogin')->group(function (){    
    // 中心首页
    Route::get('/core/main','CoreController@main')->name('cr_main');
    //催费策略定制
    Route::get('/core/tactics','CoreListController@celue_list')->name('cl_list');
    Route::post('/core/tactics','CoreListController@add_celue')->name('add_celue');
    Route::post('/core/tactics/edit','CoreListController@edit_celue')->name('edit_celue');
    Route::get('/core/tactics/del/{id}','CoreListController@del')->name('del_celue');
    Route::post('/core/tactics/release','CoreListController@release')->name('release_celue');
    //缴费情况图表
    ROute::get('/core/charts','ChartsController@main')->name('charts_main');
    //发送信息到区域
    Route::get('/core/send','CoreListController@send')->name('send_message');
    Route::post('/core/send','CoreListController@doSend')->name('doSend_message');
    //住户管理
    Route::get('/core/household','CoreListController@household_list')->name('household_list');
    Route::get('/core/ajax','CoreListController@ajax_houselhold')->name('ajax_household');
    //催缴功能
    Route::get('/core/urge','CoreListController@urgePay')->name('urgePay');

    Route::get('/core/sendSms','CoreListController@sendSms')->name('coreSendSms');

    Route::get('/core/loginout','CoreController@loginout')->name('coreLoginout');
});

