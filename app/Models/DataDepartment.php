<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDepartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_division_id',
        'name'
    ];
 
     function division() {
         return $this->belongsTo(DataDivision::class, 'data_division_id', 'id');
    }
}
