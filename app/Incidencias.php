<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Users;

class Incidencias extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="incidencias";
    protected $fillable=['profesor', 'fecha', 'aula', 'hora', 'equipo', 'id_profesor', 'id_averia', 'estado', 'opinion'];

    public function profesor(){
        return $this->belongsTo(User::class);
    }
}
