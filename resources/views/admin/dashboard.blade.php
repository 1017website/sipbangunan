{{-- ============================================================ --}}
{{-- FILE: resources/views/admin/dashboard.blade.php  (GANTI) --}}
{{-- ============================================================ --}}
@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('content')

{{-- Stats Cards --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px;">
    <div class="stat-card">
        <div class="stat-icon" style="background:#FEF3C7;">📂</div>
        <div><div class="stat-value">{{ $stats['categories'] }}</div><div class="stat-label">Kategori</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#DBEAFE;">📦</div>
        <div><div class="stat-value">{{ $stats['products'] }}</div><div class="stat-label">Total Produk</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#D1FAE5;">✅</div>
        <div><div class="stat-value">{{ $stats['active_products'] }}</div><div class="stat-label">Produk Aktif</div></div>
    </div>
</div>

{{-- Visitor Stats --}}
<div class="card" style="margin-bottom:24px;">
    <div class="card-header">
        <div class="card-title">👥 Statistik Pengunjung</div>
        <span style="font-size:.72rem;color:#6B7280;">Tracking otomatis aktif</span>
    </div>
    <div class="card-body">
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px;">
            <div style="background:#FEF3C7;border-radius:10px;padding:16px;text-align:center;">
                <div style="font-size:1.8rem;font-weight:800;color:#111;">{{ number_format($stats['today_unique']) }}</div>
                <div style="font-size:.72rem;color:#6B7280;margin-top:4px;">Pengunjung Unik Hari Ini</div>
            </div>
            <div style="background:#DBEAFE;border-radius:10px;padding:16px;text-align:center;">
                <div style="font-size:1.8rem;font-weight:800;color:#111;">{{ number_format($stats['today_hits']) }}</div>
                <div style="font-size:.72rem;color:#6B7280;margin-top:4px;">Total Hit Hari Ini</div>
            </div>
            <div style="background:#D1FAE5;border-radius:10px;padding:16px;text-align:center;">
                <div style="font-size:1.8rem;font-weight:800;color:#111;">{{ number_format($stats['total_unique']) }}</div>
                <div style="font-size:.72rem;color:#6B7280;margin-top:4px;">Total Pengunjung Unik</div>
            </div>
        </div>

        {{-- Chart 7 Hari --}}
        <div style="font-size:.72rem;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#9CA3AF;margin-bottom:12px;">7 Hari Terakhir</div>
        <div style="display:flex;gap:8px;align-items:flex-end;height:120px;padding:0 4px;">
            @php $maxHits = max(1, collect($chart)->max('hits')); @endphp
            @foreach($chart as $day)
            @php $h = max(4, round(($day['hits'] / $maxHits) * 100)); @endphp
            <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:4px;">
                <div style="font-size:.6rem;color:#9CA3AF;font-weight:600;">{{ $day['hits'] ?: '' }}</div>
                <div style="width:100%;background:#FBBF00;border-radius:4px 4px 0 0;height:{{ $h }}px;min-height:4px;transition:height .3s;"></div>
                <div style="font-size:.6rem;color:#6B7280;text-align:center;line-height:1.2;">{{ $day['date'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Quick Actions --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
    <div class="card">
        <div class="card-header"><div class="card-title">Aksi Cepat</div></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:10px;">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">➕ Tambah Kategori</a>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">➕ Tambah Produk</a>
            <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary">⚙️ Edit Pengaturan & Banner</a>
            <a href="{{ route('home') }}" target="_blank" class="btn btn-secondary">🌐 Lihat Website</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><div class="card-title">Info Fitur Baru</div></div>
        <div class="card-body">
            <p style="font-size:.83rem;color:#6B7280;line-height:1.8;">
                ✅ <strong>SEO</strong> – Meta title, description, keywords & Open Graph sudah aktif.<br>
                🖼️ <strong>Banner Hero</strong> – Upload banner <strong>desktop</strong> & <strong>mobile</strong> terpisah di <a href="{{ route('admin.settings.index') }}" style="color:#FBBF00;">Pengaturan → Banner</a>.<br>
                👥 <strong>Visitor Tracking</strong> – Pengunjung dicatat otomatis. Statistik tampil di dashboard ini.<br>
                🗺️ <strong>Sitemap</strong> – Akses di <code>/sitemap.xml</code>
            </p>
        </div>
    </div>
</div>
@endsection
