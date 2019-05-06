<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Pound;

class PoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pound::get();
        return view('admin.pound.index',[
            'data'=>$data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pound.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validatedData  =  $request->validate([
            'toll_item' => 'required|min:3',
            'sum' => 'required',
            'status' => 'required',
       ],[
           'toll_item.required' => '收费项不能为空',
           'sum.required' => '手续费不能为空',
           'status.required' => '状态不能为空'
       ]);
        if($request->status === '1') {
            Pound::where('status', 1)->update(['status'=> 0]);
        }
        Pound::create($request->all());
        return redirect()->route('pound.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Pound::find($id);
        return view('admin.pound.edit',[
            'data'=>$data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();if
        $request->validate([
            'toll_item' => 'required|min:3',
            'sum' => 'required',
            'status' => 'required'
        ]);
        if($request->status === '1')
        {
            Pound::where('status', 1)->update(['status'=> 1]);
        }
        $model = Pound::find($id);
        $model->toll_item = $request->toll_item;
        $model->sum = $request->sum;
        $model->remark = $request->remark;
        $model->status = $request->status;
        $model->save();
        return redirect()->route('pound.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pound::destroy($id);
        return redirect()->route('pound.index');

    }
}
