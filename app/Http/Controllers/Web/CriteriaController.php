<?php

namespace App\Http\Controllers\Web;

use App\Helpers\UserActivity;
use App\Models\Criteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $criterias = Criteria::all();

        return view('admin-panel.pages.criteria.index', compact('criterias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-panel.pages.criteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required'
        ];

        $messages = [
            'name.required' => 'Nama kriteria wajib diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $criteria = Criteria::create($request->all());
        UserActivity::addToLog('Menambahkan kriteria : ' . $criteria->name);

        return redirect()->route('admin-panel.criteria.index')->with('success', 'Kriteria berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Criteria $criteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $criteria = Criteria::find($id);

        return view('admin-panel.pages.criteria.edit', compact('criteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $criteria = Criteria::find($id);
        
        $rules = [
            'name' => 'required'
        ];

        $messages = [
            'name.required' => 'Nama kriteria wajib diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $criteria->update($request->all());
        UserActivity::addToLog('Mengedit kriteria : ' . $criteria->name);

        return redirect()->route('admin-panel.criteria.index')->with('success', 'Kriteria berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $criteria = Criteria::find($id);

        if($criteria->evidence()->count() > 0) {
            return redirect()->back()->with('error', 'Kriteria ini memiliki data relasi dengan data Barang Bukti');
        }
        UserActivity::addToLog('Menghapus kriteria : ' . $criteria->name);
        $criteria->delete();

        return back()->with('success', 'Kriteria berhasil dihapus');
    }
}
