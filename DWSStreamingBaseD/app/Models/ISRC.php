<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ISRC extends Model
{
    use HasFactory;
    protected $table = 'isrcs';
    protected $fillable = ['isrc', 'tipo', 'peli_id'];

    public function pelicula(){
        return $this->belongsTo(Pelicula::class, 'isrc_id', 'id');
    }
}
