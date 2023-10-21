<?php

namespace App\Http\Controllers\Web;

use App\Helpers\UserActivity;
use Illuminate\Http\Request;
use App\Models\EvidenceTransaction;
use App\Http\Controllers\Controller;
use App\Models\Evidence;
use Illuminate\Support\Facades\Date;
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
    public function evidenceIn(Request $request, $id)
    {
        $rules = [
            'notes' => 'required',
        ];

        $messages = [
            'notes.required'  => 'Keterangan wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $evidence = Evidence::find($id);
        $data = $request->all();
        $data['evidence_id'] = $evidence->id;
        $data['transaction_date'] = Date::now();
        $data['transaction_type'] = 'in';
        $transaction = EvidenceTransaction::create($data);

        UserActivity::addToLog('Menambahkan data transaksi BB Masuk pada BB : ' . $evidence->name . ' : ' . $transaction->transaction_type . ' ' . '. PS : ' . $transaction->notes);

        return redirect()->back()->with('success', 'Transaksi BB Masuk berhasil ditambahkan');
    }

    public function evidenceOut(Request $request, $id)
    {
        $rules = [
            'notes' => 'required',
        ];

        $messages = [
            'notes.required'  => 'Keterangan wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $evidence = Evidence::find($id);
        $data = $request->all();
        $data['evidence_id'] = $evidence->id;
        $data['transaction_date'] = Date::now();
        $data['transaction_type'] = 'out';
        $transaction = EvidenceTransaction::create($data);

        UserActivity::addToLog('Menambahkan data transaksi BB Keluar pada BB : ' . $evidence->name . ' : ' . $transaction->transaction_type . ' ' . '. PS : ' . $transaction->notes);

        return redirect()->back()->with('success', 'Transaksi BB Keluar berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvidenceTransaction $evidenceTransaction)
    {
        
    }
}
