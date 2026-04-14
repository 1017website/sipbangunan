<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Admin – SIP Bangunan</title>
<style>
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;background:#F3F4F6;display:flex;align-items:center;justify-content:center;min-height:100vh;}
.login-box{background:#fff;border-radius:16px;border:1px solid #E5E7EB;padding:40px;width:100%;max-width:380px;}
.login-logo{text-align:center;margin-bottom:28px;}
.login-brand{font-size:1.4rem;font-weight:800;color:#111;}
.login-brand span{color:#FBBF00;}
.login-sub{font-size:.78rem;color:#6B7280;margin-top:4px;}
.form-group{margin-bottom:16px;}
label{display:block;font-size:.78rem;font-weight:600;color:#374151;margin-bottom:6px;}
input{width:100%;padding:10px 12px;border:1.5px solid #D1D5DB;border-radius:8px;font-size:.85rem;font-family:inherit;transition:border-color .18s;}
input:focus{outline:none;border-color:#FBBF00;box-shadow:0 0 0 3px rgba(251,191,0,.15);}
.btn-login{width:100%;padding:12px;background:#FBBF00;color:#111;border:none;border-radius:8px;font-size:.88rem;font-weight:700;cursor:pointer;margin-top:8px;transition:background .18s;font-family:inherit;}
.btn-login:hover{background:#E6AE00;}
.error{background:#FEF2F2;color:#DC2626;border:1px solid #FECACA;padding:10px 14px;border-radius:8px;font-size:.8rem;margin-bottom:16px;}
.remember{display:flex;align-items:center;gap:8px;font-size:.8rem;color:#6B7280;margin-bottom:4px;}
.remember input{width:auto;}
</style>
</head>
<body>
<div class="login-box">
    <div class="login-logo">
        <div class="login-brand">SIP <span>Bangunan</span></div>
        <div class="login-sub">Admin CMS Panel</div>
    </div>

    @if($errors->any())
    <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@sipbangunan.com" required autofocus>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="••••••••" required>
        </div>
        <div class="remember">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Ingat saya</label>
        </div>
        <button type="submit" class="btn-login">Masuk ke CMS</button>
    </form>
</div>
</body>
</html>
