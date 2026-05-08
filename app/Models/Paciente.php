<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    // Definir los campos que se pueden llenar
    protected $fillable = ['nombre', 'edad', 'telefono', 'direccion', 'alergias'];

    // Relación con citas
    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}