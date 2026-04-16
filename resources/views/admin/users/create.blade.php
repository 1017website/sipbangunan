{{-- FILE: resources/views/admin/users/create.blade.php --}}
@extends('layouts.admin')
@section('page_title', 'Tambah User')

@section('content')
<div style="margin-bottom:20px;">
    <a href="{{ route('admin.users.index') }}" style="font-size:.8rem;color:var(--muted);text-decoration:none;">← Kembali ke Manajemen User</a>
</div>

<div class="card" style="max-width:520px;">
    <div class="card-header">
        <div class="card-title">➕ Tambah User Baru</div>
    </div>
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-error">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Role</label>
                <select name="role" class="form-control" required>
                    <option value="editor" {{ old('role')==='editor'?'selected':'' }}>Editor</option>
                    <option value="admin" {{ old('role')==='admin'?'selected':'' }}>Admin</option>
                </select>
                <div style="font-size:.72rem;color:var(--muted);margin-top:4px;">Admin: akses penuh. Editor: kelola konten saja.</div>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <div style="display:flex;gap:10px;margin-top:8px;">
                <button type="submit" class="btn btn-primary">Simpan User</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
