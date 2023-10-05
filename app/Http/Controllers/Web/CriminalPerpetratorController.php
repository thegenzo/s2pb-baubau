<?php

namespace App\Http\Controllers\Web;

use App\Helpers\UserActivity;
use Illuminate\Http\Request;
use App\Models\CriminalPerpetrator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CriminalPerpetratorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $criminals = CriminalPerpetrator::all();

        return view('admin-panel.pages.criminal.index', compact('criminals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-panel.pages.criminal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name'                  => 'required',
            'date_of_birth'         => 'required|date',
            'place_of_birth'        => 'required',
            'gender'                => 'required',
            'address'               => 'required',
            'identification_number' => 'required|number|unique:criminal_perpetrators',
        ];

        $messages = [
            'name.required'                     => 'Nama pelaku tindak pidana wajib diisi',
            'date_of_birth.required'            => 'Tanggal lahir pelaku tindak pidana wajib diisi',
            'date_of_birth.date'                => 'Tanggal lahir pelaku tindak pidana harus berupa tanggal',
            'gender.required'                   => 'Jenis kelamin pelaku tindak pidana wajib diisi',
            'address.required'                  => 'Alamat pelaku tindak pidana wajib diisi',
            'identification_number.required'    => 'Nomor identitas pelaku tindak pidana wajib diisi',
            'identification_number.number'      => 'Nomor identitas pelaku tindak pidana harus berupa angka',
            'identification_number.unique'      => 'Nomor identitas pelaku tindak pidana sudah terdata',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $criminal = CriminalPerpetrator::create($request->all());
        UserActivity::addToLog('Menambahkan data pelaku tindak pidana ' + $criminal->name);

        return redirect()->route('admin-panel.criminal.index')->with('success', 'Pelaku tindak pidana berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(CriminalPerpetrator $criminalPerpetrator)
    {
        return view('admin-panel.pages.criminal.show', compact('criminalPerpetrator'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CriminalPerpetrator $criminalPerpetrator)
    {
        return view('admin-panel.pages.criminal.edit', compact('criminalPerpetrator'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CriminalPerpetrator $criminalPerpetrator)
    {
        $rules = [
            'name'                  => 'required',
            'date_of_birth'         => 'required|date',
            'place_of_birth'        => 'required',
            'gender'                => 'required',
            'address'               => 'required',
            'identification_number' => 'required|number',
        ];

        $messages = [
            'name.required'                     => 'Nama pelaku tindak pidana wajib diisi',
            'date_of_birth.required'            => 'Tanggal lahir pelaku tindak pidana wajib diisi',
            'date_of_birth.date'                => 'Tanggal lahir pelaku tindak pidana harus berupa tanggal',
            'gender.required'                   => 'Jenis kelamin pelaku tindak pidana wajib diisi',
            'address.required'                  => 'Alamat pelaku tindak pidana wajib diisi',
            'identification_number.required'    => 'Nomor identitas pelaku tindak pidana wajib diisi',
            'identification_number.number'      => 'Nomor identitas pelaku tindak pidana harus berupa angka',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $criminalPerpetrator->update($request->all());
        UserActivity::addToLog('Mengedit data pelaku tindak pidana ' + $criminalPerpetrator->name);

        return redirect()->route('admin-panel.criminal.index')->with('success', 'Pelaku tindak pidana berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CriminalPerpetrator $criminalPerpetrator)
    {
        if($criminalPerpetrator->evidence()->count() > 0) {
            return back()->with('error', 'Data pelaku tindak pidana ini memiliki data relasi dengan data Barang Bukti');
        }
        UserActivity::addToLog('Menghapus data pelaku tindak pidana ' + $criminalPerpetrator);
        return back()->with('success', 'Pelaku tindak pidana berhasil dihapus');
    }
}
