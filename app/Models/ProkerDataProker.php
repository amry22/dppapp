<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProkerDataProker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'division_id',
        'department_id',
        'year'
    ];

    function division() {
        return $this->belongsTo(DataDivision::class, 'division_id', 'id');
    }

    function department() {
        return $this->belongsTo(DataDepartment::class, 'department_id', 'id');
    }

    function implementation() {
        return $this->hasMany(ProkerDataImplementation::class, 'proker_data_prokers_id', 'id');
    }
}
