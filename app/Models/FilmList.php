<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmList extends Model
{
    use HasFactory;

    protected $table = 'film_list';

    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id');
    }

    public function list()
    {
        return $this->belongsTo(ListClass::class, 'list_id');
    }
}

