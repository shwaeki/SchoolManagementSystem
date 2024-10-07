<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('test-channel', function() {
    return true;
});


// Private channel for student chat
Broadcast::channel('chat.student.{studentId}', function ($user, $studentId) {
    if (Auth::guard('web')->check()) {
        return true;
    }

    if (Auth::guard('teacher')->check()) {
        return true;
    }

    return Auth::check() && $user->id === (int) $studentId;
});



Broadcast::channel('chat.student.{studentId}', function ($user, $studentId) {
    if (Auth::guard('web')->check()) {
        return true;
    } elseif (Auth::guard('teacher')->check()) {
        return $user->isTeacherOfStudent($studentId);
    } elseif (Auth::guard('parent')->check()) {
        return  $user->id === (int) $studentId;
    }
    return false;
});



Broadcast::channel('chat.class.{classId}', function ($user, $yearClassId) {
    if (Auth::guard('web')->check()) {
        return true;
    } elseif (Auth::guard('teacher')->check()) {
        return  $user->isTeacherOfClass($yearClassId);
    }elseif (Auth::guard('parent')->check()) {
        return  $user->isStudentOfClass($yearClassId);
    }
    return false;
});
