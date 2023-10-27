<?php

namespace App\Http\Controllers\Web;

use App\Helpers\UserActivity;
use App\Models\Evidence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
        $evidences = Evidence::where('status', 'detained')->latest()->get();

        return view('admin-panel.pages.evidence.index', compact('evidences'));
    }
    
    public function returned()
    {
        $evidences = Evidence::where('status', 'returned')->latest()->get();

        return view('admin-panel.pages.evidence.returned', compact('evidences'));
    }
    
    public function terminated()
    {
        $evidences = Evidence::where('status', 'terminated')->latest()->get();

        return view('admin-panel.pages.evidence.terminated', compact('evidences'));
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
            'register_number'               => 'required|unique:evidence',
            'name'                          => 'required',
            'amount'                        => 'required|numeric',
            'unit'                          => 'required',
            'description'                   => 'required',
            'entry_date'                    => 'required|date',
            'storage_location'              => 'required',
        ];

        $messages = [
            'criminal_perpetrator_id.required'           => 'Pemilik BB wajib diisi',
            'register_number.required'                   => 'Nomor Registrasi wajib diisi',
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
    public function show($id)
    {
        $evidence = Evidence::with(['criminal_perpetrator'])->where('id', $id)->first();

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
            'register_number'               => 'required|unique:evidence',
            'name'                          => 'required',
            'amount'                        => 'required|numeric',
            'unit'                          => 'required',
            'description'                   => 'required',
            'entry_date'                    => 'required|date',
            'storage_location'              => 'required',
        ];

        $messages = [
            'criminal_perpetrator_id.required'           => 'Pemilik BB wajib diisi',
            'register_number.required'                   => 'Nomor Registrasi wajib diisi',
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
    public function destroy($id)
    {
        $evidence = Evidence::find($id);

        $evidence->evidence_transaction()->delete();

        foreach ($evidence->evidence_photo()->get() as $data) {
            $path = public_path($data->image);
            if(file_exists($path)) {
                File::delete($data->image);
                $data->delete();
            }
        }

        UserActivity::addToLog('Menghapus Data Barang Bukti : ' . $evidence->name);
        
        $evidence->delete();

        return back()->with('success', 'Data Barang Bukti berhasil dihapus');
    }

    public function print($id)
    {
        $evidence = Evidence::find($id);
        return view('admin-panel.pages.evidence.print', compact('evidence'));
    }

    public function returnEvidence($id)
    {
        $evidence = Evidence::find($id);
        $evidence->status = 'returned';
        $evidence->returned_at = Carbon::now();
        $evidence->save();

        $evidence->evidence_transaction()->create([
            'transaction_type' => 'returned',
            'transaction_date' => Date::now(),
            'notes' => 'Barang Bukti telah dikembalikan'
        ]);

        UserActivity::addToLog('Mengembalikan barang bukti : ' . $evidence->name);

        return back()->with('success', 'Barang Bukti sukses dikembalikan');
    }

    public function terminateEvidence($id)
    {
        $evidence = Evidence::find($id);
        $evidence->status = 'terminated';
        $evidence->terminated_at = Carbon::now();
        $evidence->save();

        $evidence->evidence_transaction()->create([
            'transaction_type' => 'terminated',
            'transaction_date' => Date::now(),
            'notes' => 'Barang Bukti telah dimusnahkan'
        ]);

        UserActivity::addToLog('Memusnahkan barang bukti : ' . $evidence->name);

        return back()->with('success', 'Barang Bukti sukses dimusnahkan');
    }
}
