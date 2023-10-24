<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmListe extends Model
{
    use HasFactory;

    protected $table = 'film_liste';

    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id');
    }

    public function liste()
    {
        return $this->belongsTo(Liste::class, 'liste_id');
    }
}

