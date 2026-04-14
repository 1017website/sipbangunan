@extends('layouts.admin')

@section('page_title', 'Produk')

@section('content')
<div class="card">
    <div class="card-header">
        <div style="display:flex;align-items:center;gap:16px;">
            <div class="card-title">Daftar Produk ({{ $products->total() }})</div>
            <form method="GET" action="{{ route('admin.products.index') }}" style="display:flex;gap:8px;">
                <select name="category_id" class="form-control" style="width:180px;" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">➕ Tambah Produk</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Icon</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Spesifikasi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>
                    @if($product->image)
                        <img src="{{ $product->image_url }}" style="width:36px;height:36px;object-fit:cover;border-radius:6px;">
                    @else
                        <span style="font-size:1.4rem;">{{ $product->icon }}</span>
                    @endif
                </td>
                <td>
                    <div style="font-weight:600;">{{ $product->name }}</div>
                    <div style="font-size:.72rem;color:#6B7280;">{{ Str::limit($product->description, 60) }}</div>
                </td>
                <td style="font-size:.8rem;color:#6B7280;">{{ $product->category->name ?? '-' }}</td>
                <td style="font-size:.78rem;color:#374151;">{{ $product->spec }}</td>
                <td>
                    @if($product->is_active)
                        <span class="badge badge-green">Aktif</span>
                    @else
                        <span class="badge badge-gray">Nonaktif</span>
                    @endif
                </td>
                <td>
                    <div style="display:flex;gap:6px;">
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-secondary btn-sm">✏️ Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;color:#6B7280;padding:40px;">Belum ada produk.</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($products->hasPages())
    <div style="padding:16px 20px;border-top:1px solid #E5E7EB;display:flex;gap:6px;">
        {{ $products->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection
