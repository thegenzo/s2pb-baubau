<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
    use HasFactory;

    protected $fillable = [
        'criminal_perpetrator_id',
        'criteria_id',
        'register_number',
        'name',
        'amount',
        'unit',
        'description',
        'entry_date',
        'storage_location'
    ];

    public function criminal_perpetrator()
    {
        return $this->belongsTo(CriminalPerpetrator::class);
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

    public function evidence_photo()
    {
        return $this->hasMany(EvidencePhoto::class);
    }

    public function evidence_transaction()
    {
        return $this->hasMany(EvidenceTransaction::class);
    }
}
