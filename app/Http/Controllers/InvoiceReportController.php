<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class InvoiceReportController extends Controller
{
    public function index()
    {
        return view('reports.report_invoices');
    }

    public function reportInvoice(Request $request)
    {
//        $radioBtn = $request -> radioBtn;
        $status = $request -> type_invoice;
        $typeInvoice = $request -> type_invoice;
        $dateFrom = $request -> dateFrom;
        $dateTo = $request -> dateTo;
        $invoiceNumber = $request -> invoice_number;


//        if ($radioBtn == 1) {

            if ( $typeInvoice && $dateFrom && $dateTo ) {
                $filter = invoices::whereBetween('invoice_date', [$dateFrom, $dateTo]) -> where('status', $status) -> get();
                return view('reports.report_invoices', compact('typeInvoice', 'dateFrom', 'dateTo')) -> withDetails($filter);
            } elseif ( $typeInvoice && $dateFrom == '' && $dateTo == '' ) {
                $filter = invoices::select('*') -> where('status', $status) -> get();
                return view('reports.report_invoices', compact('typeInvoice')) -> withDetails($filter);
            } elseif ( $typeInvoice = 'حدد نوع الفواتير' && $dateFrom && $dateTo ) {
                $filter = invoices::whereBetween('invoice_date', [$dateFrom, $dateTo]) -> get();
                return view('reports.report_invoices', compact( 'dateFrom', 'dateTo')) -> withDetails($filter);
            } elseif ( $invoiceNumber ) {
                $filter = invoices::where('invoice_number', $invoiceNumber) -> get();
                return view('reports.report_invoices', compact('invoiceNumber')) -> withDetails($filter);
            } else {
                session() -> flash('error');
                return redirect('report_invoices');
            }

//        }


    }

}
