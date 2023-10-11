<?php

namespace App\Http\Controllers\Web;

use App\Helpers\UserActivity;
use App\Models\Evidence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EvidenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evidences = Evidence::latest()->get();

        return view('admin-panel.pages.evidence.index', compact('evidences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-panel.pages.evidence.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'criminal_perpetrator_id'       => 'required',
            'criteria_id'                   => 'required',
            'register_number'               => 'required|numeric|unique:evidence',
            'name'                          => 'required',
            'amount'                        => 'required|numeric',
            'unit'                          => 'required',
            'description'                   => 'required',
            'entry_date'                    => 'required|date',
            'storage_location'              => 'required',
        ];

        $messages = [
            'criminal_perpetrator_id.required'           => 'Pemilik BB wajib diisi',
            'criteria_id.required'                       => 'Kriteria wajib diisi',
            'register_number.required'                   => 'Nomor Registrasi wajib diisi',
            'register_number.numeric'                    => 'Nomor Registrasi harus berupa angka',
            'register_number.unique'                     => 'Nomor Registrasi sudah terdaftar',
            'name.required'                              => 'Nama BB wajib diisi',
            'amount.required'                            => 'Jumlah wajib diisi',
            'amount.numeric'                             => 'Jumlah harus berupa angka',
            'unit.required'                              => 'Satuan wajib diisi',
            'description.required'                       => 'Deskripsi wajib diisi',
            'entry_date.required'                        => 'Tanggal Masuk wajib diisi',
            'entry_date.date'                            => 'Tanggal Masuk harus berupa tanggal',
            'storage_location.required'                  => 'Lokasi Penyimpanan wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $data = $request->all();
        $data['criminal_perpetrator_id'] = $request->criminal_perpetrator_id;
        $data['criteria_id'] = $request->criteria_id;

        $evidence = Evidence::create($data);

        $evidence->evidence_transaction()->create([
            'transaction_date' => Date::now(),
            'transaction_type' => 'in',
            'notes' => 'Barang masuk di ' . $evidence->storage_location
        ]);

        UserActivity::addToLog('Menambahkan Data Barang Bukti Baru : ' . $evidence->name);

        return redirect()->route('admin-panel.evidence.index')->with('success', 'Data Barang Bukti Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Evidence $evidence)
    {
        return view('admin-panel.pages.evidence.show', compact('evidence'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evidence $evidence)
    {
        return view('admin-panel.pages.evidence.edit', compact('evidence'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evidence $evidence)
    {
        $rules = [
            'criminal_perpetrator_id'       => 'required',
            'criteria_id'                   => 'required',
            'register_number'               => 'required|numeric|unique:evidence',
            'name'                          => 'required',
            'amount'                        => 'required|numeric',
            'unit'                          => 'required',
            'description'                   => 'required',
            'entry_date'                    => 'required|date',
            'storage_location'              => 'required',
        ];

        $messages = [
            'criminal_perpetrator_id.required'           => 'Pemilik BB wajib diisi',
            'criteria_id.required'                       => 'Kriteria wajib diisi',
            'register_number.required'                   => 'Nomor Registrasi wajib diisi',
            'register_number.numeric'                    => 'Nomor Registrasi harus berupa angka',
            'register_number.unique'                     => 'Nomor Registrasi sudah terdaftar',
            'name.required'                              => 'Nama BB wajib diisi',
            'amount.required'                            => 'Jumlah wajib diisi',
            'amount.numeric'                             => 'Jumlah harus berupa angka',
            'unit.required'                              => 'Satuan wajib diisi',
            'description.required'                       => 'Deskripsi wajib diisi',
            'entry_date.required'                        => 'Tanggal Masuk wajib diisi',
            'entry_date.date'                            => 'Tanggal Masuk harus berupa tanggal',
            'storage_location.required'                  => 'Lokasi Penyimpanan wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $data = $request->all();
        $data['criminal_perpetrator_id'] = $request->criminal_perpetrator_id;
        $data['criteria_id'] = $request->criteria_id;

        $evidence->update($data);

        UserActivity::addToLog('Mengedit Barang Bukti : ' . $evidence->name);

        return redirect()->route('admin-panel.evidence.index')->with('success', 'Barang Bukti Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evidence $evidence)
    {
        $evidence->evidence_transaction()->delete();

        foreach ($evidence->evidence_photo()->get() as $data) {
            File::delete($data->image);
            $data->delete();
        }

        UserActivity::addToLog('Menghapus Data Barang Bukti : ' . $evidence->name);

        $evidence->delete();

        return back()->with('success', 'Data Barang Bukti berhasil dihapus');
    }
}
