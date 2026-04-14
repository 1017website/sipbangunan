@extends('layouts.admin')

@section('page_title', $product->exists ? 'Edit Produk' : 'Tambah Produk')

@section('content')
<div style="max-width:800px;">
    <div class="card">
        <div class="card-header">
            <div class="card-title">{{ $product->exists ? 'Edit Produk: ' . $product->name : 'Tambah Produk Baru' }}</div>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($product->exists) @method('PUT') @endif

                {{-- Info Dasar --}}
                <div style="font-size:.7rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#6B7280;margin-bottom:14px;padding-bottom:8px;border-bottom:1px solid #E5E7EB;">Info Dasar</div>

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

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="form-group">
                        <label class="form-label">Icon (Emoji)</label>
                        <input type="text" name="icon" class="form-control" value="{{ old('icon', $product->icon ?? '📦') }}" placeholder="📦">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Spesifikasi Singkat</label>
                        <input type="text" name="spec" class="form-control" value="{{ old('spec', $product->spec) }}" placeholder="cth: Zak 40kg, Batang 12m">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Foto Produk</label>
                    @if($product->image)
                        <div style="margin-bottom:8px;">
                            <img src="{{ $product->image_url }}" style="width:80px;height:80px;object-fit:cover;border-radius:8px;border:1px solid #E5E7EB;">
                            <div style="font-size:.72rem;color:#6B7280;margin-top:4px;">Foto saat ini. Upload baru untuk mengganti.</div>
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small style="color:#6B7280;font-size:.72rem;margin-top:4px;display:block;">Maks 2MB. JPG, PNG, WebP.</small>
                </div>

                {{-- Spesifikasi Detail --}}
                <div style="font-size:.7rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#6B7280;margin:20px 0 14px;padding-bottom:8px;border-bottom:1px solid #E5E7EB;">Tabel Spesifikasi</div>

                <div class="specs-list" id="specs-list">
                    @php $specs = old('spec_keys') ? array_combine(old('spec_keys',[]), old('spec_values',[])) : ($product->specs ?? []); @endphp
                    @foreach($specs as $spec)
                    <div class="spec-row">
                        <input type="text" name="spec_keys[]" class="form-control" value="{{ is_array($spec) ? $spec[0] : array_key_first([$spec]) }}" placeholder="Nama (cth: Berat)">
                        <input type="text" name="spec_values[]" class="form-control" value="{{ is_array($spec) ? $spec[1] : $spec }}" placeholder="Nilai (cth: 40 kg)">
                        <button type="button" class="spec-remove" onclick="this.parentElement.remove()">×</button>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary btn-sm" style="margin-top:8px;" onclick="addSpec()">➕ Tambah Spesifikasi</button>

                {{-- Link Marketplace --}}
                <div style="font-size:.7rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#6B7280;margin:20px 0 14px;padding-bottom:8px;border-bottom:1px solid #E5E7EB;">Link Marketplace</div>

                <div class="form-group">
                    <label class="form-label">🛒 URL Tokopedia</label>
                    <input type="url" name="tokped_url" class="form-control" value="{{ old('tokped_url', $product->tokped_url) }}" placeholder="https://tokopedia.com/...">
                </div>
                <div class="form-group">
                    <label class="form-label">🛍 URL Shopee</label>
                    <input type="url" name="shopee_url" class="form-control" value="{{ old('shopee_url', $product->shopee_url) }}" placeholder="https://shopee.co.id/...">
                </div>
                <div class="form-group">
                    <label class="form-label">▶ URL TikTok Shop</label>
                    <input type="url" name="tiktok_url" class="form-control" value="{{ old('tiktok_url', $product->tiktok_url) }}" placeholder="https://tiktok.com/...">
                </div>
                <div class="form-group">
                    <label class="form-label">💬 Pesan WA Otomatis</label>
                    <input type="text" name="wa_text" class="form-control" value="{{ old('wa_text', $product->wa_text) }}" placeholder="Halo, saya ingin bertanya tentang ...">
                </div>

                {{-- Setting --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:8px;">
                    <div class="form-group">
                        <label class="form-label">Urutan Tampil</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $product->sort_order ?? 0) }}" min="0">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="form-check" style="margin-top:10px;">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
                            <label for="is_active">Aktif</label>
                        </div>
                    </div>
                </div>

                <div style="display:flex;gap:10px;margin-top:12px;">
                    <button type="submit" class="btn btn-primary">💾 Simpan Produk</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function addSpec() {
    const list = document.getElementById('specs-list');
    const row = document.createElement('div');
    row.className = 'spec-row';
    row.innerHTML = `
        <input type="text" name="spec_keys[]" class="form-control" placeholder="Nama (cth: Berat)">
        <input type="text" name="spec_values[]" class="form-control" placeholder="Nilai (cth: 40 kg)">
        <button type="button" class="spec-remove" onclick="this.parentElement.remove()">×</button>
    `;
    list.appendChild(row);
}
</script>
@endpush
