{{-- ============================================================ --}}
{{-- FILE: resources/views/layouts/frontend.blade.php  (GANTI) --}}
{{-- ============================================================ --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

{{-- ===================== SEO META TAGS ===================== --}}
@php
    $seoTitle       = ($settings['seo_title'] ?? '') ?: (($settings['site_name'] ?? 'SIP Bangunan') . ' – Supplier Bahan Bangunan');
    $seoDesc        = ($settings['seo_description'] ?? '') ?: ($settings['site_description'] ?? '');
    $seoKeywords    = $settings['seo_keywords'] ?? '';
    $ogImage        = !empty($settings['og_image']) ? Storage::url($settings['og_image']) : '';
    $siteName       = $settings['site_name'] ?? 'SIP Bangunan';
    $currentUrl     = request()->fullUrl();
@endphp

<link rel="icon" type="image/png" sizes="32x32" href="images/favicon.png">
<title>@yield('seo_title', $seoTitle)</title>
<meta name="description" content="@yield('seo_desc', $seoDesc)">
@if($seoKeywords)
<meta name="keywords" content="{{ $seoKeywords }}">
@endif
<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ $currentUrl }}">

{{-- Open Graph (Facebook, WhatsApp) --}}
<meta property="og:type" content="website">
<meta property="og:url" content="{{ $currentUrl }}">
<meta property="og:title" content="@yield('seo_title', $seoTitle)">
<meta property="og:description" content="@yield('seo_desc', $seoDesc)">
@if($ogImage)
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
@endif
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="id_ID">

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="@yield('seo_title', $seoTitle)">
<meta name="twitter:description" content="@yield('seo_desc', $seoDesc)">
@if($ogImage)
<meta name="twitter:image" content="{{ $ogImage }}">
@endif

{{-- Schema.org Structured Data --}}
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "LocalBusiness",
  "name": "{{ $siteName }}",
  "description": "{{ $seoDesc }}",
  "url": "{{ config('app.url') }}",
  "telephone": "{{ $settings['phone'] ?? '' }}",
  "address": {
    "@@type": "PostalAddress",
    "streetAddress": "{{ $settings['address'] ?? '' }}",
    "addressCountry": "ID"
  },
  "openingHours": "{{ $settings['hours'] ?? '' }}"
}
</script>
{{-- =================== END SEO META TAGS =================== --}}

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet"/>

<style>
:root{
  --y:#FBBF00;--y2:#E6AE00;--y3:#FFF3C4;--y4:#FFFAEB;
  --ink:#0A0A0A;--ink2:#1A1A1A;--ink3:#374151;
  --muted:#6B7280;--light:#9CA3AF;--faint:#D1D5DB;
  --white:#FFFFFF;--bg:#F9FAFB;--bg2:#F3F4F6;
  --radius:14px;--radius-sm:8px;--radius-lg:20px;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
html{scroll-behavior:smooth;}
body{font-family:'Inter',sans-serif;background:var(--bg);color:var(--ink);overflow-x:hidden;-webkit-font-smoothing:antialiased;}
::-webkit-scrollbar{width:4px;}
::-webkit-scrollbar-track{background:transparent;}
::-webkit-scrollbar-thumb{background:var(--y);border-radius:99px;}

/* NAVBAR */
.navbar{position:fixed;top:0;left:0;right:0;z-index:1000;height:64px;background:rgba(255,255,255,0.95);backdrop-filter:blur(16px);border-bottom:1px solid var(--faint);display:flex;align-items:center;padding:0 max(24px,4vw);gap:32px;transition:box-shadow .25s;}
.navbar.shadow{box-shadow:0 1px 16px rgba(0,0,0,.07);}
.nav-logo-img{height:36px;width:auto;display:block;object-fit:contain;}
.footer-logo-img{height:40px;width:auto;display:block;object-fit:contain;margin-bottom:12px;}
.nav-logo{display:flex;align-items:center;gap:10px;cursor:pointer;text-decoration:none;flex-shrink:0;}
.nav-logo-txt .brand{font-size:.95rem;font-weight:800;color:var(--ink);letter-spacing:-.3px;}
.nav-logo-txt .sub{font-size:.58rem;color:var(--muted);letter-spacing:1.5px;text-transform:uppercase;font-weight:500;}
.nav-links{display:flex;align-items:center;gap:2px;list-style:none;margin-left:auto;}
.nav-links a{font-size:.8rem;font-weight:500;color:var(--ink3);text-decoration:none;padding:7px 12px;border-radius:8px;transition:all .18s;}
.nav-links a:hover{background:var(--bg2);color:var(--ink);}
.nav-wa{display:flex;align-items:center;gap:7px;flex-shrink:0;background:var(--y);color:var(--ink);font-size:.8rem;font-weight:700;padding:9px 16px;border-radius:10px;text-decoration:none;transition:all .2s;white-space:nowrap;}
.nav-wa:hover{background:var(--y2);box-shadow:0 4px 14px rgba(251,191,0,.4);}
.nav-wa svg{width:15px;height:15px;fill:var(--ink);}
.nav-ham{display:none;background:none;border:none;cursor:pointer;padding:6px;flex-shrink:0;}
.nav-ham span{display:block;width:20px;height:1.5px;background:var(--ink);margin:5px 0;border-radius:2px;transition:.25s;}

/* ===================== HERO BANNER ===================== */
.hero{
  padding-top:64px;
  background:var(--white);
  border-bottom:1px solid var(--faint);
  /* Banner diatur via inline style dari PHP/Blade */
  position:relative;
  overflow:hidden;
  min-height:650px;
}
/* Overlay / ::before untuk banner */
.hero::before{
  content:'';
  position:absolute;
  inset:0;
  background-size:cover;
  background-repeat:no-repeat;
  pointer-events:none;
  z-index:0;
  /* nilai default jika tidak ada banner */
  opacity:0;
}
/* Saat ada banner_desktop — set via inline style di .hero */
.hero.has-banner::before{
  opacity:var(--banner-opacity, 0.5);
}
/* Responsive: ganti ke banner mobile di layar kecil */
@@media(max-width:768px){
  .hero.has-banner-mobile::before{
    background-image:var(--banner-mobile-url) !important;
  }
}
.hero-inner{
  max-width:1280px;margin:0 auto;
  padding:56px max(24px,4vw) 0;
  display:grid;grid-template-columns:1fr auto;gap:48px;
  align-items:flex-end;
  position:relative;z-index:1;
}
.hero-label{display:inline-flex;align-items:center;gap:6px;font-size:.72rem;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--y2);margin-bottom:16px;}
.hero-label::before{content:'';width:20px;height:2px;background:var(--y);border-radius:2px;}
.hero-h1{font-size:clamp(2.4rem,5vw,4rem);font-weight:800;letter-spacing:-2px;line-height:1.05;color:var(--ink);margin-bottom:18px;}
.hero-h1 em{font-family:'Instrument Serif',serif;font-style:italic;font-weight:400;color:var(--ink);letter-spacing:-1px;position:relative;display:inline-block;}
.hero-h1 em::after{content:'';position:absolute;left:0;right:0;bottom:2px;height:10px;background:var(--y);opacity:.35;z-index:-1;border-radius:2px;}
.hero-p{font-size:.93rem;color:var(--muted);line-height:1.7;max-width:500px;margin-bottom:32px;}
.hero-btns{display:flex;gap:10px;flex-wrap:wrap;}
.btn-dark{background:var(--ink);color:var(--white);font-size:.82rem;font-weight:600;padding:12px 22px;border-radius:var(--radius-sm);border:none;cursor:pointer;transition:all .2s;text-decoration:none;display:inline-flex;align-items:center;gap:7px;letter-spacing:-.1px;}
.btn-dark:hover{background:var(--ink2);transform:translateY(-1px);}
.btn-outline{background:transparent;color:var(--ink);font-size:.82rem;font-weight:600;padding:12px 22px;border-radius:var(--radius-sm);border:1.5px solid var(--faint);cursor:pointer;transition:all .2s;text-decoration:none;display:inline-flex;align-items:center;gap:7px;}
.btn-outline:hover{border-color:var(--y);background:var(--y4);}
.hero-stats-bar{background:var(--y);padding:16px max(24px,4vw);display:flex;align-items:center;gap:0;margin-top:32px;position:relative;z-index:1;}
.hstat{flex:1;text-align:center;padding:0 20px;border-right:1px solid rgba(0,0,0,.1);}
.hstat:last-child{border-right:none;}
.hstat-n{font-size:1.5rem;font-weight:800;color:var(--ink);letter-spacing:-1px;line-height:1;}
.hstat-l{font-size:.65rem;font-weight:600;color:rgba(0,0,0,.5);letter-spacing:1px;text-transform:uppercase;margin-top:2px;}
/* =================== END HERO BANNER =================== */

/* TICKER */
.ticker{overflow:hidden;background:var(--ink2);padding:10px 0;position:relative;z-index:1;}
.ticker-row{display:flex;white-space:nowrap;animation:tick 28s linear infinite;}
.ticker-item{font-size:.72rem;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,.6);padding:0 24px;display:inline-flex;align-items:center;gap:12px;}
.ticker-item::after{content:'·';color:var(--y);font-size:1.2rem;line-height:0;}
@@keyframes tick{from{transform:translateX(0)}to{transform:translateX(-50%)}}

/* CAT STRIP */
.cat-strip{background:var(--white);border-bottom:1px solid var(--faint);padding:0 max(24px,4vw);}
.cat-strip-inner{max-width:1280px;margin:0 auto;display:flex;gap:0;overflow-x:auto;scrollbar-width:none;}
.cat-strip-inner::-webkit-scrollbar{display:none;}
.cat-tab{display:flex;align-items:center;gap:8px;padding:14px 20px;border-bottom:2px solid transparent;font-size:.8rem;font-weight:600;color:var(--muted);white-space:nowrap;cursor:pointer;transition:all .18s;flex-shrink:0;text-decoration:none;}
.cat-tab:hover{color:var(--ink);border-bottom-color:var(--faint);}
.cat-tab.active{color:var(--ink);border-bottom-color:var(--y);}

/* MAIN LAYOUT */
.main-content{max-width:1280px;margin:0 auto;padding:40px max(24px,4vw) 80px;}
.sh{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:24px;}
.sh-label{font-size:.68rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--y2);margin-bottom:6px;}
.sh-title{font-size:1.5rem;font-weight:800;letter-spacing:-1px;color:var(--ink);}

/* CATEGORY CARDS */
.cat-grid-home{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;}
.ccard{background:var(--white);border:1px solid var(--faint);border-radius:var(--radius);padding:22px 20px;cursor:pointer;transition:all .22s cubic-bezier(.34,1.4,.64,1);position:relative;overflow:hidden;display:flex;flex-direction:column;text-decoration:none;color:inherit;}
.ccard::before{content:'';position:absolute;inset:0;border-radius:var(--radius);background:var(--y);opacity:0;transition:opacity .22s;}
.ccard:hover{border-color:var(--y);transform:translateY(-4px);box-shadow:0 12px 32px rgba(251,191,0,.15);}
.ccard:hover::before{opacity:1;}
.ccard:hover .cc-name,.ccard:hover .cc-count,.ccard:hover .cc-desc,.ccard:hover .cc-arrow{color:var(--ink);}
.cc-inner{position:relative;z-index:1;display:flex;flex-direction:column;flex:1;}
.cc-icon-box{width:44px;height:44px;background:var(--bg);border:1px solid var(--faint);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;margin-bottom:14px;flex-shrink:0;}
.cc-name{font-size:.88rem;font-weight:700;color:var(--ink);margin-bottom:3px;line-height:1.3;}
.cc-count{font-size:.68rem;font-weight:700;letter-spacing:.5px;color:var(--y2);margin-bottom:6px;}
.cc-desc{font-size:.75rem;color:var(--muted);line-height:1.5;flex:1;}
.cc-arrow{margin-top:14px;font-size:.8rem;color:var(--muted);}

/* ABOUT STRIP */
.about-strip{background:var(--ink);border-radius:var(--radius-lg);padding:44px 52px;display:grid;grid-template-columns:1fr 1fr;gap:52px;align-items:center;margin:40px 0;}
.as-label{font-size:.68rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--y);margin-bottom:10px;}
.as-title{font-size:1.7rem;font-weight:800;letter-spacing:-1px;color:var(--white);line-height:1.15;margin-bottom:14px;}
.as-title span{color:var(--y);}
.as-p{font-size:.85rem;color:rgba(255,255,255,.5);line-height:1.75;}
.as-right{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.as-feat{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:var(--radius-sm);padding:14px 16px;}
.as-feat-icon{font-size:1.1rem;margin-bottom:7px;}
.as-feat-t{font-size:.8rem;font-weight:700;color:var(--white);margin-bottom:3px;}
.as-feat-d{font-size:.72rem;color:rgba(255,255,255,.4);line-height:1.5;}

/* WHY */
.why-row{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-top:24px;}
.wcard{background:var(--white);border:1px solid var(--faint);border-radius:var(--radius);padding:22px 20px;transition:all .2s;}
.wcard:hover{border-color:var(--y);box-shadow:0 6px 20px rgba(251,191,0,.1);}
.wcard-icon{width:40px;height:40px;background:var(--y4);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;margin-bottom:12px;}
.wcard-t{font-size:.88rem;font-weight:700;color:var(--ink);margin-bottom:5px;}
.wcard-d{font-size:.78rem;color:var(--muted);line-height:1.6;}

/* CONTACT */
.contact-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:24px;}
.contact-info-card{background:var(--white);border:1px solid var(--faint);border-radius:var(--radius-lg);overflow:hidden;}
.cic-head{background:var(--y);padding:20px 24px;}
.cic-head h3{font-size:1rem;font-weight:800;color:var(--ink);}
.cic-head p{font-size:.75rem;color:rgba(0,0,0,.55);margin-top:2px;}
.cic-body{padding:20px 24px;display:flex;flex-direction:column;gap:14px;}
.ci{display:flex;gap:12px;align-items:flex-start;}
.ci-ico{width:34px;height:34px;background:var(--y4);border:1px solid var(--y3);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.9rem;flex-shrink:0;}
.ci-lbl{font-size:.62rem;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:var(--y2);margin-bottom:2px;}
.ci-val{font-size:.82rem;color:var(--ink);font-weight:500;}
.ci-val a{color:var(--ink);text-decoration:none;}
.ci-val a:hover{color:var(--y2);}
.cic-foot{padding:0 24px 20px;display:flex;flex-direction:column;gap:8px;}
.wa-cta{display:flex;align-items:center;gap:9px;background:#25D366;color:var(--white);font-size:.82rem;font-weight:700;padding:11px 18px;border-radius:var(--radius-sm);text-decoration:none;transition:all .2s;}
.wa-cta:hover{background:#1ebe5d;}
.wa-cta svg{width:16px;height:16px;fill:currentColor;}
.soc-row{display:flex;gap:7px;flex-wrap:wrap;}
.soc-btn{font-size:.72rem;font-weight:700;padding:8px 14px;border-radius:var(--radius-sm);border:1px solid var(--faint);background:var(--bg);color:var(--ink);text-decoration:none;transition:all .18s;}
.soc-btn:hover{border-color:var(--y);background:var(--y4);}
.map-card{border-radius:var(--radius-lg);overflow:hidden;border:1px solid var(--faint);}
.map-card iframe{width:100%;height:100%;min-height:340px;display:block;}

/* PRODUCT LIST */
.list-page{padding-top:64px;min-height:100vh;background:var(--bg);}
.list-subhdr{position:sticky;top:64px;z-index:90;background:rgba(255,255,255,.97);backdrop-filter:blur(12px);border-bottom:1px solid var(--faint);padding:0 max(24px,4vw);}
.list-subhdr-inner{max-width:1280px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;height:52px;gap:16px;}
.lsh-bc{display:flex;align-items:center;gap:6px;font-size:.75rem;font-weight:500;color:var(--muted);}
.lsh-bc .crumb{color:var(--y2);font-weight:600;text-decoration:none;}
.lsh-bc .crumb:hover{color:var(--ink);}
.lsh-bc .sep{color:var(--faint);}
.lsh-info{font-size:.75rem;color:var(--muted);}
.lsh-info strong{color:var(--ink);font-weight:700;}
.list-hero-band{background:var(--white);border-bottom:1px solid var(--faint);padding:28px max(24px,4vw);}
.list-hero-inner{max-width:1280px;margin:0 auto;display:flex;align-items:center;gap:18px;}
.list-cat-icon-big{width:56px;height:56px;background:var(--y3);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0;}
.list-cat-ttl{font-size:1.5rem;font-weight:800;letter-spacing:-1px;color:var(--ink);}
.list-cat-sub{font-size:.82rem;color:var(--muted);margin-top:3px;}
.list-body-wrap{max-width:1280px;margin:0 auto;padding:28px max(24px,4vw) 80px;}
.prod-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-bottom:40px;}
.pcard{background:var(--white);border:1px solid var(--faint);border-radius:var(--radius);overflow:hidden;cursor:pointer;display:flex;flex-direction:column;transition:all .22s cubic-bezier(.34,1.3,.64,1);text-decoration:none;color:inherit;}
.pcard:hover{border-color:var(--y);box-shadow:0 8px 28px rgba(251,191,0,.12);transform:translateY(-3px);}
.pcard-thumb{height:150px;background:linear-gradient(135deg,var(--y4) 0%,var(--y3) 100%);display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;}
.pcard-thumb .pcard-icon{font-size:2.2rem;opacity:.7;position:relative;z-index:1;}
.pcard-spec-tag{position:absolute;bottom:8px;left:8px;background:rgba(255,255,255,.9);border-radius:5px;font-size:.62rem;font-weight:700;padding:3px 8px;color:var(--ink3);z-index:2;}
.pcard-thumb img{width:100%;height:100%;object-fit:cover;position:absolute;inset:0;}
.pcard-body{padding:14px 16px 16px;flex:1;display:flex;flex-direction:column;}
.pcard-name{font-size:.88rem;font-weight:700;color:var(--ink);line-height:1.3;margin-bottom:5px;}
.pcard-desc{font-size:.75rem;color:var(--muted);line-height:1.5;flex:1;margin-bottom:12px;}
.pcard-foot{display:flex;align-items:center;justify-content:space-between;gap:8px;}
.pcard-btn{flex:1;text-align:center;background:var(--y);color:var(--ink);font-size:.72rem;font-weight:700;padding:7px 12px;border-radius:7px;}
.pcard:hover .pcard-btn{background:var(--y2);}

/* PAGINATION */
.pag{display:flex;align-items:center;gap:6px;}
.pag a,.pag span{width:36px;height:36px;border-radius:8px;border:1px solid var(--faint);background:var(--white);font-size:.8rem;font-weight:600;color:var(--ink);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .18s;text-decoration:none;}
.pag a:hover{border-color:var(--y);background:var(--y4);}
.pag span.current{background:var(--y);border-color:var(--y);color:var(--ink);}
.pag span.disabled{opacity:.4;cursor:default;}

/* DETAIL */
.detail-page{padding-top:64px;min-height:100vh;background:var(--bg);}
.detail-subhdr{background:rgba(255,255,255,.97);backdrop-filter:blur(12px);border-bottom:1px solid var(--faint);padding:0 max(24px,4vw);}
.detail-subhdr-inner{max-width:1280px;margin:0 auto;display:flex;align-items:center;height:48px;gap:6px;font-size:.75rem;font-weight:500;color:var(--muted);}
.d-crumb{color:var(--y2);font-weight:600;text-decoration:none;}
.d-crumb:hover{color:var(--ink);}
.d-sep{color:var(--faint);}
.detail-body{max-width:1180px;margin:0 auto;padding:32px max(24px,4vw) 80px;}
.detail-layout{display:grid;grid-template-columns:2fr 3fr;gap:24px;align-items:flex-start;}
.d-img-panel{background:linear-gradient(160deg,var(--y4) 0%,var(--y3) 100%);border:1px solid var(--y3);border-radius:var(--radius-lg);height:360px;display:flex;align-items:center;justify-content:center;font-size:8rem;position:sticky;top:128px;overflow:hidden;}
.d-img-panel img{width:100%;height:100%;object-fit:cover;}
.d-info-panel{display:flex;flex-direction:column;gap:16px;}
.d-card{background:var(--white);border:1px solid var(--faint);border-radius:var(--radius);}
.d-card-pad{padding:24px;}
.d-cat-pill{display:inline-flex;align-items:center;gap:6px;background:var(--y4);border:1px solid var(--y3);border-radius:99px;font-size:.68rem;font-weight:700;letter-spacing:.5px;text-transform:uppercase;color:var(--y2);padding:4px 12px;margin-bottom:12px;}
.d-name{font-size:1.7rem;font-weight:800;letter-spacing:-1px;color:var(--ink);line-height:1.1;margin-bottom:8px;}
.d-spec-pill{display:inline-flex;align-items:center;gap:6px;background:var(--bg);border:1px solid var(--faint);border-radius:6px;font-size:.72rem;font-weight:600;padding:5px 12px;color:var(--ink3);margin-bottom:14px;}
.d-desc{font-size:.85rem;color:var(--muted);line-height:1.75;}
.d-spec-tbl{width:100%;border-collapse:collapse;}
.d-spec-tbl td{padding:9px 14px;font-size:.82rem;border-bottom:1px solid var(--faint);}
.d-spec-tbl tr:last-child td{border-bottom:none;}
.d-spec-tbl td:first-child{color:var(--muted);font-weight:500;width:45%;}
.d-spec-tbl td:last-child{color:var(--ink);font-weight:600;}
.d-buy-card .d-card-pad{display:flex;flex-direction:column;gap:8px;}
.buy-btn{display:flex;align-items:center;gap:14px;padding:13px 16px;border-radius:var(--radius-sm);text-decoration:none;border:1.5px solid var(--faint);background:var(--white);transition:all .18s;}
.buy-btn:hover{transform:translateY(-1px);box-shadow:0 4px 14px rgba(0,0,0,.07);}
.buy-btn .bico{width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0;}
.buy-btn .bname{font-size:.85rem;font-weight:700;color:var(--ink);}
.buy-btn .bsub{font-size:.68rem;color:var(--muted);}
.buy-btn .barr{margin-left:auto;color:var(--faint);}
.bb-tokped{background:#FFF8F5;border-color:#FFD4BE;}.bb-tokped:hover{border-color:#FF6D00;}.bb-tokped .bico{background:#FFE8D6;}.bb-tokped .bname{color:#CC5500;}
.bb-shopee{background:#FFF8F7;border-color:#FFCFC7;}.bb-shopee:hover{border-color:#EE4D2D;}.bb-shopee .bico{background:#FFDAD4;}.bb-shopee .bname{color:#C43D21;}
.bb-tiktok{background:var(--bg);border-color:var(--faint);}.bb-tiktok:hover{border-color:var(--ink);}.bb-tiktok .bico{background:var(--bg2);}
.bb-wa{background:#F0FFF4;border-color:#BBF7D0;}.bb-wa:hover{border-color:#25D366;}.bb-wa .bico{background:#D1FAE5;}.bb-wa .bname{color:#15803D;}

/* FOOTER */
footer{background:var(--ink2);border-top:3px solid var(--y);}
.footer-inner{max-width:1280px;margin:0 auto;padding:48px max(24px,4vw) 32px;display:grid;grid-template-columns:2fr 1fr 1fr;gap:48px;}
.fb p{font-size:.8rem;color:rgba(255,255,255,.38);line-height:1.7;max-width:260px;margin-top:12px;}
.fh{font-size:.68rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--y);margin-bottom:14px;}
.fl{list-style:none;display:flex;flex-direction:column;gap:8px;}
.fl a{font-size:.8rem;color:rgba(255,255,255,.4);text-decoration:none;font-weight:500;transition:color .18s;}
.fl a:hover{color:var(--y);}
.footer-btm{max-width:1280px;margin:0 auto;padding:16px max(24px,4vw);border-top:1px solid rgba(255,255,255,.07);display:flex;align-items:center;justify-content:space-between;}
.fc{font-size:.72rem;color:rgba(255,255,255,.25);}
.fc em{color:var(--y);font-style:normal;}
.site-brand{font-size:1.1rem;font-weight:800;color:var(--white);letter-spacing:-.5px;}
.site-brand span{color:var(--y);}

/* WA FLOAT */
.wa-float{position:fixed;bottom:24px;right:24px;z-index:999;width:52px;height:52px;border-radius:14px;background:#25D366;color:var(--white);display:flex;align-items:center;justify-content:center;text-decoration:none;box-shadow:0 4px 20px rgba(37,211,102,.4);transition:all .22s;animation:wf 2.5s ease-in-out infinite;}
.wa-float:hover{transform:scale(1.08);}
.wa-float svg{width:24px;height:24px;fill:currentColor;}
@@keyframes wf{0%,100%{transform:translateY(0)}50%{transform:translateY(-5px)}}

/* RESPONSIVE */
@@media(max-width:1100px){.cat-grid-home{grid-template-columns:repeat(2,1fr);}.footer-inner{grid-template-columns:1fr 1fr;}.fb{grid-column:1/-1;}}
@@media(max-width:900px){.hero-inner{grid-template-columns:1fr;}.about-strip{grid-template-columns:1fr;gap:28px;}.as-right{grid-template-columns:repeat(3,1fr);}.contact-grid{grid-template-columns:1fr;}.detail-layout{grid-template-columns:1fr;}.d-img-panel{display:none;}.why-row{grid-template-columns:1fr 1fr;}.nav-links{display:none;}.nav-ham{display:block;}}
@@media(max-width:600px){.cat-grid-home,.why-row,.as-right{grid-template-columns:1fr;}.hero-stats-bar{flex-wrap:wrap;gap:0;}.hstat{min-width:50%;}.footer-inner{grid-template-columns:1fr;gap:28px;}.footer-btm{flex-direction:column;gap:4px;text-align:center;}}
</style>

{{-- Google Tag Manager --}}
@if(!empty($settings['gtm_id']))
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','{{ $settings['gtm_id'] }}');</script>
@endif
</head>
<body>
{{-- GTM noscript --}}
@if(!empty($settings['gtm_id']))
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $settings['gtm_id'] }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
@endif
{{-- Meta Pixel --}}
@if(!empty($settings['meta_pixel_id']))
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init','{{ $settings['meta_pixel_id'] }}');fbq('track','PageView');
</script>
<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ $settings['meta_pixel_id'] }}&ev=PageView&noscript=1"/></noscript>
@endif

<nav class="navbar" id="navbar">
    <a href="{{ route('home') }}" class="nav-logo">
        <img src="/images/logo.png" alt="{{ $settings['site_name'] ?? 'SIP Bangunan' }}" class="nav-logo-img">
    </a>
    <ul class="nav-links">
        <li><a href="{{ route('home') }}">Beranda</a></li>
        <li><a href="{{ route('home') }}#about-sec">Tentang</a></li>
        <li><a href="{{ route('home') }}#cat-sec">Produk</a></li>
        <li><a href="{{ route('home') }}#why-sec">Keunggulan</a></li>
        <li><a href="{{ route('home') }}#contact-sec">Kontak</a></li>
    </ul>
    @php $waNum = $settings['wa_number'] ?? '6281234567890'; @endphp
    <a href="https://wa.me/{{ $waNum }}" target="_blank" class="nav-wa">
        <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
        WA Kami
    </a>
</nav>

@yield('content')

<footer>
    <div class="footer-inner">
        <div class="fb">
            <img src="/images/logo-footer.png" alt="{{ $settings['site_name'] ?? 'SIP Bangunan' }}" class="footer-logo-img">
            <p>{{ $settings['site_description'] ?? 'Supplier bahan bangunan lengkap & terpercaya.' }}</p>
        </div>
        <div>
            <div class="fh">Menu</div>
            <ul class="fl">
                <li><a href="{{ route('home') }}#about-sec">Tentang Kami</a></li>
                <li><a href="{{ route('home') }}#cat-sec">Produk</a></li>
                <li><a href="{{ route('home') }}#why-sec">Keunggulan</a></li>
                <li><a href="{{ route('home') }}#contact-sec">Kontak</a></li>
            </ul>
        </div>
        <div>
            <div class="fh">Belanja Online</div>
            <ul class="fl">
                @if(!empty($settings['tokped_url']))<li><a href="{{ $settings['tokped_url'] }}" target="_blank">Tokopedia</a></li>@endif
                @if(!empty($settings['shopee_url']))<li><a href="{{ $settings['shopee_url'] }}" target="_blank">Shopee</a></li>@endif
                @if(!empty($settings['tiktok_url']))<li><a href="{{ $settings['tiktok_url'] }}" target="_blank">TikTok Shop</a></li>@endif
            </ul>
        </div>
    </div>
    <div class="footer-btm">
        <div class="fc">© {{ date('Y') }} <em>{{ $settings['site_name'] ?? 'SIP Bangunan' }}</em>. All rights reserved.</div>
        <div class="fc">The Best Building Material Supplier 🏗️</div>
    </div>
</footer>

@php $waNumber = $settings['wa_number'] ?? '6281234567890'; @endphp
<a href="https://wa.me/{{ $waNumber }}" target="_blank" class="wa-float">
    <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
</a>

<script>
window.addEventListener('scroll', () => {
    document.getElementById('navbar').classList.toggle('shadow', window.scrollY > 20);
});
</script>
</body>
</html>