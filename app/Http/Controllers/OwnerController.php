<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreOwnerRequest;
use App\Models\Owner;
use App\Models\Invoice;
use DB;
use Hash;
use Auth;

class OwnerController extends Controller
{
    
    public function index(){
        $owners = Owner::all();
        $nrc_numbers = DB::table('nrc_prefix')
                            ->orderBy('state_id_en')
                            ->get();

        $industries = DB::table('industries')
                            ->orderBy('id')
                            ->get();

        $states = DB::table('addresses')
                            ->where('type','state') 
                            ->orderBy('id')
                            ->get(); 
        
        return view('admin/owner-list',['owners'=>$owners,
                                        'nrc_numbers'=>$nrc_numbers,
                                        'industries'=>$industries,
                                        'states'=>$states,]);
    }

    public function getTownship(Request $request){
        
        $state_id = $request->state_id;
        $city_and_townships = DB::table('addresses')
                                ->where('code','like',"$state_id%")
                                ->where('type', 'township')
                                ->get();
        
        return response()->json($city_and_townships);
    }

    public function store(StoreOwnerRequest $request){

        $requestData = $request->validated();
         //dd($requestData);
        // $ammount = explode(" ",$requestData->ammount);
        // $tax_ammount = explode(" ",$requestData->tax);
        // $total_ammount = explode(" ",$requestData->total_ammount);
        
        $add_owner = new Owner;
        $add_owner->name = $requestData['confirm_owner_name'];
        $add_owner->_token = $requestData['_token'];
        $add_owner->phone_number = $requestData['confirm_phone_number'];
        $add_owner->nrc_no = $requestData['confirm_nrc_no'];
        $add_owner->nrc_location = $requestData['confirm_nrc_location'];
        $add_owner->nrc_type = $requestData['confirm_nrc_type'];
        $add_owner->nrc_number = $requestData['confirm_nrc_number'];
        $add_owner->email = $requestData['confirm_email'];
        $add_owner->password = Hash::make($requestData['confirm_password']);
        $add_owner->address = $requestData['confirm_address'];
        $add_owner->city = $requestData['confirm_city'];
        $add_owner->state = $requestData['confirm_state'];
        $add_owner->org_name = $requestData['confirm_org_name'];
        $add_owner->industry = $requestData['confirm_industry'];
        $add_owner->main_address = $requestData['confirm_main_address'];
        $add_owner->amount = $requestData['ammount'];
        $add_owner->tax = $requestData['tax'];;
        $add_owner->total_amount =$requestData['total_ammount'];
        $add_owner->created_by = Auth::user()->name;

        if ($image = $request->file('confirm_logo')) {
            $destinationPath = 'profiles/owners';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $add_owner->logo = $profileImage;
            
        }

        $add_owner->save();

        if($add_owner->save()){
            $invoice = new Invoice;
            $invoice->owner_id = $add_owner->id;
            $invoice->amount = $add_owner->ammount;
            $invoice->status = "Approved";
            $invoice->type = "Owner";
            $invoice->save();
        
            $update_owner = Owner::find($add_owner->id);
            $update_owner->invoice_id = $invoice->id;
            $update_owner->save();
        }

        if($update_owner->save()){
            pushNewNotification('created','a new owner',$update_owner->id);
        }

        return redirect('owners')->with('success', 'Owner Created');
    }

    public function edit($owner){
        // dd($owner);
        $owner = Owner::find($owner);
        $nrc_numbers = DB::table('nrc_prefix')
                            ->orderBy('state_id_en')
                            ->get();

        return view('admin/edit-owner',['owner'=>$owner,'nrc_numbers'=>$nrc_numbers]);
    }

    public function update(Request $request){
        // dd($owner);
        $owner = Owner::findOrFail($request->id);
        $editData = $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'nrc_no' => 'required',
            'nrc_location' => 'required',
            'nrc_type' => 'required',
            'nrc_number' => 'required',
            'email' => 'required',
            //'password' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'org_name' => 'required',
            // 'industry' => 'required',
            'main_address' => 'required',
        ]);
        

        $owner->name = $editData['name'];
        $owner->phone_number = $editData['phone_number'];
        $owner->nrc_no = $editData['nrc_no'];
        $owner->nrc_location = $editData['nrc_location'];
        $owner->nrc_type = $editData['nrc_type'];
        $owner->nrc_number = $editData['nrc_number'];
        $owner->email = $editData['email'];
        $owner->address = $editData['address'];
        $owner->city = $editData['city'];
        $owner->state = $editData['state'];
        $owner->org_name = $editData['org_name'];
        $owner->main_address = $editData['main_address'];

        // if($image = $request->file('logo')){
        //     $destinationPath = 'profiles/admins';
        //     $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     DeleteImage($destinationPath, $owner->logo);
        //     $image->move($destinationPath, $profileImage);
        //     $owner->logo = $profileImage;
        // }
        
        $owner->save();

        if($owner->save()){
            pushNewNotification('edited','a owner',$owner->id);
        }

        return redirect('owners')->with('success', 'Owner Edited');
    }

    public function destroy(Request $request){
        $owner = Owner::find($request->id);
        $owner->delete();

        if($owner->delete()){
            pushNewNotification('deleted','an owner',$owner->id);
        }

        return redirect('owners')->with('success', 'Owner Deleted');
    }

    public function getDeleteOwner(Request $request){
        $delete_owners = Owner::withTrashed()->whereNotNull('deleted_at')->get();
        return $delete_owners;
    }

    public function restore($owner){
        
        Owner::withTrashed()->find($owner)->restore();

        pushNewNotification('restored','an owner',$owner);
        return redirect('owners')->with('success', 'Owner is restored');
        
    }

    public function profileDetails($owner){
        $owner = Owner::find($owner);

        $city_and_townships =DB::table('addresses')
                        ->where('code','like',"$owner->state%")
                        ->where('type', 'township')
                        ->get();
       
        $city = $city_and_townships[$owner['city']];
        
        $owner->state = DB::table('addresses')
                        -> where('code', $owner->state)
                        -> value('name');
 
        $owner->city = $city->name;

        return view('admin/owner-profile',['owner' => $owner]);

    }
}
