<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Device;
use App\Models\ShopList;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Str;
use Hash;

class BranchRequestController extends Controller
{
    public function index(){
        $pending_shops = Shop::where('status','Pending')->get();
        $approved_shops = Shop::where('status','Approved')->get();
        $cancel_shops = Shop::where('status','Cancel')->get();

        return view('admin/branch-request', [
                "pending_shops"=>$pending_shops,
                "approved_shops"=>$approved_shops,
                "cancel_shops"=>$cancel_shops,
            ]);
        
    }

    // public function pending_shop() {

    //     $shops = Shop::all();

    //     $pending_shops = DB::table('shops')
    //                     ->where('status', '=', 'pending')
    //                     ->orderBy('id')
    //                     ->get();

    //     return view('admin/branch-request', [
    //         "pending_shops"=>$pending_shops,
    //     ]);
    // }

    public function approve_shop(request $request){

        $shop = Shop::find($request->id);
        $shop->status = "Approved";
        $shop->save();

        if($shop->save()){
            for ($x = 0; $x < 3; $x++) {
                $device = new Device;
                $device->name = "Skk001";
                $device->_token = Str::random(60);
                $device->no = $x + 1;
                $device->register_date = Carbon::now();
                $device->status = "Approved";
                $device->password = Hash::make("Skk001");
                $device->shop_id = $shop->id;
                $device->owner_id = $shop->owner_id;
                $device->save();
            }
        }
    }

    public function cancel_shop(request $request){
        
        $shop = Shop::find($request->id);
        $shop->status = "Cancel";
        $shop->save();
    }
}
