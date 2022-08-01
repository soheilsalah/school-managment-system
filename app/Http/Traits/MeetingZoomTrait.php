<?php

namespace App\Http\Traits;

use MacsiDigital\Zoom\Facades\Zoom;
use Carbon\Carbon;

trait MeetingZoomTrait
{
    public function createMeeting($request){

        $user = Zoom::user()->first();

        $meeting_data = [
            'topic' => $request->topic,
            'duration' => $request->duration,
            'password' => $request->z,
            'start_time' => $request->start_at,
            'timezone' => 'Africa/Cairo'
        ];

        $meeting = Zoom::meeting()->make($meeting_data);

        $meeting->settings()->make([
            'join_before_host' => false,
            'participant_video' => false,
            'mute_upon_entry' => true,
            'show_share_button' => false,
            'host_save_video_order' => false,
            'host_video' => false,
            'approval_type' => 1,
            'registration_type' => 2,
            'enforce_login' => false,
            'waiting_room' => true,
        ]);

        return $user->meetings()->save($meeting);
    }
}