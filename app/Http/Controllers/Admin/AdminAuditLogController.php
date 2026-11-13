<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminAuditLogController extends Controller
{
    public function index(Request $request): View
    {
        abort_unless(auth()->user()->hasRole('admin'), 403, 'Acceso restringido a administradores.');

        $query = AuditLog::with('user');

        if ($action = $request->input('action')) {
            $query->where('action', $action);
        }

        $logs = $query->latest('id')->paginate(20)->withQueryString();

        return view('admin.audit-logs.index', compact('logs'));
    }
}
