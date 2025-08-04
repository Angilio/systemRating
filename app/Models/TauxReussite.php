<?php

// app/Models/TauxReussite.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TauxReussite extends Model
{
    use HasFactory;  
    protected $fillable = ['mention_id', 'annee', 'taux'];

    public function mention()
    {
        return $this->belongsTo(Mention::class);
    }
}

