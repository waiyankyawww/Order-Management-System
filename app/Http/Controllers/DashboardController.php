<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\AdminUser;
use App\Models\Invoice;
use App\Models\Owner;
use App\Models\Shop;

class DashboardController extends Controller
{
    public function index(){

        $invoice = Invoice::all()->count();
        $admin = AdminUser::all()->count();
        $owner = Owner::all()->count()+1;

        return view('admin/dashboard', [
            'noOfInvoice'=>$invoice,
            'noOfAdmin'=>$admin,
            'noOfOwner'=>$owner,
        ]);
    }

    public function branchData(){
        $approved_shops = Shop::selectRaw('year(created_at) year, month(created_at) monthIndex, monthname(created_at) month, count(*) data')
        ->where('status','Approved')
        ->groupBy('year', 'month','monthIndex')
        ->orderBy('monthIndex', 'asc')
        ->orderBy('year', 'desc')
        ->get();
        return $approved_shops;
    }
}
