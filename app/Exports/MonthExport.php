<?php

namespace App\Exports;

use App\Model\Household;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;
class MonthExport implements FromView
{
    use Exportable;

    public function __construct($month)
    {
        $this->month = $month;
    }
    public function view(): View
    {
        $db = DB::select("select h.username,h.realname,o.real_payment,o.created_at,o.type
        from  jn_households h join jn_orders o on h.id = o.user_id where username <> '' AND DATE_FORMAT(o.created_at,'%Y-%m') = '$this->month' order by created_at");
        
        // return $data;
        $rent = 0;
        $water = 0;
        $electric = 0;
        $property = 0;
        foreach($db as $k => $v) {
            $rent += $v->type == 'rent' ? $v->real_payment : 0;
            $water += $v->type == 'water' ? $v->real_payment : 0;
            $electric += $v->type == 'electric' ? $v->real_payment : 0;
            $property += $v->type == 'property' ? $v->real_payment : 0;
        }
        return view('admin.table.day', [
            'data' => $db,
            'rent' => $rent,
            'water'=> $water,
            'electric' => $electric,
            'property' => $property
        ]);
    }
}
