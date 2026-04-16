<?php
// ============================================================
// FILE: app/Http/Controllers/Admin/DashboardController.php  (GANTI)
// ============================================================
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\VisitorLog;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'categories'      => Category::count(),
            'products'        => Product::count(),
            'active_products' => Product::where('is_active', true)->count(),
            'today_unique'    => VisitorLog::todayUnique(),
            'today_hits'      => VisitorLog::todayHits(),
            'total_unique'    => VisitorLog::totalUnique(),
        ];

        $chart = VisitorLog::last7Days();

        return view('admin.dashboard', compact('stats', 'chart'));
    }
}
