<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    protected $table = 'movies';

    protected $fillable = ['año', 'titulo', 'duracion', 'sinopsis', 'imagen', 'condicion', 'id_actor'];

   
}
