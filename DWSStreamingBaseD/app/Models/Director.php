<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;
    protected $table = 'directors';
    protected $fillable = ['nombre', 'apellido', 'dni'];

    public function peliculas(){
        return $this->hasMany(Pelicula::class, 'director_id');
    }
}
