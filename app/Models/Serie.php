<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Serie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'release_date', 'overview', 'companyNames', 'genres', 'runtime', 'number_of_seasons', 'number_of_episodes', 'image_url'];

    /**
     * Define a many-to-many relationship with the "Liste" model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lists(): BelongsToMany
    {
        return $this->belongsToMany(ListClass::class, 'serie_list', 'serie_id', 'liste_id');
    }

    /**
     * Get the ratings associated with the serie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany(RatingSerie::class);
    }
}
