<?php
// ============================================================
// FILE: app/Http/Controllers/Admin/SettingController.php  (GANTI)
// ============================================================
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::grouped();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $imageFields = ['banner_desktop', 'banner_mobile', 'og_image'];

        foreach ($request->except(['_token']) as $key => $value) {
            if (is_array($value)) continue;

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value ?? '']
            );
        }

        // Handle image uploads untuk banner & og_image
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);

                // Validasi
                $file->validate(['mimes:jpg,jpeg,png,webp', 'max:5120']);

                // Hapus file lama jika ada
                $old = Setting::getValue($field);
                if ($old && Storage::disk('public')->exists($old)) {
                    Storage::disk('public')->delete($old);
                }

                // Simpan file baru
                $folder = match($field) {
                    'banner_desktop' => 'banners/desktop',
                    'banner_mobile'  => 'banners/mobile',
                    default          => 'seo',
                };

                $path = $file->store($folder, 'public');

                Setting::updateOrCreate(
                    ['key' => $field],
                    ['value' => $path]
                );
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan berhasil disimpan!');
    }
}
