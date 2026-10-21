<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use Exception;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProfesorController extends Controller
{

//-----------------------------------------REGLAS----------------------------------------------------------------------------------
        private const MESSAGES = [
        // Nombre
        'nombre.required' => 'El nombre es obligatorio.',
        'nombre.string'   => 'El nombre debe ser una cadena de texto.',
        'nombre.min'      => 'El nombre debe tener al menos 2 caracteres.',
        'nombre.max'      => 'El nombre no puede superar los 100 caracteres.',

        // Apellidos
        'apellidos.required' => 'Los apellidos son obligatorios.',
        'apellidos.string'   => 'Los apellidos deben ser una cadena de texto.',
        'apellidos.min'      => 'Los apellidos deben tener al menos 3 caracteres.',
        'apellidos.max'      => 'Los apellidos no pueden superar los 130 caracteres.',

        // Especialidad
        'especialidad.required' => 'La especialidad es obligatoria.',
        'especialidad.string'   => 'La especialidad debe ser una cadena de texto.',
        'especialidad.min'      => 'La especialidad debe tener al menos 2 caracteres.',
        'especialidad.max'      => 'La especialidad no puede superar los 100 caracteres.',

        // Fecha de alta
        'fecha_alta.required'        => 'La fecha de alta es obligatoria.',
        'fecha_alta.date'            => 'La fecha de alta no es válida.',
        'fecha_alta.before_or_equal' => 'La fecha de alta no puede ser posterior a hoy.',

        // Salario
        'salario.required' => 'El salario es obligatorio.',
        'salario.numeric'  => 'El salario debe ser un número.',
        'salario.gte'      => 'El salario no puede ser negativo.',
        'salario.decimal'  => 'El salario debe tener como máximo 2 decimales.',
    ];

    private const RULES = [
        'nombre'       => 'required|string|max:100|min:2',
        'apellidos'    => 'required|string|max:130|min:3',
        'especialidad' => 'required|string|max:100|min:2',
        'fecha_alta'   => 'required|date|before_or_equal:today',
        'salario'      => 'required|numeric|gte:0|decimal:0,2',
    ];




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('profesor.create', []);
    }

    /**
     * Remove the specified resource from storage.
     */
    
    public function destroy(Profesor $profesor): RedirectResponse
    {
        try {
            $profesor->delete();
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Error al borrar el profesor.',]);
        }
        return redirect()->route('profesor.index')->with(['success' => 'Se ha borrado el profesor.']);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profesor $profesor)
    {
        //
        return view('profesor.edit', ['profesor' => $profesor]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $profesores = Profesor::all();
        return view('profesor.index', ['profesores' => $profesores]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Profesor $profesor)
    {
        //
        return view('profesor.show', ['profesor' => $profesor]);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request): RedirectResponse
    {
        // 1º validar
        $validator = Validator::make(
            $request->all(),self::RULES,self::MESSAGES);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        $profesor = new Profesor($request->all());
        try {
            $profesor->save();
        } catch (UniqueConstraintViolationException $e) {
            return back()->withInput()->withErrors(['error' => 'Ya existe un profesor con ese nombre y apellidos.',]);
        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Error al crear el profesor.',]);
        }
        return redirect()->route('profesor.index')->with(['success' => 'Se ha creado el profesor correctamente.']);
    }


    /**
     * Update the specified resource in storage.
     */
   
    public function update(Request $request, Profesor $profesor): RedirectResponse
    {
        $validator = Validator::make($request->all(),self::RULES,self::MESSAGES);

        if ($validator->fails()) {return back()->withInput()->withErrors($validator);
        }

        try {
            $profesor->update($request->all());
        } catch (UniqueConstraintViolationException $e) {
            return back()->withInput()->withErrors(['error' => 'Ya existe un profesor con ese nombre y apellidos.',]);
        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Error al editar el profesor.',]);
        }

        return redirect()->route('profesor.index');
    }


    
}
