<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mention extends Model
{
    use HasFactory;

    protected $fillable =[
        'Libelee',
        'name',
        'description',
        'Etabli_id',
        'note',
        'rang'
    ];

    public function etablissement() {
         return $this->belongsTo(Etablissement::class, 'Etabli_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function tauxReussites()
    {
        return $this->hasMany(TauxReussite::class);
    }
}
