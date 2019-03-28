<?php

namespace App\Exports;

use App\Model\Household;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;
class AllExport implements FromView
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {

    // }
    public function view(): View
    {
        $db = DB::select("select DATE_FORMAT(o.created_at, '%Y-%m') date,h.username,h.realname,o.real_payment,o.created_at,o.type
            from  jn_households h join jn_orders o on h.id = o.user_id where username <> '' order by date ");
        
        // return $db;
        $data = [];
        foreach ($db as $i) {
            // dump($i->id);
            if(array_key_exists($i->date, $data)) {
                $data[$i->date][] = $i;
            } else {
                $data[$i->date] = [$i];
            }
        }
        // return $data;
        
        return view('admin.table.all', [
            'data' => $data
        ]);
    }
}
