@extends('layouts.admin')

@section('page_title', 'Kategori')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Daftar Kategori ({{ $categories->count() }})</div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">➕ Tambah Kategori</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Icon</th>
                <th>Nama</th>
                <th>Slug</th>
                <th>Produk</th>
                <th>Urutan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $cat)
            <tr>
                <td style="font-size:1.4rem;">{{ $cat->icon }}</td>
                <td>
                    <div style="font-weight:600;">{{ $cat->name }}</div>
                    <div style="font-size:.72rem;color:#6B7280;">{{ Str::limit($cat->description, 50) }}</div>
                </td>
                <td style="color:#6B7280;font-size:.78rem;">{{ $cat->slug }}</td>
                <td>
                    <span class="badge badge-gray">{{ $cat->product_count }}</span>
                </td>
                <td>{{ $cat->sort_order }}</td>
                <td>
                    @if($cat->is_active)
                        <span class="badge badge-green">Aktif</span>
                    @else
                        <span class="badge badge-gray">Nonaktif</span>
                    @endif
                </td>
                <td>
                    <div style="display:flex;gap:6px;">
                        <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-secondary btn-sm">✏️ Edit</a>
                        <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" onsubmit="return confirm('Hapus kategori ini? Semua produk di dalamnya juga akan terhapus!')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;color:#6B7280;padding:40px;">Belum ada kategori.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
