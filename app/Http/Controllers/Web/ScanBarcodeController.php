<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Evidence;
use Illuminate\Http\Request;

class ScanBarcodeController extends Controller
{
    public function index()
    {
        return view('admin-panel.pages.scan.index');
    }
    
    public function show($register)
    {
        $evidence = Evidence::where('register_number', $register)->first();

        return view('admin-panel.pages.scan.show', compact('evidence'));
    }
}
