<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        $thisYear = Carbon::now()->year;
        $previousYear = Carbon::now()->subYear(1)->year;

        $thisYearInvoices = Invoice::select(
                DB::raw('ROUND(SUM(sub_total)) as sub_total'),
                DB::raw('ROUND(SUM(total)) as total'),
                DB::raw('ROUND(SUM(tax)) as tax'),
                DB::raw("(DATE_FORMAT(paid_date, '%M-%Y')) as month_year")
        )
            ->orderBy('paid_date')
            ->groupBy(DB::raw("DATE_FORMAT(paid_date, '%M-%Y')"))
            ->where('valid', 1)
            ->whereNotNull('paid_date')
            ->where(DB::raw("DATE_FORMAT(paid_date, '%Y')"), '=', $thisYear)
        ->get()
        ->toArray();

        $previousYearInvoices = Invoice::select(
            DB::raw('ROUND(SUM(sub_total)) as sub_total'),
            DB::raw('ROUND(SUM(total)) as total'),
            DB::raw('ROUND(SUM(tax)) as tax'),
            DB::raw("(DATE_FORMAT(paid_date, '%M-%Y')) as month_year")
        )
            ->orderBy('paid_date')
            ->groupBy(DB::raw("DATE_FORMAT(paid_date, '%M-%Y')"))
            ->where('valid', 1)
            ->whereNotNull('paid_date')
            ->where(DB::raw("DATE_FORMAT(paid_date, '%Y')"), '=', $previousYear)
            ->get()
            ->toArray();

        return view('pages.dashboard.sales', [
            'title'                 => 'Webout Sales',
            'thisYearInvoices'      => $thisYearInvoices,
            'total'                 => array_sum(array_column($thisYearInvoices, 'total')),
            'thisYearTotalToString' => implode(',', array_column($thisYearInvoices, 'total')),
            'thisYearSubTotalToString' => implode(',', array_column($thisYearInvoices, 'sub_total')),
            'thisYearTaxToString'   => implode(',', array_column($thisYearInvoices, 'tax')),
            'previousYearTotalToString' => implode(',', array_column($previousYearInvoices, 'total'))
        ]);
    }
}
