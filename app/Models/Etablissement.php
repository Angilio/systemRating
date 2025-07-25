<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
    use HasFactory;

    protected $fillable = [
        'Libelee',
        'name',
        'description',
        'logo',
        'note',
        'rang'
    ];

    public function mentions() {
         return $this->hasMany(Mention::class, 'etabli_id');
    }

    public function users() {
         return $this->hasMany(User::class, 'etablissement_id');
    }
}
