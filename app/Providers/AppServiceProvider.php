<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // Menyediakan notifikasi ke semua tampilan yang memiliki navbar
        View::composer('*', function ($view) {
            // Ambil 5 notifikasi terbaru untuk semua pengguna
            $notifications = DB::table('notifications')
                ->orderBy('created_at', 'desc')
                // ->take(5) // Ambil 5 notifikasi terbaru
                ->get()
                ->map(function ($notification) {
                    $notification->data = json_decode($notification->data, true); // Decode JSON data
                    return $notification;
                });

            // Kirim variabel $notifications ke semua view
            $view->with('notifications', $notifications);
        });
    }
}
