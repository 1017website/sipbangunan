<?php
// ============================================================
// FILE: app/Models/VisitorLog.php
// ============================================================
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{
    protected $fillable = ['ip_address', 'user_agent', 'page', 'referrer', 'visited_date'];

    // Hitung total pengunjung unik (by IP) hari ini
    public static function todayUnique(): int
    {
        return static::whereDate('visited_date', today())
            ->distinct('ip_address')
            ->count('ip_address');
    }

    // Hitung total hit hari ini
    public static function todayHits(): int
    {
        return static::whereDate('visited_date', today())->count();
    }

    // Total pengunjung unik keseluruhan
    public static function totalUnique(): int
    {
        return static::distinct('ip_address')->count('ip_address');
    }

    // Statistik 7 hari terakhir
    public static function last7Days(): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $data[] = [
                'date'   => now()->subDays($i)->format('d M'),
                'unique' => static::whereDate('visited_date', $date)->distinct('ip_address')->count('ip_address'),
                'hits'   => static::whereDate('visited_date', $date)->count(),
            ];
        }
        return $data;
    }
}
