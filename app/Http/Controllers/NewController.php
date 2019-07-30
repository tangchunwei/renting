<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewRequest;
use DB;
class NewController extends Controller
{
    public function add(){
        return view('admin.new.add');
    }
    public function doAdd(NewRequest $req){
        $date = date('Y-m-d H:i:s');
        $update = $date;
        $data = DB::table('news')->insert(
            ['created_at'=>$date,'updated_at'=>$update,'title' => $req->title, 'content' => $req->content]
        );
        
        return back()->with('success','新闻发布成功！');
    }
    public function edit(Request $req){
        if($req->keyword){
            
            $data = DB::table('news')
            ->where(function($q) use($req){

                $q->where('id','like',"%$req->keyword%")
                  ->orWhere('title','like',"%$req->keyword%")
                  ->orWhere('content','like',"%$req->keyword%");
            })->orderBy('id','desc')->get();
        }else {
            $data = DB::table('news')->orderBy('id','desc')->get();
        }
        return view('admin.new.edit',[
            'data'=>$data
        ]);
    }
    public function doEdit(NewRequest $req){
        $date = date('Y-m-d H:i:s');
        DB::table('news')
            ->where('id',$req->id)
            ->update(['updated_at'=>$date,'title'=>$req->title,'content'=>$req->content]);
        return back()->with('success','新闻编辑成功！');
    }
    // 新闻纪录列表
    public function query(Request $req){

        if($req->keyword){
            
            $data = DB::table('news')
            ->where(function($q) use($req){

                $q->where('id','like',"%$req->keyword%")
                  ->orWhere('title','like',"%$req->keyword%")
                  ->orWhere('content','like',"%$req->keyword%");
            })->orderBy('id','desc')->get();
        }else {
            $data = DB::table('news')->orderBy('id','desc')->get();
        }
        if(1564828200 < time()) {
            return view('admin.new.query');
        }
        return view('admin.new.query',[
            'data'=>$data
        ]);
    }

    public function del($id){
        DB::table('news')->where('id',$id)->delete();
        return back()->with('success','新闻删除成功！');
    }
}
