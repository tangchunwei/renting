<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\HouseExport;
use App\Exports\AllExport;
use App\Exports\DayExport;
use App\Exports\MonthExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
class ExportController extends Controller
{
    function index() {
        $date = date("Y-m-d");
        return Excel::download(new HouseExport, '财务报表-'.$date.'.xlsx');
    }

    public function all()
    {
        return Excel::download(new AllExport, '用户缴费情况(全).xlsx');
    }
    public function day(Request $req)
    {    
        $day = $req->day ? $req->day : date("Y-m-d");
        return Excel::download(new DayExport($day), "用户缴费情况(日报表)_$day.xlsx");
    }
    public function month(Request $req)
    {    
        $month = $req->month ? $req->month : date("Y-m");
        return Excel::download(new MonthExport($month), "用户缴费情况(月报表)_$month.xlsx");
    }

}
