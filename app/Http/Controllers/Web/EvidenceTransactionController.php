<?php

namespace App\Http\Controllers\Web;

use App\Helpers\UserActivity;
use Illuminate\Http\Request;
use App\Models\EvidenceTransaction;
use App\Http\Controllers\Controller;
use App\Models\Evidence;
use Illuminate\Support\Facades\Validator;

class EvidenceTransactionController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function index($id)
    {
        $evidence = Evidence::find($id);

        $transactions = $evidence->evidence_transaction()->latest()->get();
        
        return view('admin-panel.pages.evidence.transaction', compact('transactions', 'evidence'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function store(Request $request, $id)
    {
        $rules = [
            'transaction_date'              => 'required|date',
            'transaction_type'              => 'required',
            'notes'                         => 'required',
        ];

        $messages = [
            'transaction_date.required'                  => 'Tanggal Transaksi wajib diisi',
            'transaction_date.date'                      => 'Tanggal Transaksi harus berformat tanggal',
            'transaction_type.required'                  => 'Tipe Transaksi wajib diisi',
            'notes.required'                             => 'Keterangan wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $evidence = Evidence::find($id);
        $data = $request->all();
        $data['evidence_id'] = $evidence->id;
        $transaction = EvidenceTransaction::create($data);

        UserActivity::addToLog('Menambahkan data transaksi baru pada BB ' . $evidence->name . ' : ' . $transaction->transaction_type . ' ' . '. PS : ' . $transaction->notes);

        return redirect()->back()->with('success', 'Data Transaksi BB berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvidenceTransaction $evidenceTransaction)
    {
        
    }
}
