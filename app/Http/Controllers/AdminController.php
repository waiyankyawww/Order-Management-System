<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAdminRequest;
use App\Models\AdminUser;
use App\Models\Notification;

use DB;
use App\helpers;
use Hash;
use Auth;
use Response;


class AdminController extends Controller
{
    public function index(){
        // $owners = AdminUser::All();
        $owners = AdminUser::where('id', '!=', Auth::user()->id)->get();
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

        return view('admin/admin-list',['admins'=>$owners,
                                        'nrc_numbers'=>$nrc_numbers,
                                        'industries'=>$industries,
                                        'states'=>$states,
                                        // 'townships'=>$townships
                                    ]);
    }

    public function getTownship(Request $request){
        // dd($request->state_id);
        $state_id = $request->state_id;
        $city_and_townships = DB::table('addresses')
                                ->where('code','like',"$state_id%")
                                ->where('type', 'township')
                                ->get();

        return response()->json($city_and_townships);
    }

    public function store(StoreAdminRequest $request){

        $requestData = $request->validated();
        $requestData['password'] = Hash::make($requestData['password']);

        if ($image = $request->file('logo')) {
            $destinationPath = 'profiles/admins';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $requestData['logo'] = $profileImage;
        }

        $owner = AdminUser::Create($requestData);
        if($owner){
            pushNewNotification('created','New admin',$owner->id);
        }

        return redirect('admins')->with('success', 'Admin Created');
    }

    public function edit($owner){
        // dd($owner);
        $owner = AdminUser::find($owner);
        $nrc_numbers = DB::table('nrc_prefix')
                            ->orderBy('state_id_en')
                            ->get();

        $states = DB::table('addresses')
                            ->where('type','state')
                            ->orderBy('id')
                            ->get();

        $industries = DB::table('industries')
                            ->orderBy('id')
                            ->get();

        return view('admin/edit-admin',['admin'=>$owner,
                                        'nrc_numbers'=>$nrc_numbers,
                                        'states'=>$states,
                                        'industries'=>$industries
                                    ]);
    }

    public function update(Request $request){
        // dd($owner);
        $owner = AdminUser::findOrFail($request->id);
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
            'industry' => 'required',
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

        if($image = $request->file('logo')){
            $destinationPath = 'profiles/admins';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            if($owner->logo == ''){
                $image->move($destinationPath, $profileImage);
                $owner->logo = $profileImage;
            }
            DeleteImage($destinationPath, $owner->logo);
            $image->move($destinationPath, $profileImage);
                $owner->logo = $profileImage;

        }

        $owner->save();

        if($owner){
            pushNewNotification('edited','admin',$owner->id);
        }

        return redirect('admins')->with('success', 'Admin Edited');
    }

    public function destroy(Request $request){

        $owner = AdminUser::find($request->id);
        $owner->delete();

        if($owner->delete()){
            pushNewNotification('deleted','an admin',$owner->id);
        }
        return redirect('admins')->with('success', 'Admin is deleted');
    }

    public function getDeleteAdmin(Request $request){

        $delete_admins = AdminUser::withTrashed()->whereNotNull('deleted_at')->get();

        return $delete_admins;
    }

    public function restore($owner){
        // dd($owner);
        AdminUser::withTrashed()->find($owner)->restore();

        pushNewNotification('restored','an admin',$owner);
        return redirect('admins')->with('success', 'Admin is restored');
    }

    public function profileDetails($owner){

        $owner = AdminUser::find($owner);

        $city_and_townships =DB::table('addresses')
                        ->where('code','like',"$owner->state%")
                        ->where('type', 'township')
                        ->get();

        $city = $city_and_townships[$owner['city']];

        $owner->state = DB::table('addresses')
                        -> where('code', $owner->state)
                        -> value('name');

        $owner->city = $city->name;
        //  dd($city_and_townships[$owner['city']]);
        //  dd($owner);
        return view('admin/admin-profile',['admin' => $owner]);
    }

    public function updatePassword(request $request){

        $auth = Auth::user()->id;
        $owner = AdminUser::find($auth);
        if (Hash::check($request->password_old, $owner->password)) {
            $owner->update([
                'password' => Hash::make($request->password),
            ]);
            return $owner;
        }
        else{
            return Response::json([
                'error' => 'Wrong Old Password'
            ], 401);
        }
    }

    public function editProfile(){

        $auth = Auth::user()->id;
        $owner = AdminUser::find($auth);
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

        return view('admin/profile-edit',['admin'=>$owner,
                                        'nrc_numbers'=>$nrc_numbers,
                                        'industries'=>$industries,
                                        'states'=>$states,
                                        // 'townships'=>$townships
                                    ]);
    }

    public function updateProfile(Request $request){


        $owner = AdminUser::findOrFail(Auth::user()->id);


        $editData = $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'nrc_no' => 'required',
            'nrc_location' => 'required',
            'nrc_type' => 'required',
            'nrc_number' => 'required',
            'email' => 'required',
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

        $owner->save();

        if($owner){
            pushNewNotification('edited',' an own profile',$owner->id);
        }

        return redirect('admins')->with('success', 'Admin Edited');
    }

    public function uploadProfilePhoto(Request $request){
        $owner = AdminUser::findOrFail(Auth::user()->id);
        if ($image = $request->file('logo')) {
            $destinationPath = 'profiles/admins';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            if($owner->logo != null){
                unlink($destinationPath."/".$owner->logo);
            }
            $image->move($destinationPath, $profileImage);
            $requestData['logo'] = $profileImage;
            $owner->logo = $profileImage;
            $owner->save();
            return redirect('admin/profile-edit')->with('success', 'Admin Edited');
        }else{
            return redirect('admin/profile-edit')->with('failed', 'Admin Edited');
        }


    }
}
