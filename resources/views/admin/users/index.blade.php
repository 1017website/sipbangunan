{{-- FILE: resources/views/admin/users/index.blade.php --}}
@extends('layouts.admin')
@section('page_title', 'Manajemen User')

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:10px;">
    <div>
        <h1 style="font-size:1.2rem;font-weight:800;color:var(--ink);">Manajemen User</h1>
        <p style="font-size:.78rem;color:var(--muted);margin-top:2px;">Kelola akses admin CMS</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah User
    </a>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">👥 Daftar User ({{ $users->count() }})</div>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Bergabung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $i => $user)
                <tr>
                    <td style="color:var(--muted);font-size:.75rem;">{{ $i + 1 }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:32px;height:32px;border-radius:8px;background:var(--y3);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.82rem;color:var(--ink);flex-shrink:0;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight:600;font-size:.82rem;">{{ $user->name }}</div>
                                @if($user->id === auth()->id())
                                    <div style="font-size:.65rem;color:var(--muted);">Anda</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td style="color:var(--muted);font-size:.8rem;">{{ $user->email }}</td>
                    <td>
                        @if($user->role === 'admin')
                            <span class="badge badge-yellow">Admin</span>
                        @else
                            <span class="badge badge-blue">Editor</span>
                        @endif
                    </td>
                    <td style="color:var(--muted);font-size:.75rem;">{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-secondary btn-sm btn-icon" title="Edit">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </a>
                            @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                  onsubmit="return confirm('Hapus user {{ $user->name }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-icon" title="Hapus">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;padding:32px;color:var(--muted);">Belum ada user.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
