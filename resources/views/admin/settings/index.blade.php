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
            'general' => '🏪 Informasi Umum',
            'hero' => '🖼️ Hero Section',
            'stats' => '📊 Statistik Hero',
            'contact' => '📞 Kontak',
            'marketplace' => '🛒 Marketplace',
        ];
        @endphp

        {{-- Tabs --}}
        <div class="section-tabs" id="tabs">
            @foreach($settings as $group => $items)
            <button class="stab {{ $loop->first ? 'active' : '' }}" onclick="switchTab('{{ $group }}')">
                {{ $groupLabels[$group] ?? ucfirst($group) }}
            </button>
            @endforeach
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf

            @foreach($settings as $group => $items)
            <div class="section-group {{ $loop->first ? 'active' : '' }}" id="tab-{{ $group }}">
                @foreach($items as $setting)
                <div class="form-group">
                    <label class="form-label">{{ $setting['label'] ?? $setting['key'] }}</label>
                    @if($setting['type'] === 'textarea')
                        <textarea name="{{ $setting['key'] }}" class="form-control" rows="3">{{ $setting['value'] }}</textarea>
                    @else
                        <input type="text" name="{{ $setting['key'] }}" class="form-control" value="{{ $setting['value'] }}">
                    @endif
                    <small style="color:#9CA3AF;font-size:.7rem;margin-top:3px;display:block;">Key: {{ $setting['key'] }}</small>
                </div>
                @endforeach
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
