<?php

namespace App\Exports;

use App\Model\Household;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;
class HouseExport implements FromView
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     // return House::all();
    //     // return House::
    // }
    public function view(): View
    {
        // 本月房租
        $month = DB::table('rent')
                    ->where('date','like',date('Y-m'))
                    ->where('state','=','1')
                    ->sum('money');
        // 本年房租
        $year = DB::table('rent')
                    ->where('date','like',date('Y').'%')
                    ->where('state','=','1')
                    ->sum('money');
        // 本月退租
        $contractMonth = DB::table('households')
                    ->where('updated_at','like',date('Y-m').'%')
                    ->where('address','=','')
                    ->where('village','=','')
                    ->sum('contract');
        // 本年退租
        $contractYear = DB::table('households')
                    ->where('updated_at','like',date('Y').'%')
                    ->where('address','=','')
                    ->where('village','=','')
                    ->sum('contract');
        // 月合计
        $monthTotal = $month-$contractMonth;
        // 年合计
        $yearTotal = $year-$contractYear;
        return view('admin.table.table', [
            'month' => $month,
            'year' => $year,
            'contractMonth'=>$contractMonth,
            'contractYear'=>$contractYear,
            'monthTotal' => $monthTotal,
            'yearTotal'  => $yearTotal,
        ]);
    }
}
