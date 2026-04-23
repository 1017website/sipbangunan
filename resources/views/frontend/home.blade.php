{{-- FILE: resources/views/frontend/home.blade.php --}}
@extends('layouts.frontend')

@section('seo_title', ($settings['seo_title'] ?? '') ?: (($settings['site_name'] ?? 'SIP Bangunan') . ' – Supplier Bahan Bangunan'))
@section('seo_desc', ($settings['seo_description'] ?? '') ?: ($settings['site_description'] ?? ''))

@section('content')

@php
$bannerDesktop = !empty($settings['banner_desktop']) ? Storage::url($settings['banner_desktop']) : null;
$bannerMobile = !empty($settings['banner_mobile']) ? Storage::url($settings['banner_mobile']) : null;
$bannerOpacity = $settings['banner_opacity'] ?? '0.5';
$bannerPos = $settings['banner_position'] ?? 'center center';
$hasBanner = $bannerDesktop || $bannerMobile;
$heroClasses = 'hero' . ($hasBanner ? ' has-banner' : '') . ($bannerMobile ? ' has-banner-mobile' : '');
@endphp

@if($hasBanner)
<style>
.hero.has-banner::before {
    background-image: url('{{ $bannerDesktop ?? $bannerMobile }}');
    background-position: {{ $bannerPos }};
    background-size: cover;
    opacity: {{ $bannerOpacity }};
}
@@media(max-width: 768px) {
    .hero.has-banner-mobile::before {
        background-image: url('{{ $bannerMobile ?? $bannerDesktop }}');
    }
}
</style>
@endif

<div class="{{ $heroClasses }}">
    <div class="hero-inner">
        <div>
            <div class="hero-label">{{ $settings['hero_subtitle'] ?? 'Supplier Terpercaya Sejak 2014' }}</div>
            <h1 class="hero-h1">
                @php
                $title = $settings['hero_title'] ?? 'Semua Material Bangunan yang Anda Butuhkan';
                $words = explode(' ', $title);
                $last = array_pop($words);
                @endphp
                {{ implode(' ', $words) }} <em>{{ $last }}</em>
            </h1>
            <p class="hero-p">{{ $settings['hero_desc'] ?? '' }}</p>
            <div class="hero-btns">
                <a href="#cat-sec" class="btn-dark">Jelajahi Produk →</a>
                <a href="#contact-sec" class="btn-outline">Hubungi Kami</a>
            </div>
        </div>
    </div>

</div>

{{-- TICKER --}}
<div class="ticker">
    <div class="ticker-row">
        @foreach($categories as $cat)
        <span class="ticker-item">{{ $cat->name }}</span>
        @endforeach
        @foreach($categories as $cat)
        <span class="ticker-item">{{ $cat->name }}</span>
        @endforeach
    </div>
</div>

{{-- CAT STRIP --}}
<div class="cat-strip">
    <div class="cat-strip-inner">
        @foreach($categories as $cat)
        <a href="{{ route('category', $cat) }}" class="cat-tab">
            <span>{{ $cat->icon }}</span>{{ $cat->name }}
        </a>
        @endforeach
    </div>
</div>

<div class="main-content">

    <section id="cat-sec">
        <div class="sh">
            <div class="sh-left">
                <div class="sh-label">Katalog</div>
                <div class="sh-title">Kategori Produk</div>
            </div>
        </div>
        <div class="cat-grid-home">
            @foreach($categories as $cat)
            <a href="{{ route('category', $cat) }}" class="ccard">
                <div class="cc-inner">
                    <div class="cc-icon-box">{{ $cat->icon }}</div>
                    <div class="cc-name">{{ $cat->name }}</div>
                    <div class="cc-count">{{ $cat->product_count }} produk</div>
                    <div class="cc-desc">{{ $cat->description }}</div>
                    <div class="cc-arrow">→</div>
                </div>
            </a>
            @endforeach
        </div>
    </section>

    <div class="about-strip" id="about-sec">
        <div class="as-left">
            <div class="as-label">Tentang {{ $settings['site_name'] ?? 'SIP Bangunan' }}</div>
            <h2 class="as-title">Mitra Konstruksi <span>Terpercaya</span> Anda</h2>
            <p class="as-p">{{ $settings['site_description'] ?? '' }}</p>
        </div>
        <div class="as-right">
            <div class="as-feat">
                <div class="as-feat-icon">✅</div>
                <div class="as-feat-t">Kualitas SNI</div>
                <div class="as-feat-d">Standar nasional terjamin</div>
            </div>
            <div class="as-feat">
                <div class="as-feat-icon">💰</div>
                <div class="as-feat-t">Harga Kompetitif</div>
                <div class="as-feat-d">Terbaik semua skala proyek</div>
            </div>
            <div class="as-feat">
                <div class="as-feat-icon">🚚</div>
                <div class="as-feat-t">Kirim ke Lokasi</div>
                <div class="as-feat-d">Armada pengiriman siap</div>
            </div>
            <div class="as-feat">
                <div class="as-feat-icon">📦</div>
                <div class="as-feat-t">Stok Lengkap</div>
                <div class="as-feat-d">Gudang selalu terisi penuh</div>
            </div>
            <div class="as-feat">
                <div class="as-feat-icon">💬</div>
                <div class="as-feat-t">Konsultasi Gratis</div>
                <div class="as-feat-d">Tim ahli siap membantu</div>
            </div>
            <div class="as-feat">
                <div class="as-feat-icon">🛒</div>
                <div class="as-feat-t">Belanja Online</div>
                <div class="as-feat-d">Tokopedia, Shopee, TikTok</div>
            </div>
        </div>
    </div>

    <section id="why-sec">
        <div class="sh">
            <div class="sh-left">
                <div class="sh-label">Keunggulan</div>
                <div class="sh-title">Kenapa Pilih Kami?</div>
            </div>
        </div>
        <div class="why-row">
            <div class="wcard">
                <div class="wcard-icon">✅</div>
                <div class="wcard-t">Produk Bergaransi SNI</div>
                <div class="wcard-d">Semua produk dari distributor resmi ber-SNI terpercaya.</div>
            </div>
            <div class="wcard">
                <div class="wcard-icon">💰</div>
                <div class="wcard-t">Harga Paling Bersaing</div>
                <div class="wcard-d">Kompetitif untuk proyek kecil hingga skala besar.</div>
            </div>
            <div class="wcard">
                <div class="wcard-icon">🚚</div>
                <div class="wcard-t">Pengiriman Tepat Waktu</div>
                <div class="wcard-d">Armada pengiriman siap ke lokasi proyek sesuai jadwal.</div>
            </div>
            <div class="wcard">
                <div class="wcard-icon">📦</div>
                <div class="wcard-t">Stok Selalu Tersedia</div>
                <div class="wcard-d">Gudang luas. Tidak perlu khawatir kehabisan material.</div>
            </div>
            <div class="wcard">
                <div class="wcard-icon">💬</div>
                <div class="wcard-t">Konsultasi Material Gratis</div>
                <div class="wcard-d">Tim berpengalaman membantu memilih material yang tepat.</div>
            </div>
            <div class="wcard">
                <div class="wcard-icon">🛒</div>
                <div class="wcard-t">Mudah Belanja Online</div>
                <div class="wcard-d">Tersedia di Tokopedia, Shopee & TikTok Shop.</div>
            </div>
        </div>
    </section>

    <section id="contact-sec">
        <div class="sh">
            <div class="sh-left">
                <div class="sh-label">Kontak</div>
                <div class="sh-title">Hubungi Kami</div>
            </div>
        </div>
        <div class="contact-grid">
            <div class="contact-info-card">
                <div class="cic-head">
                    <h3>Informasi Kontak {{ $settings['site_name'] ?? 'SIP Bangunan' }}</h3>
                    <p>Siap melayani Anda setiap hari kerja</p>
                </div>
                <div class="cic-body">
                    @php
                    $cPhone = $settings['phone'] ?? '';
                    $cEmail = $settings['email'] ?? '';
                    $cWaNum = $settings['wa_number'] ?? '6281234567890';
                    $cWaText = urlencode('Halo ' . ($settings['site_name'] ?? 'SIP Bangunan'));
                    @endphp
                    <div class="ci">
                        <div class="ci-ico">📍</div>
                        <div>
                            <div class="ci-lbl">Alamat</div>
                            <div class="ci-val">{{ $settings['address'] ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="ci">
                        <div class="ci-ico">📞</div>
                        <div>
                            <div class="ci-lbl">Telepon / WhatsApp</div>
                            <div class="ci-val"><a href="tel:{{ $cPhone }}">{{ $cPhone ?: '-' }}</a></div>
                        </div>
                    </div>
                    <div class="ci">
                        <div class="ci-ico">⏰</div>
                        <div>
                            <div class="ci-lbl">Jam Operasional</div>
                            <div class="ci-val">{{ $settings['hours'] ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="ci">
                        <div class="ci-ico">✉️</div>
                        <div>
                            <div class="ci-lbl">Email</div>
                            <div class="ci-val"><a href="mailto:{{ $cEmail }}">{{ $cEmail ?: '-' }}</a></div>
                        </div>
                    </div>
                </div>
                <div class="cic-foot">
                    <a href="https://wa.me/{{ $cWaNum }}?text={{ $cWaText }}" target="_blank" class="wa-cta">
                        <svg viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                        </svg>
                        Chat WhatsApp Sekarang
                    </a>
                    <div class="soc-row">
                        @if(!empty($settings['tokped_url']))<a href="{{ $settings['tokped_url'] }}" target="_blank" class="soc-btn">🛒 Tokopedia</a>@endif
                        @if(!empty($settings['shopee_url']))<a href="{{ $settings['shopee_url'] }}" target="_blank" class="soc-btn">🛍 Shopee</a>@endif
                        @if(!empty($settings['tiktok_url']))<a href="{{ $settings['tiktok_url'] }}" target="_blank" class="soc-btn">▶ TikTok</a>@endif
                    </div>
                </div>
            </div>
                @if(!empty($settings['maps_embed']))
                <div class="map-card">
                    @php
                        $mapsRaw = $settings['maps_embed'] ?? '';
                        if (str_contains($mapsRaw, '<iframe')) {
                            preg_match('/src=["\'"]([^"\']+)["\']/', $mapsRaw, $m);
                            $mapsUrl = $m[1] ?? '';
                        } else {
                            $mapsUrl = trim($mapsRaw, '"\'');
                        }
                    @endphp
                    @if($mapsUrl)
                    <iframe src="{{ $mapsUrl }}" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Lokasi {{ $settings['site_name'] ?? 'SIP Bangunan' }}"></iframe>
                    @endif
                </div>
                @endif
        </div>
    </section>

</div>
@endsection