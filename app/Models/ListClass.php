<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListClass extends Model
{
    use HasFactory;

    protected $table = 'lists';

    protected $fillable = ['name', 'image_url', 'user_id', 'deleteable'];

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
        return $this->belongsToMany(Film::class, 'film_list', 'list_id', 'film_id');
    }

    /**
     * Define the many-to-many relationship with the "Serie" model.
     */
    public function series()
    {
        return $this->belongsToMany(Serie::class, 'serie_list', 'list_id', 'serie_id');
    }
}
