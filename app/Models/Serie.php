<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Serie extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'date_sortie', 'overview', 'companyNames', 'genres', 'runtime', 'number_of_seasons', 'number_of_episodes', 'urlImage'];

    /**
     * Define a many-to-many relationship with the "Liste" model.
     */
    public function listes(): BelongsToMany
    {
        return $this->belongsToMany(Liste::class, 'serie_liste', 'serie_id', 'liste_id');
    }

    public function ratings()
    {
        return $this->hasMany(RatingSerie::class);
    }
}
