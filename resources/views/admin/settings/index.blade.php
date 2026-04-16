{{-- ============================================================ --}}
{{-- FILE: resources/views/admin/settings/index.blade.php  (GANTI) --}}
{{-- ============================================================ --}}
@extends('layouts.admin')

@section('page_title', 'Pengaturan')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Pengaturan Website</div>
    </div>
    <div class="card-body">

        @php
        $groupLabels = [
            'general'     => '🏪 Umum',
            'hero'        => '✏️ Hero',
            'stats'       => '📊 Statistik',
            'contact'     => '📞 Kontak',
            'marketplace' => '🛒 Marketplace',
            'banner'      => '🖼️ Banner Hero',
            'seo'         => '🔍 SEO',
        ];
        $groupOrder = ['general','hero','stats','contact','marketplace','banner','seo'];
        uksort($settings, fn($a,$b) => array_search($a, $groupOrder) - array_search($b, $groupOrder));
        @endphp

        {{-- Tabs --}}
        <div class="section-tabs" id="tabs">
            @foreach($settings as $group => $items)
            <button class="stab {{ $loop->first ? 'active' : '' }}" onclick="switchTab('{{ $group }}')">
                {{ $groupLabels[$group] ?? ucfirst($group) }}
            </button>
            @endforeach
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @foreach($settings as $group => $items)
            <div class="section-group {{ $loop->first ? 'active' : '' }}" id="tab-{{ $group }}">

                {{-- Banner group: tampilkan preview + upload --}}
                @if($group === 'banner')
                <div style="background:#FEF3C7;border:1px solid #FDE68A;border-radius:10px;padding:14px 16px;margin-bottom:20px;font-size:.82rem;color:#92400E;">
                    💡 <strong>Tips Banner:</strong> Upload dua banner terpisah untuk tampilan optimal.
                    <br>• <strong>Desktop</strong>: landscape, min 1200×400px (JPG/PNG/WebP, maks 5MB)
                    <br>• <strong>Mobile</strong>: portrait/square, max 768×600px (JPG/PNG/WebP, maks 5MB)
                    <br>• Atur <strong>Transparansi</strong> (0.1 = tipis, 1.0 = solid). Default: 0.5
                </div>

                @foreach($items as $setting)
                <div class="form-group">
                    <label class="form-label">{{ $setting['label'] }}</label>
                    @if(in_array($setting['key'], ['banner_desktop', 'banner_mobile', 'og_image']))
                        {{-- Image Upload Field --}}
                        @if(!empty($setting['value']))
                        <div style="margin-bottom:10px;">
                            <img src="{{ Storage::url($setting['value']) }}" alt="" style="max-width:100%;max-height:200px;border-radius:8px;border:1px solid #E5E7EB;object-fit:cover;">
                            <div style="font-size:.7rem;color:#6B7280;margin-top:4px;">
                                ✅ Gambar aktif. Upload baru untuk mengganti.
                            </div>
                        </div>
                        @else
                        <div style="background:#F9FAFB;border:2px dashed #D1D5DB;border-radius:8px;padding:20px;text-align:center;margin-bottom:10px;font-size:.78rem;color:#9CA3AF;">
                            {{ $setting['key'] === 'banner_desktop' ? '🖥️ Belum ada banner desktop' : ($setting['key'] === 'banner_mobile' ? '📱 Belum ada banner mobile' : '🖼️ Belum ada gambar') }}
                        </div>
                        @endif
                        <input type="file" name="{{ $setting['key'] }}" class="form-control" accept="image/jpeg,image/png,image/webp">
                        <small style="color:#9CA3AF;font-size:.7rem;">JPG, PNG, atau WebP. Maks 5MB.</small>
                    @else
                        <input type="text" name="{{ $setting['key'] }}" class="form-control" value="{{ $setting['value'] }}">
                    @endif
                    <small style="color:#D1D5DB;font-size:.62rem;margin-top:2px;display:block;">key: {{ $setting['key'] }}</small>
                </div>
                @endforeach

                {{-- SEO group --}}
                @elseif($group === 'seo')
                <div style="background:#EFF6FF;border:1px solid #BFDBFE;border-radius:10px;padding:14px 16px;margin-bottom:20px;font-size:.82rem;color:#1E40AF;">
                    🔍 <strong>Tips SEO:</strong> Title maks 60 karakter, Description maks 160 karakter.
                    Open Graph Image idealnya 1200×630px untuk share di sosial media.
                </div>
                @foreach($items as $setting)
                <div class="form-group">
                    <label class="form-label">{{ $setting['label'] }}</label>
                    @if($setting['key'] === 'og_image')
                        @if(!empty($setting['value']))
                        <div style="margin-bottom:8px;">
                            <img src="{{ Storage::url($setting['value']) }}" alt="" style="max-width:300px;border-radius:8px;border:1px solid #E5E7EB;">
                            <div style="font-size:.7rem;color:#6B7280;margin-top:4px;">✅ Gambar OG aktif.</div>
                        </div>
                        @endif
                        <input type="file" name="{{ $setting['key'] }}" class="form-control" accept="image/jpeg,image/png,image/webp">
                        <small style="color:#9CA3AF;font-size:.7rem;">Ideal: 1200×630px. JPG/PNG/WebP, maks 5MB.</small>
                    @elseif($setting['type'] === 'textarea')
                        <textarea name="{{ $setting['key'] }}" class="form-control" rows="3">{{ $setting['value'] }}</textarea>
                    @else
                        <input type="text" name="{{ $setting['key'] }}" class="form-control" value="{{ $setting['value'] }}">
                    @endif
                </div>
                @endforeach

                {{-- Other groups --}}
                @else
                @foreach($items as $setting)
                <div class="form-group">
                    <label class="form-label">{{ $setting['label'] ?? $setting['key'] }}</label>
                    @if($setting['type'] === 'textarea')
                        <textarea name="{{ $setting['key'] }}" class="form-control" rows="3">{{ $setting['value'] }}</textarea>
                    @else
                        <input type="text" name="{{ $setting['key'] }}" class="form-control" value="{{ $setting['value'] }}">
                    @endif
                </div>
                @endforeach
                @endif

            </div>
            @endforeach

            <div style="border-top:1px solid #E5E7EB;padding-top:16px;margin-top:8px;">
                <button type="submit" class="btn btn-primary">💾 Simpan Semua Pengaturan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function switchTab(group) {
    document.querySelectorAll('.stab').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.section-group').forEach(s => s.classList.remove('active'));
    document.querySelector(`[onclick="switchTab('${group}')"]`).classList.add('active');
    document.getElementById('tab-' + group).classList.add('active');
}
</script>
@endpush
