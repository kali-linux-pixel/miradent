<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;

    protected $table = 'historiales';

    protected $fillable = [
        'paciente_id',
        'detalle',
        'fecha'
    ];

    /**
     * Obtiene el paciente asociado a este historial.
     */
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
