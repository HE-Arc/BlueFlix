<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Film extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'release_date', 'overview', 'companyNames', 'genres', 'runtime', 'image_url'];

    /**
     * Define a many-to-many relationship with the "Liste" model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lists(): BelongsToMany
    {
        return $this->belongsToMany(ListClass::class, 'film_liste', 'film_id', 'liste_id');
    }

    /**
     * Get the ratings associated with the film.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany(RatingFilm::class);
    }
}
