<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvidencePhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'evidence_id',
        'image'
    ];

    public function evidence()
    {
        return $this->belongsTo(Evidence::class);
    }
}
