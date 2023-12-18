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
    public function lists(): HasMany
    {
        return $this->hasMany(ListClass::class);
    }

    /**
     * Find all users that contain a certain query.
     *
     * @param string $query
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function searchUsers($query)
    {
        return self::where('username', 'like', "%$query%")->get();
    }

    /**
     * Get the films that the user has rated, including the ratings.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function ratedFilms()
    {
        return $this->belongsToMany(Film::class, 'rating_films', 'user_id', 'film_id')
            ->withPivot('rating')
            ->withTimestamps();
    }

    /**
     * Get the series that the user has rated, including the ratings.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function ratedSeries()
    {
        return $this->belongsToMany(Serie::class, 'rating_series', 'user_id', 'serie_id')
            ->withPivot('rating')
            ->withTimestamps();
    }
}

