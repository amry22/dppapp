<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProkerDataImplementation extends Model
{
    use HasFactory;

    protected $casts = [
        'timeline' => 'array',
        'budget_source' => 'array',
    ];

    protected $fillable = [
        'proker_data_prokers_id',
        'name',
        'target',
        'timeline',
        'budget',
        'budget_source',
    ];

    function proker() {
        return $this->belongsTo(ProkerDataProker::class, 'proker_data_prokers_id', 'id');
    }

    function report(){
        return $this->hasOne(ProkerDataReport::class, 'proker_data_implementations_id', 'id');
    }
}
