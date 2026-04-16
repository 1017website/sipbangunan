<?php
// ============================================================
// FILE: database/seeders/UpdateSeeder.php
// Jalankan: php artisan db:seed --class=UpdateSeeder
// ============================================================
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateSeeder extends Seeder
{
    public function run(): void
    {
        $newSettings = [
            // === BANNER HERO ===
            // Banner Desktop (landscape, ~1920x600)
            ['key' => 'banner_desktop', 'value' => '', 'group' => 'banner', 'label' => 'Banner Desktop (JPG/PNG, ≥1200px lebar)', 'type' => 'image'],
            // Banner Mobile (portrait/square, ~768x500)
            ['key' => 'banner_mobile',  'value' => '', 'group' => 'banner', 'label' => 'Banner Mobile (JPG/PNG, ≤768px lebar)', 'type' => 'image'],
            // Opacity banner
            ['key' => 'banner_opacity', 'value' => '0.5', 'group' => 'banner', 'label' => 'Transparansi Banner (0.1–1.0)', 'type' => 'text'],
            // Posisi background
            ['key' => 'banner_position', 'value' => 'center center', 'group' => 'banner', 'label' => 'Posisi Banner (mis: center center / right top)', 'type' => 'text'],

            // === SEO ===
            ['key' => 'seo_title',       'value' => 'SIP Bangunan – Supplier Material Bangunan Terpercaya', 'group' => 'seo', 'label' => 'SEO Title (max 60 karakter)', 'type' => 'text'],
            ['key' => 'seo_description', 'value' => 'SIP Bangunan supplier bahan bangunan terpercaya: semen, besi, baja, galvalum, atap, pipa, cat. Kualitas SNI, harga bersaing, pengiriman cepat.', 'group' => 'seo', 'label' => 'SEO Meta Description (max 160 karakter)', 'type' => 'textarea'],
            ['key' => 'seo_keywords',    'value' => 'supplier bangunan, material bangunan, semen, besi baja, galvalum, atap, pipa, cat, bahan bangunan murah', 'group' => 'seo', 'label' => 'SEO Keywords (pisah koma)', 'type' => 'text'],
            ['key' => 'og_image',        'value' => '', 'group' => 'seo', 'label' => 'Open Graph Image (untuk share sosmed)', 'type' => 'image'],

            // === VISITOR ===
            ['key' => 'visitor_tracking', 'value' => '1', 'group' => 'general', 'label' => 'Aktifkan Visitor Tracking (1=ya, 0=tidak)', 'type' => 'text'],
        ];

        foreach ($newSettings as $s) {
            DB::table('settings')->updateOrInsert(
                ['key' => $s['key']],
                [
                    'key'   => $s['key'],
                    'value' => $s['value'],
                    'group' => $s['group'],
                    'label' => $s['label'] ?? $s['key'],
                    'type'  => $s['type'] ?? 'text',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $this->command->info('✅ Settings banner, SEO, dan visitor berhasil ditambahkan!');
    }
}
