<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Owner;

class InvoiceController extends Controller
{
    public function index($id){
        $invoice = Invoice::find($id);
        $owner = Owner::find($invoice->owner_id);
        return view('admin/invoice',['invoice'=>$invoice,'owner'=>$owner]);
    }

    public function invoice_list(){
        $invoices = Invoice::All()->sortByDesc("id");
        //dd($invoices);
        return view('admin/invoice-list',['invoices'=>$invoices]);
    }
}
