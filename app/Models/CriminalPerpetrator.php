<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriminalPerpetrator extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'criteria_id',
        'date_of_birth',
        'place_of_birth',
        'gender',
        'address',
        'identification_number'
    ];

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

    public function evidence()
    {
        return $this->hasMany(Evidence::class);
    }

    public function getGenderAttribute($value)
    {
        $gender = $value == 'male' ? 'Laki-laki' : 'Perempuan';

        return $gender;
    }
}
