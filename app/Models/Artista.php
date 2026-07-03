<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artista extends Model
{
    use HasFactory;

    protected $table = 'artistas';

    protected $primarykey = 'artista_id';
    protected $fillable = [
        'nome'
    ];

    public function albuns() {
        return $this->hasMany(Album::class, 'artista_id');
    }

}
