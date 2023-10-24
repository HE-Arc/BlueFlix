<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerieListe extends Model
{
    use HasFactory;

    protected $table = 'serie_liste';

    public function serie()
    {
        return $this->belongsTo(Serie::class, 'serie_id');
    }

    public function liste()
    {
        return $this->belongsTo(Liste::class, 'liste_id');
    }
}

