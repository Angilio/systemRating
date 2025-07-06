<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kpi extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];
    
    public function classements()
    {
        return $this->hasMany(KpiClassement::class);
    }
}
