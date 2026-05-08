<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    // Definir los campos que se pueden llenar
    protected $fillable = ['paciente_id', 'monto', 'metodo_pago'];

    // Relación con pacientes
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}