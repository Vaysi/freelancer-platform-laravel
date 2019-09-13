<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
/*Broadcast::channel('newMessage.{target_id}.{user_id}', function ($user, $target_id,$user_id) {
    $cond = $user->hasIncommon($target_id,$user_id);
    if($cond){
        return true;
    }else {
        return false;
    }
});*/

