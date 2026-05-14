<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Setting;

class CheckAccessTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $setting = Setting::where('key', 'access_time')->first();
        if ($setting) {
            $currentTime = now();
    
            if ($currentTime->lt($setting->access_start) || $currentTime->gt($setting->access_end)) {
                return response()->view('errors.access_restricted');
            }
        }
    
        return $next($request);
    }
    
}
