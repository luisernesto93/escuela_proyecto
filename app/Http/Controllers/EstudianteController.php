<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Localidad;
use App\Models\Estudiante;
use App\Models\Genero;
use App\Models\ExpedicionCi;


class EstudianteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:estudiante-listar|estudiante-crear|estudiante-editar|estudiante-eliminar', ['only' => ['index']]);
        $this->middleware('permission:estudiante-crear', ['only' => ['create', 'store']]);
        $this->middleware('permission:estudiante-editar', ['only' => ['edit', 'update']]);
        $this->middleware('permission:estudiante-eliminar', ['only' => ['eliminar']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudiantes = Estudiante::paginate(11);
        //$localidades = Localidad::all();
        //$generos = Genero::all();
        //$expedicion_cis = ExpedicionCi::all();
        return view('estudiantes.index', [
            'estudiantes' => $estudiantes,
            //'localidades' => $localidades,
            //'generos' => $generos,
            //'expedicion_cis' => $expedicion_cis
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $localidades = Localidad::all();
        $generos = Genero::all();
        $expedicion_cis = ExpedicionCi::all();
        return view('estudiantes.create', [
            'localidades' => $localidades,
            'generos' => $generos,
            'expedicion_cis' => $expedicion_cis
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'documento' => ['required', 'unique:estudiantes'],
            'nombres' => ['required', 'max:255'],
            'apellidos' => ['required', 'max:255'],
            'fecha_nacimiento'=>['required', 'max:255'],
            'correo' => ['required', 'max:255', 'unique:estudiantes'],
            'telefono'=>['required', 'numeric'],
            'direccion'=>['required', 'max:255'],
            'localidad_id'=>['required'],
            'genero_id'=>['required'],
            'expedicion_ci_id'=>['required']
        ]);
        //Registrar fecha de registro internamente
        $estudiante = Estudiante::create([
            'fecha_registro' => now(),
        ] + $request->all());

        // CREAR USUARIO PARA EL ESTUDIANTE
        $user = new User();
        $user->first_name = $estudiante->nombres;
        $user->last_name = $estudiante->apellidos;
        $user->email = $estudiante->correo;
        $user->mobile_number = $estudiante->telefono;
        $user->password = Hash::make($estudiante->documento);
        $user->role_id = 3;
        $user->status = 1;
        $user->save();
        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function show(Estudiante $estudiante)
    {
        return view('estudiantes.show', [
            'estudiante' => $estudiante
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit(Estudiante $estudiante)
    {
        $localidades = Localidad::all();
        $generos = Genero::all();
        $expedicion_cis = ExpedicionCi::all();
        return view('estudiantes.edit', [
            'estudiante' => $estudiante,
            'localidades' => $localidades,
            'generos' => $generos,
            'expedicion_cis' => $expedicion_cis
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estudiante $estudiante)
    {
        $request->validate([
            'nombres' => ['required', 'max:255'],
            'apellidos' => ['required', 'max:255'],
            'genero_id'=>['required', 'max:255'],
            'fecha_nacimiento'=>['required', 'max:255'],
            'documento' => ['required', 'max:255'],
            'expedicion_ci_id'=>['required', 'max:255'],
            'localidad_id'=>['required', 'max:255'],
            'direccion'=>['required', 'max:255'],
            'correo' => ['required', 'max:255'],
            'telefono'=>['required', 'max:255'],
            'fecha_registro' => ['required', 'max:255'],
        ]);
        $estudiante->update($request->all());

        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante actualizado satisfactoriamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estudiante $estudiante)
    {
        if ($estudiante->estado == 1) {
            return redirect()->route('estudiantes.index')
                ->with('error', 'No se puede eliminar un estudiante activo');
        }
        $estudiante->delete();
        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante eliminado satisfactoriamente');
    }
    public function actualizarEstado($estudiante_id, $estado)
    {
        try {
            DB::beginTransaction();
            // Update Status
            Estudiante::whereId($estudiante_id)->update(['estado' => $estado]);
            DB::commit();
            return redirect()->route('estudiantes.index')->with('success', 'Estado del estudiante actualizado correctamente!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
