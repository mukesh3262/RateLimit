<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RateLimitController extends Controller
{
    public function rateLimit(Request $request)
    {
        $ip = $request->ip();
        $key = 'session_' . $ip;

        if (Cache::has($key)) {
            $message = 'Previous sessions in progress...';
        }else{
            // Store the session in cache with a TTL (time to live)
            Cache::put($key, true, now()->addSeconds(60));
            $message = 'New session started';
        }

        return view('ratelimit')->with(['message' => $message]);
    }

    public function closePreviousSession(Request $request)
    {
        $ip = $request->ip();
        $key = 'session_' . $ip;

        // Remove the session from cache
        Cache::forget($key);
        return response()->json(['message' => 'Previous session closed successfully']);
    }
}
