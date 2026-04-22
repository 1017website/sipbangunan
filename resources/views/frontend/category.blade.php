@extends('layouts.frontend')

@section('title', $category->name . ' – ' . ($settings['site_name'] ?? 'SIP Bangunan'))
@section('meta_desc', $category->description)

@section('content')
<div class="list-page">
    <div class="list-subhdr">
        <div class="list-subhdr-inner">
            <div class="lsh-bc">
                <a href="{{ route('home') }}" class="crumb">Beranda</a>
                <span class="sep">›</span>
                <a href="{{ route('home') }}#cat-sec" class="crumb">Produk</a>
                <span class="sep">›</span>
                <span style="color:var(--ink);font-weight:700">{{ $category->name }}</span>
            </div>
            <div class="lsh-info">Menampilkan <strong>{{ $products->total() }}</strong> produk</div>
        </div>
    </div>

    <div class="list-hero-band">
        <div class="list-hero-inner">
            <div class="list-cat-icon-big">{{ $category->icon }}</div>
            <div>
                <div class="list-cat-ttl">{{ $category->name }}</div>
                <div class="list-cat-sub">{{ $category->description }}</div>
            </div>
        </div>
    </div>

    <div class="list-body-wrap">
        <div class="prod-grid">
            @forelse($products as $product)
            <a href="{{ route('product', [$category, $product]) }}" class="pcard">
                <div class="pcard-thumb">
                    @if($product->image)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    @else
                        <span class="pcard-icon">{{ $product->icon }}</span>
                    @endif
                    @if($product->spec)
                    <div class="pcard-spec-tag">{{ $product->spec }}</div>
                    @endif
                </div>
                <div class="pcard-body">
                    <div class="pcard-name">{{ $product->name }}</div>
                    <div class="pcard-desc">{{ Str::limit($product->description, 80) }}</div>
                    <div class="pcard-foot">
                        <div class="pcard-btn">Detail & Beli →</div>
                        <div class="pcard-arrow">›</div>
                    </div>
                </div>
            </a>
            @empty
            <div style="grid-column:1/-1;text-align:center;padding:60px;color:var(--muted);">
                Belum ada produk di kategori ini.
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
        <div class="pag">
            @if($products->onFirstPage())
                <span class="disabled">‹</span>
            @else
                <a href="{{ $products->previousPageUrl() }}">‹</a>
            @endif

            @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                @if($page == $products->currentPage())
                    <span class="current">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach

            @if($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}">›</a>
            @else
                <span class="disabled">›</span>
            @endif
        </div>
        @endif
    </div>
</div>
@endsection