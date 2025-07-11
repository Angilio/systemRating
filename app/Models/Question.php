<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'kpi_id',
        'intitule',
        'type'
    ];

    public function options() { 
        return $this->hasMany(Option::class); 
    }
    public function kpi() { 
        return $this->belongsTo(Kpi::class); 
    }
}
