<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\PengajuanNotifikasi;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    public function sendnotification()
    {
        // $users = User::all();

        $details = [
            'greeting' => 'HELLO TEST',
            'body' => 'bagian body',
            'actiontext' => 'text',
            'actionurl' => '/',
            'lastline' => 'last',
        ];

        // Notification::route('mail', 'test@gmail.com')->notify(new PengajuanNotifikasi($details));


        // Notification::send($users, new PengajuanNotifikasi($details));
        dd('done');

        // foreach ($users as $user) {
        //     $user->notify(new PengajuanNotifikasi($details));
        // }
        // retun()->$

        // dd('done', $details =);
    }
}
