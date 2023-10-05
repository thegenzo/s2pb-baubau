<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvidenceTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'evidence_id',
        'transaction_date',
        'transaction_type',
        'notes'
    ];

    public function evidence()
    {
        return $this->belongsTo(Evidence::class);
    }
}
