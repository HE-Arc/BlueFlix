<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'username',
        'password',
        'urlImage',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Define the relationship with the "Liste" model.
     */
    public function listes(): HasMany
    {
        return $this->hasMany(Liste::class);
    }

    /**
     * Rechercher tous les utilisateurs qui contiennent une certaine requête.
     *
     * @param string $query
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function searchUsers($query)
    {
        return self::where('username', 'like', "%$query%")->get();
    }

    public function ratedFilms()
    {
        return $this->belongsToMany(Film::class, 'rating_films', 'user_id', 'film_id')
            ->withPivot('rating')
            ->withTimestamps();
    }

    public function ratedSeries()
    {
        return $this->belongsToMany(Serie::class, 'rating_series', 'user_id', 'serie_id')
            ->withPivot('rating')
            ->withTimestamps();
    }
}

