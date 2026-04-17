{{-- FILE: resources/views/layouts/admin.blade.php (GANTI) --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('page_title', 'Dashboard') — Admin CMS</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
:root{
  --sidebar-w:240px;
  --top-h:56px;
  --ink:#0F172A;
  --ink2:#1E293B;
  --muted:#64748B;
  --faint:#E2E8F0;
  --bg:#F1F5F9;
  --white:#FFFFFF;
  --y:#FBBF00;
  --y2:#F59E0B;
  --y3:#FEF3C7;
  --red:#EF4444;
  --green:#22C55E;
  --blue:#3B82F6;
  --radius:10px;
}
html,body{height:100%;font-family:'Inter',sans-serif;background:var(--bg);color:var(--ink);-webkit-font-smoothing:antialiased;}

/* ========== SIDEBAR ========== */
.sidebar{
  position:fixed;top:0;left:0;bottom:0;width:var(--sidebar-w);
  background:var(--ink2);
  display:flex;flex-direction:column;
  z-index:200;
  transition:transform .25s cubic-bezier(.4,0,.2,1);
  overflow-y:auto;
}
.sidebar-brand{
  padding:20px 20px 16px;
  border-bottom:1px solid rgba(255,255,255,.07);
  flex-shrink:0;
}
.sidebar-brand .brand-name{font-size:1rem;font-weight:800;color:#fff;letter-spacing:-.3px;}
.sidebar-brand .brand-sub{font-size:.6rem;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:rgba(250, 250, 250);margin-top:1px;}
.sidebar-nav{padding:12px 10px;flex:1;}
.nav-section-label{font-size:.58rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,.25);padding:8px 10px 4px;margin-top:8px;}
.nav-section-label:first-child{margin-top:0;}
.nav-item{
  display:flex;align-items:center;gap:10px;
  padding:9px 10px;border-radius:8px;
  font-size:.82rem;font-weight:500;color:rgba(255,255,255,.55);
  text-decoration:none;transition:all .15s;
  cursor:pointer;
}
.nav-item:hover{background:rgba(255,255,255,.07);color:rgba(255,255,255,.9);}
.nav-item.active{background:var(--y);color:var(--ink);font-weight:700;}
.nav-item.active .nav-icon{filter:none;}
.nav-icon{width:18px;height:18px;flex-shrink:0;opacity:.6;}
.nav-item.active .nav-icon{opacity:1;}
.nav-item:hover .nav-icon{opacity:.9;}
.nav-item .nav-badge{margin-left:auto;background:var(--red);color:#fff;font-size:.58rem;font-weight:700;padding:1px 6px;border-radius:99px;}
.sidebar-footer{
  padding:12px 10px;
  border-top:1px solid rgba(255,255,255,.07);
  flex-shrink:0;
}
.sidebar-user{display:flex;align-items:center;gap:10px;padding:8px 10px;border-radius:8px;background:rgba(255,255,255,.05);}
.sidebar-user .su-avatar{width:30px;height:30px;border-radius:8px;background:var(--y);display:flex;align-items:center;justify-content:center;font-size:.8rem;font-weight:800;color:var(--ink);flex-shrink:0;}
.sidebar-user .su-name{font-size:.78rem;font-weight:600;color:#fff;}
.sidebar-user .su-role{font-size:.62rem;color:rgba(255,255,255,.35);}

/* ========== TOPBAR ========== */
.topbar{
  position:fixed;top:0;left:var(--sidebar-w);right:0;height:var(--top-h);
  background:var(--white);border-bottom:1px solid var(--faint);
  display:flex;align-items:center;padding:0 20px;gap:12px;
  z-index:100;
}
.topbar-ham{
  display:none;background:none;border:none;cursor:pointer;
  padding:6px;border-radius:8px;transition:background .15s;
}
.topbar-ham:hover{background:var(--bg);}
.topbar-ham span{display:block;width:18px;height:1.5px;background:var(--ink);margin:4px 0;border-radius:2px;transition:.2s;}
.topbar-title{font-size:.92rem;font-weight:700;color:var(--ink);}
.topbar-right{margin-left:auto;display:flex;align-items:center;gap:8px;}
.topbar-btn{
  display:flex;align-items:center;gap:6px;
  padding:6px 12px;border-radius:8px;
  font-size:.75rem;font-weight:600;color:var(--muted);
  text-decoration:none;transition:all .15s;border:1px solid var(--faint);
  background:var(--white);
}
.topbar-btn:hover{background:var(--bg);color:var(--ink);}
.topbar-btn.primary{background:var(--y);color:var(--ink);border-color:var(--y);}
.topbar-btn.primary:hover{background:var(--y2);}

/* ========== MAIN ========== */
.main-wrap{
  margin-left:var(--sidebar-w);
  padding-top:var(--top-h);
  min-height:100vh;
}
.page-content{padding:24px 20px 40px;}

/* ========== OVERLAY ========== */
.sidebar-overlay{
  display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);
  z-index:150;backdrop-filter:blur(2px);
}

/* ========== CARDS ========== */
.card{background:var(--white);border:1px solid var(--faint);border-radius:var(--radius);overflow:hidden;margin-bottom:16px;}
.card-header{padding:14px 18px;border-bottom:1px solid var(--faint);display:flex;align-items:center;justify-content:space-between;}
.card-title{font-size:.88rem;font-weight:700;color:var(--ink);}
.card-body{padding:18px;}

/* ========== STAT CARD ========== */
.stat-card{
  background:var(--white);border:1px solid var(--faint);border-radius:var(--radius);
  padding:16px;display:flex;align-items:center;gap:14px;
}
.stat-icon{width:42px;height:42px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0;}
.stat-value{font-size:1.6rem;font-weight:800;color:var(--ink);letter-spacing:-1px;line-height:1;}
.stat-label{font-size:.7rem;color:var(--muted);font-weight:500;margin-top:3px;}

/* ========== TABLE ========== */
.table-wrap{overflow-x:auto;-webkit-overflow-scrolling:touch;}
table{width:100%;border-collapse:collapse;font-size:.82rem;}
thead th{background:var(--bg);padding:10px 14px;text-align:left;font-size:.68rem;font-weight:700;letter-spacing:.5px;text-transform:uppercase;color:var(--muted);white-space:nowrap;}
tbody td{padding:11px 14px;border-bottom:1px solid var(--faint);color:var(--ink);vertical-align:middle;}
tbody tr:last-child td{border-bottom:none;}
tbody tr:hover td{background:#FAFAFA;}

/* ========== BADGE ========== */
.badge{display:inline-flex;align-items:center;padding:2px 9px;border-radius:99px;font-size:.68rem;font-weight:700;}
.badge-green{background:#DCFCE7;color:#15803D;}
.badge-red{background:#FEE2E2;color:#DC2626;}
.badge-yellow{background:var(--y3);color:#92400E;}
.badge-blue{background:#DBEAFE;color:#1D4ED8;}
.badge-gray{background:#F1F5F9;color:var(--muted);}

/* ========== FORMS ========== */
.form-group{margin-bottom:16px;}
.form-label{display:block;font-size:.78rem;font-weight:600;color:var(--ink);margin-bottom:6px;}
.form-control{
  width:100%;padding:9px 12px;border:1px solid var(--faint);
  border-radius:8px;font-size:.83rem;font-family:'Inter',sans-serif;
  color:var(--ink);background:var(--white);transition:border .15s;outline:none;
}
.form-control:focus{border-color:var(--y);box-shadow:0 0 0 3px rgba(251,191,0,.15);}
textarea.form-control{resize:vertical;min-height:80px;}
select.form-control{cursor:pointer;}

/* ========== BUTTONS ========== */
.btn{
  display:inline-flex;align-items:center;gap:7px;
  padding:9px 16px;border-radius:8px;border:none;cursor:pointer;
  font-size:.8rem;font-weight:700;font-family:'Inter',sans-serif;
  transition:all .15s;text-decoration:none;white-space:nowrap;
}
.btn-primary{background:var(--y);color:var(--ink);}
.btn-primary:hover{background:var(--y2);}
.btn-secondary{background:var(--bg);color:var(--ink);border:1px solid var(--faint);}
.btn-secondary:hover{background:var(--faint);}
.btn-danger{background:#FEE2E2;color:var(--red);border:1px solid #FECACA;}
.btn-danger:hover{background:#FECACA;}
.btn-sm{padding:6px 12px;font-size:.75rem;}
.btn-icon{padding:7px;border-radius:7px;}

/* ========== ALERTS ========== */
.alert{padding:12px 16px;border-radius:8px;font-size:.82rem;font-weight:500;margin-bottom:16px;}
.alert-success{background:#DCFCE7;color:#15803D;border:1px solid #BBF7D0;}
.alert-error{background:#FEE2E2;color:#DC2626;border:1px solid #FECACA;}

/* ========== SECTION TABS ========== */
.section-tabs{display:flex;gap:4px;flex-wrap:wrap;margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid var(--faint);}
.stab{
  padding:7px 14px;border-radius:8px;border:1px solid var(--faint);
  font-size:.78rem;font-weight:600;color:var(--muted);
  background:var(--white);cursor:pointer;transition:all .15s;
}
.stab:hover{border-color:var(--y);color:var(--ink);}
.stab.active{background:var(--y);color:var(--ink);border-color:var(--y);}
.section-group{display:none;}
.section-group.active{display:block;}

/* ========== RESPONSIVE ========== */
@media(max-width: 768px){
  .sidebar{transform:translateX(-100%);}
  .sidebar.open{transform:translateX(0);}
  .sidebar-overlay.open{display:block;}
  .topbar{left:0;}
  .topbar-ham{display:block;}
  .main-wrap{margin-left:0;}
  .page-content{padding:16px 14px 40px;}
  .topbar-btn span{display:none;}
  .topbar-btn{padding:6px 8px;}
}
@media(max-width: 480px){
  .topbar{padding:0 12px;}
  .topbar-title{font-size:.82rem;}
  .card-body{padding:14px;}
  table{font-size:.76rem;}
  thead th,tbody td{padding:8px 10px;}
}
.footer-logo-img{height:35px;width:auto;display:block;object-fit:contain;margin-bottom:12px;}
</style>
</head>
<body>

{{-- Overlay for mobile --}}
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

{{-- SIDEBAR --}}
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <img src="/images/logo-footer.png" alt="{{ $settings['site_name'] ?? 'SIP Bangunan' }}" class="footer-logo-img">
        <div class="brand-sub">Admin CMS</div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Menu</div>

        <a href="{{ route('admin.dashboard') }}"
           class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
            </svg>
            Dashboard
        </a>

        <a href="{{ route('admin.categories.index') }}"
           class="nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/>
            </svg>
            Kategori
        </a>

        <a href="{{ route('admin.products.index') }}"
           class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/>
                <path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/>
            </svg>
            Produk
        </a>

        <div class="nav-section-label">Pengguna</div>

        <a href="{{ route('admin.users.index') }}"
           class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
            </svg>
            Manajemen User
        </a>

        <div class="nav-section-label">Pengaturan</div>

        <a href="{{ route('admin.settings.index') }}"
           class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="3"/>
                <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/>
            </svg>
            Pengaturan
        </a>

        <div class="nav-section-label">Eksternal</div>

        <a href="https://webmail.sipbangunan.com" target="_blank" class="nav-item">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                <polyline points="22,6 12,13 2,6"/>
            </svg>
            Webmail
            <svg style="width:10px;height:10px;margin-left:auto;opacity:.4;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
        </a>

        <a href="{{ route('home') }}" target="_blank" class="nav-item">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/>
                <path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/>
            </svg>
            Lihat Website
            <svg style="width:10px;height:10px;margin-left:auto;opacity:.4;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="su-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
            <div>
                <div class="su-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                <div class="su-role">{{ auth()->user()->role ?? 'Administrator' }}</div>
            </div>
        </div>
        <form action="{{ route('admin.logout') }}" method="POST" style="margin-top:8px;">
            @csrf
            <button type="submit" class="nav-item" style="width:100%;background:none;border:none;cursor:pointer;color:rgba(255,255,255,.4);">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Logout
            </button>
        </form>
    </div>
</aside>

{{-- TOPBAR --}}
<header class="topbar">
    <button class="topbar-ham" onclick="toggleSidebar()" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>
    <div class="topbar-title">@yield('page_title', 'Dashboard')</div>
    <div class="topbar-right">
        <a href="{{ route('admin.settings.index') }}#tab-pixel" class="topbar-btn">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
            <span>Settings</span>
        </a>
        <a href="{{ route('admin.products.create') }}" class="topbar-btn primary">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            <span>Produk Baru</span>
        </a>
    </div>
</header>

{{-- MAIN --}}
<main class="main-wrap">
    <div class="page-content">
        @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-error">❌ {{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</main>

<script>
function toggleSidebar(){
    document.getElementById('sidebar').classList.toggle('open');
    document.getElementById('sidebarOverlay').classList.toggle('open');
}
function closeSidebar(){
    document.getElementById('sidebar').classList.remove('open');
    document.getElementById('sidebarOverlay').classList.remove('open');
}
// Close sidebar on ESC
document.addEventListener('keydown', e => { if(e.key==='Escape') closeSidebar(); });
</script>
@stack('scripts')
</body>
</html>
