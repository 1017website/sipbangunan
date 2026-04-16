<?php
// ============================================================
// FILE: app/Models/Setting.php  (GANTI file lama)
// ============================================================
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'group', 'label', 'type'];

    // Helper cepat ambil nilai setting
    public static function getValue(string $key, string $default = ''): string
    {
        $setting = static::where('key', $key)->first();
        return $setting ? (string)$setting->value : $default;
    }

    // Ambil semua settings sebagai key => value array
    public static function allAsArray(): array
    {
        return static::pluck('value', 'key')->toArray();
    }

    // Ambil settings per group, format untuk view admin
    public static function grouped(): array
    {
        return static::orderBy('group')->orderBy('id')
            ->get()
            ->groupBy('group')
            ->map(fn($items) => $items->map(fn($s) => [
                'key'   => $s->key,
                'value' => $s->value,
                'label' => $s->label ?? $s->key,
                'type'  => $s->type ?? 'text',
            ])->values()->toArray())
            ->toArray();
    }
}
