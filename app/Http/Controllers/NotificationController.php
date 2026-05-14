<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        // Ambil notifikasi yang belum dibaca dari pengguna yang sedang login
        // $unreadNotifications = Auth::user()->unreadNotifications;

        // // Kirim data ke view
        // return view('notifikasi');

        $user = Auth::user();

        // Ambil notifikasi berdasarkan role_id pengguna
        // $notifications = DB::table('notifications')
        //     ->where(function ($query) use ($user) {
        //         $query->where('notifiable_id', $user->id); // Notifikasi milik user
        //         if ($user->role_id === 'staff_kemahasiswaan') {
        //             $query->orWhere('data->role_target', 'staff_kemahasiswaan'); // Tambahkan notifikasi global untuk staff
        //         }
        //     })
        //     ->orderBy('created_at', 'desc')
        //     ->get();

        // $notifications = DB::table('notifications')
        //     ->where('notifiable_id', $user->id) // Filter berdasarkan pengguna
        //     ->where(function ($query) use ($user) {
        //         // Filter notifikasi untuk mahasiswa
        //         if ($user->role_id == 'mahasiswa') {
        //             $query->where('data->role_target', 'mahasiswa'); // Hanya notifikasi untuk mahasiswa
        //         }
        //         // Filter notifikasi untuk staff
        //         elseif ($user->role_id == 'staff_kemahasiswaan') {
        //             $query->where('data->role_target', 'staff_kemahasiswaan'); // Hanya notifikasi untuk staff
        //         }
        //     })
        //     ->orderBy('created_at', 'desc')
        //     ->get();

        $notifications = DB::table('notifications')
            ->where('notifiable_id', $user->id) // Filter berdasarkan pengguna
            ->where(function ($query) use ($user) {
                if ($user->role_id == 'mahasiswa') {
                    $query->where('data->role_target', 'mahasiswa');
                } elseif ($user->role_id == 'staff_kemahasiswaan') {
                    $query->where('data->role_target', 'staff_kemahasiswaan');
                }
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notifikasi', compact('notifications'));
    }

    public function getNotifications()
    {
        $user = Auth::user();
        $notifications = DB::table('notifications')
            ->where(function ($query) use ($user) {
                $query->where('notifiable_id', $user->id);
                if ($user->role_id === 'staff_kemahasiswaan') {
                    $query->orWhere('data->role_target', 'staff_kemahasiswaan');
                }
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // $notifications = DB::table('notifications')->orderBy('created_at', 'desc')->get();
        return response()->json($notifications);
    }

    public function markAsRead($id)
    {
        if ($id) {
            // Update kolom read_at untuk notifikasi tertentu
            DB::table('notifications')
                ->where('id', $id)
                ->where('notifiable_id', Auth::id()) // Pastikan hanya notifikasi milik user yang bisa diperbarui
                ->update(['is_read' => true]);
        }
        return back();
    }
}
