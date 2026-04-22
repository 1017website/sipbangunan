@extends('layouts.frontend')

@section('title', $product->name . ' – ' . ($settings['site_name'] ?? 'SIP Bangunan'))
@section('meta_desc', $product->description)

@section('content')
    <div class="detail-page">
        <div class="detail-subhdr">
            <div class="detail-subhdr-inner">
                <a href="{{ route('home') }}" class="d-crumb">Beranda</a>
                <span class="d-sep">›</span>
                <a href="{{ route('home') }}#cat-sec" class="d-crumb">Produk</a>
                <span class="d-sep">›</span>
                <a href="{{ route('category', $category) }}" class="d-crumb">{{ $category->name }}</a>
                <span class="d-sep">›</span>
                <span style="color:var(--ink);font-weight:600">{{ $product->name }}</span>
            </div>
        </div>

        <div class="detail-body">
            <div class="detail-layout">
                {{-- Image Panel --}}
                <div class="d-img-panel">
                    @if($product->image)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    @else
                        {{ $product->icon }}
                    @endif
                </div>

                {{-- Info Panel --}}
                <div class="d-info-panel">
                    <div class="d-card">
                        <div class="d-card-pad">
                            <div class="d-cat-pill">{{ $category->icon }} {{ $category->name }}</div>
                            <h1 class="d-name">{{ $product->name }}</h1>
                            @if($product->spec)
                                <div class="d-spec-pill">📦 {{ $product->spec }}</div>
                            @endif
                            <p class="d-desc">{{ $product->description }}</p>
                        </div>
                    </div>

                    @php $specsArr = is_string($product->specs) ? (json_decode($product->specs, true) ?? []) : ($product->specs ?? []); @endphp
                    @if(count($specsArr) > 0)
                        <div class="d-card">
                            <div class="d-card-pad" style="padding-bottom:0;padding-top:16px;">
                                <div
                                    style="font-size:.68rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--light);margin-bottom:8px;">
                                    Spesifikasi</div>
                            </div>
                            <table class="d-spec-tbl">
                                @foreach($specsArr as $spec)
                                    <tr>
                                        <td>{{ $spec[0] ?? '' }}</td>
                                        <td>{{ $spec[1] ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @endif

                    <div class="d-card d-buy-card">
                        <div class="d-card-pad">
                            <div
                                style="font-size:.68rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--light);margin-bottom:12px;">
                                Beli Sekarang Di</div>
                            @if($product->tokped_url)
                                <a href="{{ $product->tokped_url }}" target="_blank" class="buy-btn bb-tokped">
                                    <div class="bico">🛒</div>
                                    <div>
                                        <div class="bname">Tokopedia</div>
                                        <div class="bsub">Lihat & beli di Tokopedia</div>
                                    </div>
                                    <span class="barr">→</span>
                                </a>
                            @endif
                            @if($product->shopee_url)
                                <a href="{{ $product->shopee_url }}" target="_blank" class="buy-btn bb-shopee">
                                    <div class="bico">🛍</div>
                                    <div>
                                        <div class="bname">Shopee</div>
                                        <div class="bsub">Lihat & beli di Shopee</div>
                                    </div>
                                    <span class="barr">→</span>
                                </a>
                            @endif
                            @if($product->tiktok_url)
                                <a href="{{ $product->tiktok_url }}" target="_blank" class="buy-btn bb-tiktok">
                                    <div class="bico">▶</div>
                                    <div>
                                        <div class="bname">TikTok Shop</div>
                                        <div class="bsub">Tonton & beli di TikTok</div>
                                    </div>
                                    <span class="barr">→</span>
                                </a>
                            @endif
                            <a href="https://wa.me/{{ $settings['wa_number'] ?? '6281234567890' }}?text={{ urlencode($product->wa_text ?? 'Halo, saya ingin bertanya tentang ' . $product->name) }}"
                                target="_blank" class="buy-btn bb-wa">
                                <div class="bico">💬</div>
                                <div>
                                    <div class="bname">WhatsApp</div>
                                    <div class="bsub">Tanya harga & stok langsung</div>
                                </div>
                                <span class="barr">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection