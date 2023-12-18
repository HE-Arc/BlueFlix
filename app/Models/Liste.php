<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Liste extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'urlImage', 'user_id', 'deleteable'];

    /**
     * Define the relationship with the "User" model (assuming Liste is associated with a user).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define the many-to-many relationship with the "Film" model.
     */
    public function films()
    {
        return $this->belongsToMany(Film::class, 'film_liste', 'liste_id', 'film_id');
    }

    /**
     * Define the many-to-many relationship with the "Serie" model.
     */
    public function series()
    {
        return $this->belongsToMany(Serie::class, 'serie_liste', 'liste_id', 'serie_id');
    }
}
