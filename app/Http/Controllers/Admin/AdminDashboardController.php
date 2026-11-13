<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Media;
use App\Models\Sighting;
use App\Models\Species;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $metrics = [
            'total_species' => Species::count(),
            'active_species' => Species::active()->count(),
            'total_sightings' => Sighting::count(),
            'pending_sightings' => Sighting::pending()->count(),
            'approved_sightings' => Sighting::approved()->count(),
            'total_media' => Media::count(),
            'total_users' => User::count(),
        ];

        $recentSightings = Sighting::with(['species', 'user', 'location'])
            ->latest('id')
            ->take(5)
            ->get();

        $recentLogs = AuditLog::with('user')
            ->latest('id')
            ->take(8)
            ->get();

        return view('admin.dashboard', compact('metrics', 'recentSightings', 'recentLogs'));
    }
}
