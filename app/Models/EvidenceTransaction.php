<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvidenceTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'evidence_id',
        'transaction_date',
        'transaction_type',
        'notes',
        'image',
    ];

    public function evidence()
    {
        return $this->belongsTo(Evidence::class);
    }

    public function getTransactionDateAttribute($value)
    {
        return Carbon::parse($value)->locale('id')->isoFormat('LL');
    }

    public function getTransactionTypeAttribute($value)
    {
        $type = '';
        if($value == 'in') {
            $type = 'Barang Masuk';
        } else if($value == 'out') {
            $type = 'Barang Keluar';
        } else if($value == 'returned') {
            $type = 'Dikembalikan';
        } else {
            $type = 'Dimusnahkan';
        }

        return $type;
    }
}
