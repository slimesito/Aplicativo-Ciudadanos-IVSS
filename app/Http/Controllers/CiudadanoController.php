<?php

namespace App\Http\Controllers;

use App\Models\Ciudadano;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CiudadanoController extends Controller
{
    public function search(Request $request)

    {
        $nationality = $request->input('nationality');

        $query = $request->input('query');

        $fullId = $nationality . str_pad($query, 9, '0', STR_PAD_LEFT);

        $ciudadanos = Ciudadano::where('ID_CIUDADANO', '=', $fullId)->get();

        if ($ciudadanos->isEmpty()) {

            return redirect()->back()->with('message', 'Esta Cédula no se encuentra registrada.');

        }

        return view('busqueda', compact('ciudadanos'));
    }

    public function create()
    {
        return view('ciudadanos.registrar_ciudadano');
    }

    public function store(Request $request)
    {
        $id_ciudadano = $request->nacionalidad . $request->ID_CIUDADANO;

        while (strlen($id_ciudadano) < 10) {
            $id_ciudadano = $request->nacionalidad . '0' . substr($id_ciudadano, 1);
        }

        $request->merge(['ID_CIUDADANO' => $id_ciudadano]);

        $request->validate([
            'ID_CIUDADANO' => 'required|unique:oracle.SIRA.CIUDADANO',
            'PRIMER_NOMBRE' => 'required|max:255',
            'SEGUNDO_NOMBRE' => 'max:255',
            'PRIMER_APELLIDO' => 'required|max:255',
            'SEGUNDO_APELLIDO' => 'max:255',
            'SEXO' => 'required|in:M,F',
            'ID_ESTADO_CIVIL' => 'required|in:1,2,3,4,5,6',
            'FECHA_NACIMIENTO' => 'required|date',
            'FECHA_FALLECIMIENTO' => 'date|nullable',
        ],
        [
            'ID_CIUDADANO.required' => 'La Cédula es obligatoria.',
            'ID_CIUDADANO.unique' => 'Esta Cédula ya se encuentra registrada en la base de datos.',
            'PRIMER_NOMBRE.required' => 'El Primer Nombre es obligatorio.',
            'PRIMER_NOMBRE.max' => 'El Primer Nombre no puede tener más de 255 caracteres.',
            'SEGUNDO_NOMBRE.max' => 'El Segundo Nombre no puede tener más de 255 caracteres.',
            'PRIMER_APELLIDO.required' => 'El Primer Apellido es obligatorio.',
            'PRIMER_APELLIDO.max' => 'El Primer Apellido no puede tener más de 255 caracteres.',
            'SEGUNDO_APELLIDO.max' => 'El Segundo apellido no puede tener más de 255 caracteres.',
            'SEXO.required' => 'El Sexo es obligatorio.',
            'SEXO.in' => 'El Sexo debe ser Masculino o Femenino.',
            'ID_ESTADO_CIVIL.required' => 'El Estado Civil es obligatorio.',
            'ID_ESTADO_CIVIL.in' => 'El Estado Civil debe ser uno de los valores permitidos.',
            'FECHA_NACIMIENTO.required' => 'La Fecha de Nacimiento es obligatoria.',
            'FECHA_NACIMIENTO.date' => 'La Fecha de Nacimiento debe ser una fecha válida.',
            'FECHA_FALLECIMIENTO.date' => 'La Fecha de Fallecimiento debe ser una fecha válida.',
        ]);

        $request['PRIMER_NOMBRE'] = strtoupper($request->PRIMER_NOMBRE);
        $request['SEGUNDO_NOMBRE'] = strtoupper($request->SEGUNDO_NOMBRE);
        $request['PRIMER_APELLIDO'] = strtoupper($request->PRIMER_APELLIDO);
        $request['SEGUNDO_APELLIDO'] = strtoupper($request->SEGUNDO_APELLIDO);

        Ciudadano::create($request->all());

        return redirect('/')->with('success', 'Ciudadano registrado satisfactoriamente!');
    }
    
}
