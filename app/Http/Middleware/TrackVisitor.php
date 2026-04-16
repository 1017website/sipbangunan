<?php
// ============================================================
// FILE: app/Http/Middleware/TrackVisitor.php
// ============================================================
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\VisitorLog;
use App\Models\Setting;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        // Hanya track frontend, skip admin & ajax
        if (!$request->is('admin/*') && !$request->ajax()) {

            $enabled = Setting::getValue('visitor_tracking', '1');

            if ($enabled === '1') {
                // Throttle: 1 log per IP per menit (hindari spam)
                $cacheKey = 'visitor_' . md5($request->ip() . $request->path());

                if (!cache()->has($cacheKey)) {
                    cache()->put($cacheKey, true, 60); // lock 60 detik

                    VisitorLog::create([
                        'ip_address'   => $request->ip(),
                        'user_agent'   => substr($request->userAgent() ?? '', 0, 500),
                        'page'         => '/' . ltrim($request->path(), '/'),
                        'referrer'     => substr($request->header('referer') ?? '', 0, 500),
                        'visited_date' => today(),
                    ]);
                }
            }
        }

        return $next($request);
    }
}
