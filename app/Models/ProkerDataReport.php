<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProkerDataReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'proker_data_implementations_id',
        'division_id',
        'department_id',
         "status",
         "description",
         "follow_up"
      ];
 
      function implementation() {
       return $this->belongsTo(ProkerDataImplementation::class, 'proker_data_implementations_id', 'id');
      }
}
