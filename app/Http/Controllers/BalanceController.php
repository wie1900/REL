<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Support\Facades\DB;

// Balances (year/month/other stats)
class BalanceController extends Controller
{
    // Application version
    private $ver = '2.00';

    // Home View
    public function index()
    {
        return view('start', ['ver'=>$this->ver]);
    }

    // Total balance view
    public function total()
    {
        // TOTAL QUERY has to return:
        // -> no_rev    number of revenues in the given year
        // -> no_exp    number of expenses in the given year
        // -> val_rev   value in total of revenues in the given year
        // -> val_exp   value in total of expenses in the given year
        // -> year

        $balance = DB::select(DB::raw("SELECT * from
        (SELECT
            docs.id,
            substr(docs.gen,1,4) AS y, substr(docs.gen,1,4) AS year,
            COUNT(CASE docs.doctype_id WHEN 1 THEN 1 ELSE null END) AS no_rev,
            COUNT(CASE docs.doctype_id WHEN 2 THEN 1 ELSE null END) AS no_exp,
            SUM(CASE docs.doctype_id WHEN 2 THEN val ELSE null END) AS val_exp
            FROM docs
            GROUP BY substr(docs.gen,1,4)
        ) a
        LEFT JOIN
        (SELECT
            substr(docs.gen,1,4) AS y, SUM(items.qty*items.unitprice) AS val_rev
                FROM docs
                JOIN items
                ON docs.id = items.doc_id
                GROUP BY substr(docs.gen,1,4)
        ) b
        ON a.y = b.y"));

        // for stats: number of customers/contractors
        $customers = Client::where('clienttype_id','1')->count();
        $contractors = Client::where('clienttype_id','2')->count();

        // min, max and avg sales values
        $val = DB::table('docs')
        ->join('items','docs.id','items.doc_id')
        ->select(DB::raw("sum(items.qty*items.unitprice) as val"))
        ->groupby('docs.id')
        ->get();

        $min_val = $val->min('val');
        $avg_val = $val->avg('val');
        $max_val = $val->max('val');

        return view('balances.total', ['ver'=>$this->ver,
                                       'balance'=>$balance,
                                       'customers'=>$customers,
                                       'contractors'=>$contractors,
                                       'avg_val'=>$avg_val,
                                       'min_val'=>$min_val,
                                       'max_val'=>$max_val
                                    ]);
    }

    //  Year balance view
    public function year($id)
    {
        // MAIN YEAR QUERY has to return:
        // -> no_rev    numbers of revenues in the given month of the choosen year
        // -> no_exp    numbers of expenses in the given month of the choosen year
        // -> val_rev   values in total of revenues in the given month of the choosen year
        // -> val_exp   values in total of expenses in the given month of the choosen year
        // -> month     month names of the choosen year

        $balance = DB::select(DB::raw("SELECT * FROM
        (SELECT
            docs.id,
            substr(docs.gen,1,7) AS m, substr(docs.gen,1,7) AS month,
            substr(docs.gen,1,4) AS year,
            COUNT(CASE docs.doctype_id WHEN 1 THEN 1 ELSE null END) AS no_rev,
            COUNT(CASE docs.doctype_id WHEN 2 THEN 1 ELSE null END) AS no_exp,
            SUM(CASE docs.doctype_id WHEN 2 THEN val ELSE null END) AS val_exp
            FROM docs WHERE substr(docs.gen,1,4) = '$id'
            GROUP BY substr(docs.gen,1,7)) a
        LEFT JOIN
        (SELECT
            substr(docs.gen,1,7) AS m, SUM(items.qty*items.unitprice) AS val_rev
                FROM docs
                JOIN items
                ON docs.id = items.doc_id
                GROUP BY substr(docs.gen,1,7)) b
        ON a.m = b.m
        "));

        // $years = DB::select(DB::raw("SELECT substr(gen,1,4) as yname FROM docs GROUP by substr(gen,1,4)"));
        $years = DB::table('docs')
            ->select(DB::raw("substr(gen,1,4) as yname"))
            ->groupBy(DB::raw("substr(gen,1,4)"))
            ->get();

        return view('balances.year', ['ver'=>$this->ver,
                                      'id'=>$id,
                                      'balance'=>$balance,
                                      'years'=>$years
                                    ]);
    }

    // Month balance view
    public function month($id)
    {
        // Revenues of the chosen month
        $revs = DB::table('docs')
            ->join('items','docs.id','items.doc_id')
            ->join('clients','docs.client_id','clients.id')
            ->select('docs.id as id', 'docs.name as name', 'docs.gen as gen', 'clients.shortname as client', DB::raw("SUM(items.qty*items.unitprice) as val_rev"))
            ->where('docs.doctype_id','1')
            ->where(DB::raw("substr(docs.gen,1,7)"),$id)
            ->groupBy('docs.id')
            ->get();

        // Expenses of the chosen month
        $exps = DB::table('docs')
            ->join('clients','docs.client_id','clients.id')
            ->select('docs.id as id', 'docs.name as name', 'docs.gen as gen', 'clients.shortname as client', 'docs.val as val_exp')
            ->where('docs.doctype_id','2')
            ->where(DB::raw("substr(docs.gen,1,7)"),$id)
            ->get();

        // Months of the chosen year
        $months = DB::table('docs')
            ->select(DB::raw("substr(gen,1,7) as mname"))
            ->where(DB::raw("substr(gen,1,4)"),DB::raw("substr('$id',1,4)"))
            ->groupBy(DB::raw("substr(gen,1,7)"))
            ->get();

        // years - containing revenues / expenses
        $years = DB::table('docs')
            ->select(DB::raw("substr(gen,1,4) as yname"))
            ->groupBy(DB::raw("substr(gen,1,4)"))
            ->get();

        return view('balances.month', ['ver'=>$this->ver,
                                       'id'=>$id,
                                       'revs'=>$revs,
                                       'exps'=>$exps,
                                       'months'=>$months,
                                       'years'=>$years
                                    ]);
    }
}
