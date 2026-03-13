<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Inscripcion extends Model
{

    protected $table = 'inscripciones';
    public $timestamps = false;


    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

    public function padron()
    {
        return $this->belongsTo(Padron::class, 'id_padron');
    }

}
