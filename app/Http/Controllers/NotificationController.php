<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\helpers;
use App\Models\Notification;
use App\Models\AdminUser;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function index(){
        $notis = Notification::latest()->get();
        // dd($notis);
       
        foreach($notis as $noti){
            $notifier = AdminUser::find($noti->user_id)->name;
            $notifier_photo = AdminUser::find($noti->user_id)->logo;
            // $new = AdminUser::find($noti->new_user_id)->name;

            $time = $noti->created_at->diffForHumans();

            $response[] = [
                'name' => $notifier,
                'notifier_photo' => $notifier_photo,
                'action' => $noti->action,
                'type' => $noti->type,
                'time' => $time,
                // 'new' => $new
            ];
        }
        return $response;
    }
}
