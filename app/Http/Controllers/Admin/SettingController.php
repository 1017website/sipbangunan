<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        // View butuh flat ['key' => 'value'], bukan grouped
        $settings = Setting::allAsArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $imageFields = ['banner_desktop', 'banner_mobile', 'og_image'];

        // Simpan field teks
        foreach ($request->except(['_token', '_method']) as $key => $value) {
            if (in_array($key, $imageFields)) continue;
            if (is_array($value)) continue;
            Setting::updateOrCreate(['key' => $key], ['value' => $value ?? '']);
        }

        // Handle upload gambar
        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $old = Setting::getValue($field);
                if ($old && Storage::disk('public')->exists($old)) {
                    Storage::disk('public')->delete($old);
                }

                $folder = match($field) {
                    'banner_desktop' => 'banners/desktop',
                    'banner_mobile'  => 'banners/mobile',
                    default          => 'seo',
                };

                $path = $request->file($field)->store($folder, 'public');
                Setting::updateOrCreate(['key' => $field], ['value' => $path]);
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan berhasil disimpan!');
    }
}