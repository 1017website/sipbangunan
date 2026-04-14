<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'CMS') – Admin SIP Bangunan</title>
<style>
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;background:#F3F4F6;color:#111827;min-height:100vh;display:flex;}
/* SIDEBAR */
.sidebar{width:240px;background:#111827;min-height:100vh;position:fixed;top:0;left:0;bottom:0;display:flex;flex-direction:column;z-index:100;}
.sidebar-brand{padding:20px 24px;border-bottom:1px solid rgba(255,255,255,.08);}
.brand-name{font-size:1rem;font-weight:800;color:#fff;letter-spacing:-.3px;}
.brand-sub{font-size:.65rem;color:rgba(255,255,255,.4);letter-spacing:1px;text-transform:uppercase;margin-top:2px;}
.nav{padding:16px 12px;flex:1;}
.nav-section{font-size:.6rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,.3);padding:12px 12px 6px;}
.nav-item{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:8px;color:rgba(255,255,255,.6);text-decoration:none;font-size:.83rem;font-weight:500;transition:all .18s;margin-bottom:2px;}
.nav-item:hover{background:rgba(255,255,255,.07);color:#fff;}
.nav-item.active{background:#FBBF00;color:#111;}
.nav-item .icon{width:18px;text-align:center;font-size:1rem;}
.sidebar-bottom{padding:16px 12px;border-top:1px solid rgba(255,255,255,.08);}
.user-info{display:flex;align-items:center;gap:10px;margin-bottom:12px;}
.user-avatar{width:32px;height:32px;background:#FBBF00;border-radius:8px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.85rem;color:#111;flex-shrink:0;}
.user-name{font-size:.8rem;font-weight:600;color:#fff;}
.user-email{font-size:.68rem;color:rgba(255,255,255,.4);}
.logout-btn{display:flex;align-items:center;gap:8px;width:100%;padding:9px 12px;border-radius:8px;background:rgba(255,255,255,.05);border:none;color:rgba(255,255,255,.5);font-size:.8rem;cursor:pointer;transition:all .18s;font-family:inherit;}
.logout-btn:hover{background:rgba(239,68,68,.15);color:#F87171;}
/* MAIN */
.main{margin-left:240px;flex:1;min-height:100vh;display:flex;flex-direction:column;}
.topbar{background:#fff;border-bottom:1px solid #E5E7EB;padding:0 32px;height:60px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50;}
.topbar-title{font-size:1rem;font-weight:700;color:#111;}
.page-content{padding:32px;flex:1;}
/* CARDS */
.card{background:#fff;border-radius:12px;border:1px solid #E5E7EB;overflow:hidden;}
.card-header{padding:16px 20px;border-bottom:1px solid #E5E7EB;display:flex;align-items:center;justify-content:space-between;}
.card-title{font-size:.9rem;font-weight:700;color:#111;}
.card-body{padding:20px;}
/* FORMS */
.form-group{margin-bottom:18px;}
.form-label{display:block;font-size:.78rem;font-weight:600;color:#374151;margin-bottom:6px;}
.form-control{width:100%;padding:9px 12px;border:1.5px solid #D1D5DB;border-radius:8px;font-size:.85rem;color:#111;font-family:inherit;transition:border-color .18s;background:#fff;}
.form-control:focus{outline:none;border-color:#FBBF00;box-shadow:0 0 0 3px rgba(251,191,0,.15);}
textarea.form-control{resize:vertical;min-height:90px;}
.form-check{display:flex;align-items:center;gap:8px;}
.form-check input[type=checkbox]{width:16px;height:16px;accent-color:#FBBF00;}
/* BUTTONS */
.btn{display:inline-flex;align-items:center;gap:6px;padding:9px 16px;border-radius:8px;font-size:.82rem;font-weight:600;cursor:pointer;border:none;transition:all .18s;text-decoration:none;font-family:inherit;}
.btn-primary{background:#FBBF00;color:#111;}
.btn-primary:hover{background:#E6AE00;}
.btn-secondary{background:#F3F4F6;color:#374151;border:1px solid #D1D5DB;}
.btn-secondary:hover{background:#E5E7EB;}
.btn-danger{background:#FEF2F2;color:#DC2626;border:1px solid #FECACA;}
.btn-danger:hover{background:#FEE2E2;}
.btn-sm{padding:6px 12px;font-size:.75rem;}
/* TABLE */
.table{width:100%;border-collapse:collapse;}
.table th{padding:10px 14px;text-align:left;font-size:.72rem;font-weight:700;letter-spacing:.5px;text-transform:uppercase;color:#6B7280;background:#F9FAFB;border-bottom:1px solid #E5E7EB;}
.table td{padding:12px 14px;border-bottom:1px solid #F3F4F6;font-size:.83rem;color:#111;vertical-align:middle;}
.table tr:last-child td{border-bottom:none;}
.table tr:hover td{background:#FAFAFA;}
/* BADGES */
.badge{display:inline-flex;align-items:center;padding:3px 8px;border-radius:99px;font-size:.68rem;font-weight:700;}
.badge-green{background:#D1FAE5;color:#065F46;}
.badge-gray{background:#F3F4F6;color:#6B7280;}
/* ALERT */
.alert{padding:12px 16px;border-radius:8px;font-size:.83rem;margin-bottom:20px;}
.alert-success{background:#D1FAE5;color:#065F46;border:1px solid #A7F3D0;}
.alert-danger{background:#FEF2F2;color:#DC2626;border:1px solid #FECACA;}
/* STATS */
.stats-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px;}
.stat-card{background:#fff;border:1px solid #E5E7EB;border-radius:12px;padding:20px;display:flex;align-items:center;gap:16px;}
.stat-icon{width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0;}
.stat-value{font-size:1.6rem;font-weight:800;color:#111;letter-spacing:-1px;line-height:1;}
.stat-label{font-size:.75rem;color:#6B7280;margin-top:2px;}
/* SECTION TABS */
.section-tabs{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:20px;}
.stab{font-size:.75rem;font-weight:600;padding:6px 14px;border-radius:8px;cursor:pointer;background:#F3F4F6;color:#6B7280;border:none;}
.stab.active{background:#FBBF00;color:#111;}
.section-group{display:none;}
.section-group.active{display:block;}
/* SPECS TABLE */
.specs-list{display:flex;flex-direction:column;gap:8px;}
.spec-row{display:flex;gap:8px;align-items:center;}
.spec-row .form-control{flex:1;}
.spec-remove{background:#FEF2F2;border:none;color:#DC2626;width:32px;height:32px;border-radius:6px;cursor:pointer;font-size:1rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.view-site{display:inline-flex;align-items:center;gap:6px;font-size:.8rem;color:#6B7280;text-decoration:none;transition:color .18s;}
.view-site:hover{color:#FBBF00;}
</style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-name">SIP Bangunan</div>
        <div class="brand-sub">Admin CMS</div>
    </div>
    <nav class="nav">
        <div class="nav-section">Menu</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="icon">📊</span> Dashboard
        </a>
        <a href="{{ route('admin.categories.index') }}" class="nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <span class="icon">📂</span> Kategori
        </a>
        <a href="{{ route('admin.products.index') }}" class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <span class="icon">📦</span> Produk
        </a>
        <a href="{{ route('admin.settings.index') }}" class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <span class="icon">⚙️</span> Pengaturan
        </a>
    </nav>
    <div class="sidebar-bottom">
        <div class="user-info">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
            <div>
                <div class="user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                <div class="user-email">{{ auth()->user()->email ?? '' }}</div>
            </div>
        </div>
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">🚪 Keluar</button>
        </form>
    </div>
</aside>

<div class="main">
    <div class="topbar">
        <div class="topbar-title">@yield('page_title', 'Dashboard')</div>
        <a href="{{ route('home') }}" target="_blank" class="view-site">🌐 Lihat Website</a>
    </div>
    <div class="page-content">
        @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $e)<div>• {{ $e }}</div>@endforeach
        </div>
        @endif
        @yield('content')
    </div>
</div>

@stack('scripts')
</body>
</html>
