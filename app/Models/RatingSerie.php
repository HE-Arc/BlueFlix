<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingSerie extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = ['serie_id', 'user_id', 'rating'];

    protected $primaryKey = ['serie_id', 'user_id'];

    public function film()
    {
        return $this->belongsTo(Serie::class, 'serie_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
