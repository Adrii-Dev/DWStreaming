<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cohensive\OEmbed\Facades\OEmbed;

class Pelicula extends Model
{
    //El modelo que creamos para manejar el catalogo de peliculas
    use HasFactory;
    protected $table = 'peliculas';
    protected $fillable = ['nombre', 'año', 'genero', 'isrc_id', 'director_id', 'video_url'];

    public function isrc(){
        return $this->hasOne(ISRC::class, 'id', 'isrc_id');
    }
    public function directores(){
        return $this->belongsTo(Director::class, 'director_id');
    }
    public function elencos()
    {
        return $this->belongsToMany(Elenco::class, 'elenco_pelicula');
    }
    public function getVideoAttribute($value){
        $embed = OEmbed::get($this->video_url);
        if($embed){
            return $embed->html(['width' => 400, 'height' => 400]);
        }
        return null;
    }
}
