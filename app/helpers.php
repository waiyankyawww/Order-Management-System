<?php

    // delete image
    function DeleteImage($folder_path,$file_name)
    {
        if(file_exists(public_path().'/'.$folder_path.'/'.$file_name))
        {
            unlink(public_path().'/'.$folder_path.'/'.$file_name);
        }
    }

    //notification
    function pushNewNotification($action, $type, $new_user) {
        $new_notification = App\Models\Notification::create([
            'action' => $action,
            'type' => $type,
            'user_id' => Auth::id(),
            'new_user_id' => $new_user
        ]);
    }

?>