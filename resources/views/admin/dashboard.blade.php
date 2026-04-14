@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background:#FEF3C7;">📂</div>
        <div>
            <div class="stat-value">{{ $stats['categories'] }}</div>
            <div class="stat-label">Total Kategori</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#DBEAFE;">📦</div>
        <div>
            <div class="stat-value">{{ $stats['products'] }}</div>
            <div class="stat-label">Total Produk</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#D1FAE5;">✅</div>
        <div>
            <div class="stat-value">{{ $stats['active_products'] }}</div>
            <div class="stat-label">Produk Aktif</div>
        </div>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Aksi Cepat</div>
        </div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:10px;">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">➕ Tambah Kategori</a>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">➕ Tambah Produk</a>
            <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary">⚙️ Edit Pengaturan</a>
            <a href="{{ route('home') }}" target="_blank" class="btn btn-secondary">🌐 Lihat Website</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Info</div>
        </div>
        <div class="card-body">
            <p style="font-size:.83rem;color:#6B7280;line-height:1.7;">
                Selamat datang di CMS SIP Bangunan.<br><br>
                Gunakan menu di sidebar untuk mengelola <strong>kategori</strong>, <strong>produk</strong>, dan <strong>pengaturan</strong> website Anda.<br><br>
                Perubahan akan langsung terlihat di website frontend.
            </p>
        </div>
    </div>
</div>
@endsection
