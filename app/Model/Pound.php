<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pound extends Model
{
    //
    protected $table = "poundage";
    public $timestamps = false;
    public $fillable = ['toll_item','sum','remark','status'];

    public $appends = [
        'status_code'
    ];
    public function getStatusCodeAttribute()
    {
        $status = $this->attributes['status'];
        if($status == 1) {
            return '使用中';
        }else{
            return '未使用';
        }
    }
}
