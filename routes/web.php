<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test',function(){
    // echo  date("Y-m-d", strtotime("+1 months", strtotime("2010-10-06")));
    echo(strtotime("2012-11-11")/(60*60*24) . "<br>");
});


// 后台人口--登录页
Route::get('/admin','AdminController@admin_login')->name('admin_login');
Route::post('/admin_doLogin','AdminController@admin_doLogin')->name('admin_doLogin');

// 后台退出
Route::get('/admin_logout','AdminController@admin_logout')->name('admin_logout');

// 后台主页开始
Route::get('/admin/index','AdminController@index')->name('admin_index');
Route::get('/admin/indexTop','AdminController@indexTop');
Route::get('/admin/indexLeft','AdminController@indexLeft');
Route::get('/admin/indexSwich','AdminController@indexSwich');
Route::get('/admin/indexMain','AdminController@indexMain')->name('indexMain');
Route::get('/admin/indexBottom','AdminController@indexBottom');
// 后台主页结束

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

// 删除房屋
Route::get('/admin/del_house/{id}','HouseController@del_house')->name('del_house');


//微信
Route::any('/wechat', 'WechatController@serve');
Route::get('/user', function () {
    $user = session('wechat.oauth_user'); // 拿到授权用户资料
    return redirect()->to('/home#/index'); //這時候已經拿到用戶資料了，跳轉到想要的路由
});
