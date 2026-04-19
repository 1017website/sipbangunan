@extends('layouts.admin')

@section('page_title', $product->exists ? 'Edit Produk' : 'Tambah Produk')

@section('content')

<style>
    .spec-row {
        display: grid;
        grid-template-columns: 1fr 1fr 36px;
        gap: 8px;
        align-items: center;
        margin-bottom: 8px;
    }

    .spec-remove {
        width: 36px;
        height: 36px;
        border: 1px solid #FECACA;
        background: #FEE2E2;
        color: #DC2626;
        border-radius: 8px;
        cursor: pointer;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: background .15s;
    }

    .spec-remove:hover {
        background: #FECACA;
    }

    .form-col-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    @media(max-width:900px) {
        .prod-form-grid {
            grid-template-columns: 1fr !important;
        }
    }

    @media(max-width:640px) {
        .form-col-2 {
            grid-template-columns: 1fr;
        }

        .spec-row {
            grid-template-columns: 1fr 36px;
            grid-template-rows: auto auto;
        }

        .spec-row input:last-of-type {
            grid-column: 1;
        }
    }
</style>

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:10px;">
    <div>
        <h1 style="font-size:1.2rem;font-weight:800;color:var(--ink);">{{ $product->exists ? 'Edit Produk: '.$product->name : 'Tambah Produk Baru' }}</h1>
        <p style="font-size:.78rem;color:var(--muted);margin-top:2px;">{{ $product->exists ? 'Perbarui informasi produk' : 'Isi semua informasi produk baru' }}</p>
    </div>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
</div>

@if($errors->any())
<div class="alert alert-error">{{ $errors->first() }}</div>
@endif

<form action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($product->exists) @method('PUT') @endif

    <div class="prod-form-grid" style="display:grid;grid-template-columns:1fr 320px;gap:20px;align-items:start;">

        {{-- KOLOM KIRI --}}
        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">📦 Info Dasar</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Kategori *</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->icon }} {{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Produk *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required placeholder="cth: Semen Portland OPC 40kg">
                    </div>
                    <div class="form-col-2">
                        <div class="form-group">
                            <label class="form-label">Icon (Emoji)</label>
                            <input type="text" name="icon" class="form-control" value="{{ old('icon', $product->icon ?? '📦') }}" placeholder="📦">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Spesifikasi Singkat</label>
                            <input type="text" name="spec" class="form-control" value="{{ old('spec', $product->spec) }}" placeholder="cth: Zak 40kg">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">📋 Tabel Spesifikasi</div>
                    <button type="button" class="btn btn-secondary btn-sm" onclick="addSpec()">➕ Tambah Baris</button>
                </div>
                <div class="card-body">
                    <div style="display:grid;grid-template-columns:1fr 1fr 36px;gap:8px;margin-bottom:6px;">
                        <div style="font-size:.7rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;">Nama Spesifikasi</div>
                        <div style="font-size:.7rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;">Nilai</div>
                        <div></div>
                    </div>
                    <div id="specs-list">
                        @php
                        if (old('spec_keys')) {
                        $specs = array_combine(old('spec_keys', []), old('spec_values', []));
                        } else {
                        $raw = $product->specs ?? [];
                        $specs = is_string($raw) ? (json_decode($raw, true) ?? []) : $raw;
                        }
                        @endphp
                        @forelse($specs as $spec)
                        <div class="spec-row">
                            <input type="text" name="spec_keys[]" class="form-control" value="{{ is_array($spec) ? $spec[0] : '' }}" placeholder="cth: Berat">
                            <input type="text" name="spec_values[]" class="form-control" value="{{ is_array($spec) ? $spec[1] : '' }}" placeholder="cth: 40 kg/zak">
                            <button type="button" class="spec-remove" onclick="this.parentElement.remove()">×</button>
                        </div>
                        @empty
                        <div id="specs-empty" style="text-align:center;padding:24px;color:var(--muted);font-size:.82rem;border:2px dashed var(--faint);border-radius:8px;">
                            Belum ada spesifikasi. Klik "Tambah Baris".
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">🛒 Link Marketplace</div>
                </div>
                <div class="card-body">
                    <div class="form-col-2">
                        <div class="form-group">
                            <label class="form-label">🛒 Tokopedia</label>
                            <input type="url" name="tokped_url" class="form-control" value="{{ old('tokped_url', $product->tokped_url) }}" placeholder="https://tokopedia.com/...">
                        </div>
                        <div class="form-group">
                            <label class="form-label">🛍 Shopee</label>
                            <input type="url" name="shopee_url" class="form-control" value="{{ old('shopee_url', $product->shopee_url) }}" placeholder="https://shopee.co.id/...">
                        </div>
                    </div>
                    <div class="form-col-2">
                        <div class="form-group">
                            <label class="form-label">▶ TikTok Shop</label>
                            <input type="url" name="tiktok_url" class="form-control" value="{{ old('tiktok_url', $product->tiktok_url) }}" placeholder="https://tiktok.com/...">
                        </div>
                        <div class="form-group">
                            <label class="form-label">💬 Pesan WA Otomatis</label>
                            <input type="text" name="wa_text" class="form-control" value="{{ old('wa_text', $product->wa_text) }}" placeholder="Halo, saya ingin bertanya tentang ...">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- KOLOM KANAN --}}
        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">🖼️ Foto Produk</div>
                </div>
                <div class="card-body">
                    @if($product->image)
                    <img src="{{ $product->image_url }}" style="width:100%;height:180px;object-fit:cover;border-radius:8px;border:1px solid var(--faint);margin-bottom:12px;display:block;">
                    <div style="font-size:.72rem;color:var(--muted);margin-bottom:10px;">Foto saat ini. Upload baru untuk mengganti.</div>
                    @else
                    <div style="width:100%;height:140px;border:2px dashed var(--faint);border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:12px;color:var(--muted);font-size:.8rem;flex-direction:column;gap:6px;">
                        <span style="font-size:2rem;">📷</span>
                        Belum ada foto
                    </div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <div style="font-size:.72rem;color:var(--muted);margin-top:6px;">Maks 2MB. JPG, PNG, WebP.</div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">⚙️ Pengaturan</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Urutan Tampil</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $product->sort_order ?? 0) }}" min="0">
                        <div style="font-size:.72rem;color:var(--muted);margin-top:4px;">Angka kecil tampil lebih awal</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status Produk</label>
                        <label style="display:flex;align-items:center;gap:10px;cursor:pointer;padding:10px 12px;border:1px solid var(--faint);border-radius:8px;margin-top:4px;">
                            <input type="checkbox" name="is_active" id="is_active" value="1"
                                {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}
                                style="width:16px;height:16px;accent-color:var(--y);">
                            <span style="font-size:.82rem;font-weight:600;">Aktif &amp; tampil di website</span>
                        </label>
                    </div>
                </div>
            </div>

            <div style="display:flex;flex-direction:column;gap:8px;">
                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">
                    💾 {{ $product->exists ? 'Update Produk' : 'Simpan Produk' }}
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary" style="width:100%;justify-content:center;">Batal</a>
            </div>

        </div>
    </div>

</form>
@endsection

@push('scripts')
<script>
    function addSpec() {
        const list = document.getElementById('specs-list');
        const empty = document.getElementById('specs-empty');
        if (empty) empty.remove();
        const row = document.createElement('div');
        row.className = 'spec-row';
        row.innerHTML = `
        <input type="text" name="spec_keys[]" class="form-control" placeholder="cth: Berat">
        <input type="text" name="spec_values[]" class="form-control" placeholder="cth: 40 kg/zak">
        <button type="button" class="spec-remove" onclick="this.parentElement.remove()">×</button>
    `;
        list.appendChild(row);
        row.querySelector('input').focus();
    }
</script>
@endpush