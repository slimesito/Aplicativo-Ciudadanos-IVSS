<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudadano extends Model
{
    use HasFactory;

    protected $connection = 'oracle';
    protected $table = 'SIRA.CIUDADANO';
    protected $primaryKey = 'ID_CIUDADANO';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'ID_CIUDADANO',
        'PRIMER_NOMBRE',
        'SEGUNDO_NOMBRE',
        'PRIMER_APELLIDO',
        'SEGUNDO_APELLIDO',
        'SEXO',
        'RIF',
        'CONDICION_ZURDO',
        'ID_OCUPACION',
        'FECHA_NACIMIENTO',
        'ID_ESTADO_CIVIL',
        'ID_CATASTRO',
        'TELEFONO_HAB',
        'TELEFONO_MOVIL',
        'EMAIL_PRINCIPAL',
        'EMAIL_ALTERNO',
        'FECHA_FALLECIMIENTO',
        'ESTATUS_AFILIADO',
        'CEDULA_EXTRANJERO',
        'ID_NACIONALIDAD'
    ];
}
