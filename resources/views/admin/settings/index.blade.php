{{-- FILE: resources/views/admin/settings/index.blade.php (GANTI) --}}
@extends('layouts.admin')
@section('page_title', 'Pengaturan')

@section('content')
<div style="margin-bottom:20px;">
    <h1 style="font-size:1.2rem;font-weight:800;color:var(--ink);">Pengaturan Website</h1>
    <p style="font-size:.78rem;color:var(--muted);margin-top:2px;">Kelola semua pengaturan CMS dari sini</p>
</div>

<div class="section-tabs" id="settingTabs">
    <button class="stab active" onclick="switchTab('umum',this)">🏠 Umum</button>
    <button class="stab" onclick="switchTab('kontak',this)">📞 Kontak</button>
    <button class="stab" onclick="switchTab('hero',this)">🖼️ Hero</button>
    <button class="stab" onclick="switchTab('seo',this)">🔍 SEO</button>
    <button class="stab" onclick="switchTab('pixel',this)" id="tab-pixel-btn">📊 Pixel & GTM</button>
    <button class="stab" onclick="switchTab('toko',this)">🛒 Toko Online</button>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    {{-- ===== UMUM ===== --}}
    <div class="section-group active" id="tab-umum">
        <div class="card">
            <div class="card-header"><div class="card-title">🏠 Informasi Umum</div></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Nama Website</label>
                    <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi Singkat</label>
                    <textarea name="site_description" class="form-control">{{ $settings['site_description'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Jam Operasional</label>
                    <input type="text" name="hours" class="form-control" value="{{ $settings['hours'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Pelacak Pengunjung</label>
                    <select name="visitor_tracking" class="form-control">
                        <option value="1" {{ ($settings['visitor_tracking'] ?? '1') == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ ($settings['visitor_tracking'] ?? '1') == '0' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== KONTAK ===== --}}
    <div class="section-group" id="tab-kontak">
        <div class="card">
            <div class="card-header"><div class="card-title">📞 Informasi Kontak</div></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Alamat</label>
                    <textarea name="address" class="form-control">{{ $settings['address'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="phone" class="form-control" value="{{ $settings['phone'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Nomor WhatsApp <span style="color:var(--muted);font-weight:400;">(tanpa +, contoh: 6281234567890)</span></label>
                    <input type="text" name="wa_number" class="form-control" value="{{ $settings['wa_number'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $settings['email'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Google Maps Embed URL</label>
                    <textarea name="maps_embed" class="form-control" style="min-height:60px;">{{ $settings['maps_embed'] ?? '' }}</textarea>
                    <div style="font-size:.72rem;color:var(--muted);margin-top:4px;">Paste URL dari Google Maps → Share → Embed</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== HERO ===== --}}
    <div class="section-group" id="tab-hero">
        <div class="card">
            <div class="card-header"><div class="card-title">🖼️ Banner Hero</div></div>
            <div class="card-body">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;" class="banner-grid">
                    <div class="form-group">
                        <label class="form-label">Banner Desktop</label>
                        @if(!empty($settings['banner_desktop']))
                            <img src="{{ Storage::url($settings['banner_desktop']) }}" style="width:100%;height:80px;object-fit:cover;border-radius:8px;margin-bottom:8px;border:1px solid var(--faint);">
                        @endif
                        <input type="file" name="banner_desktop" class="form-control" accept="image/*">
                        <div style="font-size:.72rem;color:var(--muted);margin-top:4px;">Landscape, min 1200×400px</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Banner Mobile</label>
                        @if(!empty($settings['banner_mobile']))
                            <img src="{{ Storage::url($settings['banner_mobile']) }}" style="width:100%;height:80px;object-fit:cover;border-radius:8px;margin-bottom:8px;border:1px solid var(--faint);">
                        @endif
                        <input type="file" name="banner_mobile" class="form-control" accept="image/*">
                        <div style="font-size:.72rem;color:var(--muted);margin-top:4px;">Portrait, max 768px wide</div>
                    </div>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="form-group">
                        <label class="form-label">Transparansi Overlay <span style="color:var(--muted);font-weight:400;">(0.1 – 1.0)</span></label>
                        <input type="number" name="banner_opacity" class="form-control" value="{{ $settings['banner_opacity'] ?? '0.5' }}" min="0.1" max="1" step="0.05">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Posisi Banner</label>
                        <select name="banner_position" class="form-control">
                            @foreach(['center center','top center','bottom center','center left','center right'] as $pos)
                            <option value="{{ $pos }}" {{ ($settings['banner_position'] ?? 'center center') === $pos ? 'selected' : '' }}>{{ $pos }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Judul Hero</label>
                    <input type="text" name="hero_title" class="form-control" value="{{ $settings['hero_title'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Subtitle Hero</label>
                    <input type="text" name="hero_subtitle" class="form-control" value="{{ $settings['hero_subtitle'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi Hero</label>
                    <textarea name="hero_desc" class="form-control">{{ $settings['hero_desc'] ?? '' }}</textarea>
                </div>
                <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;">
                    @foreach(['stat_categories'=>'Kategori','stat_products'=>'Produk','stat_years'=>'Tahun','stat_customers'=>'Pelanggan'] as $key => $label)
                    <div class="form-group">
                        <label class="form-label">{{ $label }}</label>
                        <input type="text" name="{{ $key }}" class="form-control" value="{{ $settings[$key] ?? '' }}">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- ===== SEO ===== --}}
    <div class="section-group" id="tab-seo">
        <div class="card">
            <div class="card-header"><div class="card-title">🔍 SEO & Meta Tags</div></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">SEO Title <span style="color:var(--muted);font-weight:400;">(maks 60 karakter)</span></label>
                    <input type="text" name="seo_title" class="form-control" value="{{ $settings['seo_title'] ?? '' }}" maxlength="60">
                </div>
                <div class="form-group">
                    <label class="form-label">Meta Description <span style="color:var(--muted);font-weight:400;">(maks 160 karakter)</span></label>
                    <textarea name="seo_description" class="form-control" maxlength="160">{{ $settings['seo_description'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Keywords <span style="color:var(--muted);font-weight:400;">(pisahkan dengan koma)</span></label>
                    <input type="text" name="seo_keywords" class="form-control" value="{{ $settings['seo_keywords'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="form-label">OG Image <span style="color:var(--muted);font-weight:400;">(1200×630px, untuk share sosmed)</span></label>
                    @if(!empty($settings['og_image']))
                        <img src="{{ Storage::url($settings['og_image']) }}" style="width:100%;max-width:300px;height:80px;object-fit:cover;border-radius:8px;margin-bottom:8px;display:block;border:1px solid var(--faint);">
                    @endif
                    <input type="file" name="og_image" class="form-control" accept="image/*">
                </div>
            </div>
        </div>
    </div>

    {{-- ===== PIXEL & GTM ===== --}}
    <div class="section-group" id="tab-pixel">
        <div class="card">
            <div class="card-header"><div class="card-title">📊 Meta Pixel & Google Tag Manager</div></div>
            <div class="card-body">
                <div style="background:var(--bg);border-radius:8px;padding:14px;margin-bottom:20px;font-size:.8rem;color:var(--muted);line-height:1.6;">
                    💡 Isi salah satu atau keduanya. Kode akan otomatis diinjeksi ke semua halaman website.
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Meta Pixel ID
                        <span style="font-weight:400;color:var(--muted);">(hanya angkanya, contoh: 1234567890123456)</span>
                    </label>
                    <input type="text" name="meta_pixel_id" class="form-control"
                           value="{{ $settings['meta_pixel_id'] ?? '' }}"
                           placeholder="1234567890123456">
                    @if(!empty($settings['meta_pixel_id']))
                        <div style="margin-top:6px;">
                            <span class="badge badge-green">✓ Aktif</span>
                            <span style="font-size:.72rem;color:var(--muted);margin-left:6px;">Pixel ID: {{ $settings['meta_pixel_id'] }}</span>
                        </div>
                    @endif
                </div>

                <div class="form-group" style="margin-top:20px;">
                    <label class="form-label">
                        Google Tag Manager ID
                        <span style="font-weight:400;color:var(--muted);">(contoh: GTM-XXXXXXX)</span>
                    </label>
                    <input type="text" name="gtm_id" class="form-control"
                           value="{{ $settings['gtm_id'] ?? '' }}"
                           placeholder="GTM-XXXXXXX">
                    @if(!empty($settings['gtm_id']))
                        <div style="margin-top:6px;">
                            <span class="badge badge-green">✓ Aktif</span>
                            <span style="font-size:.72rem;color:var(--muted);margin-left:6px;">GTM ID: {{ $settings['gtm_id'] }}</span>
                        </div>
                    @endif
                </div>

                <div style="background:#DBEAFE;border-radius:8px;padding:14px;margin-top:8px;font-size:.78rem;color:#1D4ED8;line-height:1.7;">
                    <strong>Cara mendapatkan ID:</strong><br>
                    • Meta Pixel: <a href="https://business.facebook.com/events_manager" target="_blank" style="color:#1D4ED8;">business.facebook.com/events_manager</a> → Pixels → ID angka<br>
                    • GTM: <a href="https://tagmanager.google.com" target="_blank" style="color:#1D4ED8;">tagmanager.google.com</a> → Container ID (GTM-XXXXX)
                </div>
            </div>
        </div>
    </div>

    {{-- ===== TOKO ONLINE ===== --}}
    <div class="section-group" id="tab-toko">
        <div class="card">
            <div class="card-header"><div class="card-title">🛒 Link Toko Online</div></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">URL Tokopedia</label>
                    <input type="url" name="tokped_url" class="form-control" value="{{ $settings['tokped_url'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="form-label">URL Shopee</label>
                    <input type="url" name="shopee_url" class="form-control" value="{{ $settings['shopee_url'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="form-label">URL TikTok Shop</label>
                    <input type="url" name="tiktok_url" class="form-control" value="{{ $settings['tiktok_url'] ?? '' }}">
                </div>
            </div>
        </div>
    </div>

    <div style="position:sticky;bottom:0;background:var(--bg);padding:14px 0;border-top:1px solid var(--faint);margin-top:8px;">
        <button type="submit" class="btn btn-primary">💾 Simpan Semua Pengaturan</button>
    </div>
</form>

@push('scripts')
<script>
function switchTab(name, el) {
    document.querySelectorAll('.section-group').forEach(g => g.classList.remove('active'));
    document.querySelectorAll('.stab').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + name).classList.add('active');
    el.classList.add('active');
}
// Auto-open pixel tab if hash in URL
if(window.location.hash === '#tab-pixel') {
    document.querySelector('[onclick*="pixel"]').click();
}
</script>
@endpush
@endsection
