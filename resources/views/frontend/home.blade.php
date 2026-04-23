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
        background-position: {{ $bannerPos }};
        background-size: cover;
        opacity: {{ $bannerOpacity }};
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

    <div class="hero-stats-bar">
        <div class="hstat">
            <div class="hstat-n">{{ $settings['stat_categories'] ?? '8+' }}</div>
            <div class="hstat-l">Kategori</div>
        </div>
        <div class="hstat">
            <div class="hstat-n">{{ $settings['stat_products'] ?? '100+' }}</div>
            <div class="hstat-l">Produk</div>
        </div>
        <div class="hstat">
            <div class="hstat-n">{{ $settings['stat_years'] ?? '10+' }}</div>
            <div class="hstat-l">Tahun</div>
        </div>
        <div class="hstat">
            <div class="hstat-n">{{ $settings['stat_customers'] ?? '1K+' }}</div>
            <div class="hstat-l">Pelanggan</div>
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
                        @if(!empty($settings['tokped_url']))
                        <a href="{{ $settings['tokped_url'] }}" target="_blank" class="soc-btn soc-btn-tokped">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><rect width="24" height="24" rx="5" fill="#42B549"/><path d="M7 8h10M7 12h6M7 16h8" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
                            Tokopedia
                        </a>
                        @endif
                        @if(!empty($settings['shopee_url']))
                        <a href="{{ $settings['shopee_url'] }}" target="_blank" class="soc-btn soc-btn-shopee">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M5 8h14l-1.5 10a1 1 0 01-1 .9H7.5a1 1 0 01-1-.9L5 8z" fill="#EE4D2D"/><path d="M9 8V6a3 3 0 016 0v2" stroke="#EE4D2D" stroke-width="1.5" fill="none"/><circle cx="9.5" cy="15" r="1" fill="#fff"/><circle cx="14.5" cy="15" r="1" fill="#fff"/></svg>
                            Shopee
                        </a>
                        @endif
                        @if(!empty($settings['tiktok_url']))
                        <a href="{{ $settings['tiktok_url'] }}" target="_blank" class="soc-btn soc-btn-tiktok">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="#000"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.34 6.34 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.78 1.52V6.75a4.85 4.85 0 01-1.01-.06z"/></svg>
                            TikTok
                        </a>
                        @endif
                        @if(!empty($settings['facebook_url']))
                        <a href="{{ $settings['facebook_url'] }}" target="_blank" class="soc-btn soc-btn-fb">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="#1877F2"><path d="M24 12.073C24 5.405 18.627 0 12 0S0 5.405 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078v-3.49h3.047V9.41c0-3.025 1.792-4.697 4.533-4.697 1.312 0 2.686.235 2.686.235v2.97h-1.513c-1.491 0-1.956.93-1.956 1.886v2.27h3.328l-.532 3.49h-2.796V24C19.612 23.094 24 18.1 24 12.073z"/></svg>
                            Facebook
                        </a>
                        @endif
                        @if(!empty($settings['instagram_url']))
                        <a href="{{ $settings['instagram_url'] }}" target="_blank" class="soc-btn soc-btn-ig">
                            <svg width="15" height="15" viewBox="0 0 24 24"><defs><linearGradient id="iggrad" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#F58529"/><stop offset="50%" stop-color="#DD2A7B"/><stop offset="100%" stop-color="#8134AF"/></linearGradient></defs><path fill="url(#iggrad)" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            Instagram
                        </a>
                        @endif
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