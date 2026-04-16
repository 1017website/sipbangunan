<?php
// FILE: database/seeders/UpdateSeeder2.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateSeeder2 extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Pixel & GTM (kosong by default)
            'meta_pixel_id' => '',
            'gtm_id'        => '',
        ];

        foreach ($settings as $key => $value) {
            DB::table('settings')->updateOrInsert(
                ['key' => $key],
                ['key' => $key, 'value' => $value, 'group' => 'pixel', 'updated_at' => now(), 'created_at' => now()]
            );
        }
    }
}
