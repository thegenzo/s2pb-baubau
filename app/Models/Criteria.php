<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function criminal_perpetrator()
    {
        return $this->hasMany(CriminalPerpetrator::class);
    }
}
