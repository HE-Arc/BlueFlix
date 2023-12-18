<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingFilm extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = ['film_id', 'user_id', 'rating'];

    protected $primaryKey = ['film_id', 'user_id'];

    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
