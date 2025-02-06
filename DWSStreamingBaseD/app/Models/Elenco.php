<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elenco extends Model
{
    use HasFactory;
    protected $table = 'elencos';
    protected $fillable = ['nombre', 'apellido', 'dni', 'tipo'];

    public function peliculas()
    {
        return $this->belongsToMany(Pelicula::class, 'elenco_pelicula');
    }
}
