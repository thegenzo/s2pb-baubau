<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CriminalPerpetrator;
use App\Models\Evidence;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = User::where('level', 'admin')->count();
        $user = User::where('level', 'user')->count();
        $criminal = CriminalPerpetrator::count();
        $detainedEvidence = Evidence::where('status', 'detained')->count();
        $returnedEvidence = Evidence::where('status', 'returned')->count();
        $terminatedEvidence = Evidence::where('status', 'terminated')->count();

        return view('admin-panel.pages.dashboard', compact(
            'admin',
            'user',
            'criminal',
            'detainedEvidence',
            'returnedEvidence',
            'terminatedEvidence'
        ));
    }
}
