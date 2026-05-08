<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    // Definir los campos que se pueden llenar
    protected $fillable = ['paciente_id', 'fecha_hora', 'servicio', 'estado'];

    // Relación con pacientes
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}