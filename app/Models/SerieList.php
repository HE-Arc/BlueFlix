<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerieList extends Model
{
    use HasFactory;

    protected $table = 'serie_list';

    public function serie()
    {
        return $this->belongsTo(Serie::class, 'serie_id');
    }

    public function list()
    {
        return $this->belongsTo(ListClass::class, 'list_id');
    }
}

