<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $table = 'albuns';

    protected $fillable = [
        'titulo',
        'ano',
        'capa_url',
        'artista_id'
    ];

    public function musicas() {
        return $this->hasMany(Musica::class);
    }
    public function artista() {
        return $this->belongsTo(Artista::class, 'artista_id');
    }

}
