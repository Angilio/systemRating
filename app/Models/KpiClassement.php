<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpiClassement extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'kpi_id', 'rang', 'poids'];
    
    public function kpi()
    {
        return $this->belongsTo(Kpi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
