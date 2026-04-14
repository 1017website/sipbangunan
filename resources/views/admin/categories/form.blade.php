@extends('layouts.admin')

@section('page_title', $category->exists ? 'Edit Kategori' : 'Tambah Kategori')

@section('content')
<div style="max-width:600px;">
    <div class="card">
        <div class="card-header">
            <div class="card-title">{{ $category->exists ? 'Edit Kategori: ' . $category->name : 'Tambah Kategori Baru' }}</div>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}" method="POST">
                @csrf
                @if($category->exists) @method('PUT') @endif

                <div class="form-group">
                    <label class="form-label">Nama Kategori *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required placeholder="cth: Semen, Besi & Baja">
                </div>

                <div class="form-group">
                    <label class="form-label">Icon (Emoji) *</label>
                    <input type="text" name="icon" class="form-control" value="{{ old('icon', $category->icon ?? '🏗️') }}" placeholder="cth: 🏗️ ⚙️ 🔩 🏠">
                    <small style="color:#6B7280;font-size:.72rem;margin-top:4px;display:block;">Gunakan emoji sebagai icon kategori</small>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" placeholder="Deskripsi singkat kategori ini...">{{ old('description', $category->description) }}</textarea>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="form-group">
                        <label class="form-label">Urutan Tampil</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $category->sort_order ?? 0) }}" min="0">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="form-check" style="margin-top:10px;">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}>
                            <label for="is_active">Aktif (tampil di website)</label>
                        </div>
                    </div>
                </div>

                <div style="display:flex;gap:10px;margin-top:8px;">
                    <button type="submit" class="btn btn-primary">💾 Simpan Kategori</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
