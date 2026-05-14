<?php

namespace App\Http\Controllers;

use App\Notifications\Notifs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotifsController extends Controller
{
    public function index()
    {
        // Ambil notifikasi yang belum dibaca dari pengguna yang sedang login
        // $unreadNotifications = Auth::user()->unreadNotifications;

        // // Kirim data ke view
        return view('notifikasi');
    }

    public function getNotifications()
    {
        $notifications = DB::table('notifications')->orderBy('created_at', 'desc')->get();
        return response()->json($notifications);
    }

    public function markAsRead($id)
    {
        if ($id) {
            // Update kolom read_at untuk notifikasi tertentu
            DB::table('notifications')
                ->where('id', $id)
                ->update(['is_read' => true]);
        }
        return back();
    }
}
