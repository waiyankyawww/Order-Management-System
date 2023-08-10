<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;

class RechargeRequestController extends Controller
{
    public function index(){
        $owners = Owner::where('status','requested')->get();
        
        return view('admin/recharge-request',['owners'=>$owners]);
    }
     public function confirmRecharge($owner){
         $owner = Owner::findOrFail(10);
         $owner->total_amount += $owner->req_amount;
         $owner->status = 'Not Requested';
         $owner->req_amount= 0;
         $owner->save();
         
         if($owner){
            pushNewNotification('recharged ','admin',$owner->id);
        }

        return redirect()->route('recharge-request')->with('success', 'Admin recharged');
     }
}
