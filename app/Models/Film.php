<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Film extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'date_sortie', 'overview', 'companyNames', 'genres', 'runtime', 'urlImage'];

    /**
     * Define a many-to-many relationship with the "Liste" model.
     */
    public function listes(): BelongsToMany
    {
        return $this->belongsToMany(Liste::class, 'film_liste', 'film_id', 'liste_id');
    }
}
