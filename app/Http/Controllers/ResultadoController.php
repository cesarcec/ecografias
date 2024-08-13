<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resultado;
use App\Models\Examen;
use App\Http\Resources\ResultadoResource;
use Illuminate\Http\Response;
use App\Http\Controllers\ApiResponse;
use App\Models\OrdenExamen;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PDF;

class ResultadoController extends Controller
{
    #WEB
    public function getIndex()
    {
        return view('ecografias.resultado.index');
    }
    

    public function generarPdf(string $id)
    {
        $resultado = Resultado::findOrFail($id);
        $resultado->load(
            'examen.ordenExamen.doctor.user', 
            'examen.ordenExamen.paciente.user', 
            'examen.ordenExamen.recepcionista.user', 
            'examen.ordenExamen.estudio', 'examen.sala'
        );

        $pdf = PDF::loadView('ecografias.resultado.comprobante', compact('resultado'));

        return $pdf->stream('resultado-' . $resultado->id . '.pdf');
    }

    public function generarPdfDownload(string $id)
    {
        $resultado = Resultado::findOrFail($id);
        $resultado->load(
            'examen.ordenExamen.doctor.user', 
            'examen.ordenExamen.paciente.user', 
            'examen.ordenExamen.recepcionista.user', 
            'examen.ordenExamen.estudio', 'examen.sala'
        );

        $pdf = PDF::loadView('ecografias.resultado.comprobante', compact('resultado'));

        return $pdf->download('resultado-' . $resultado->id . '.pdf');
    }

    #API REST

    public function getResultadoCreate(string $id_examen)
    {
        $examen = Examen::findOrFail($id_examen);
        $examen->load(
            'ordenExamen.doctor.user', 
            'ordenExamen.paciente.user', 
            'ordenExamen.recepcionista.user', 
            'ordenExamen.estudio', 
            'sala'
        );
        // return $examen;
        return view('ecografias.resultado.create')->with('examen', $examen);
    }

    #API REST

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resultados = Resultado::where('estado', 1)
            ->with(
                'examen.ordenExamen.paciente.user', 
                'examen.ordenExamen.doctor.user', 
                'examen.ordenExamen.estudio'
            )->get();

        $examenes = ['examenes' => Examen::where('estado', 1)->get()];
        $response = ApiResponse::success(ResultadoResource::collection($resultados), 'Lista obtenida correctamente', 200, $examenes);

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $response = [];
        try {

            $resultado = Resultado::create([
                'informe' => $request->get('informe'),
                'conclusion' => $request->get('conclusion'),
                'recomendacion' => $request->get('recomendacion'),
                // 'fecha' => $request->get('fecha'),
                'fecha' => $request->get('fecha') . ' ' . now()->format('H:i:s'),
                'examen_id' => $request->get('examen_id'),
            ]);
            $resultado->load('examen');

            $destination_path = 'assets/img/resultado/';
            $nombre_campo1 = 'imagen_1';
            $nombre_campo2 = 'imagen_2';
            $nombre_campo3 = 'imagen_3';
            $this->uploadImage($request, $resultado, $nombre_campo1, $destination_path);
            $this->uploadImage($request, $resultado, $nombre_campo2, $destination_path);
            $this->uploadImage($request, $resultado, $nombre_campo3, $destination_path);

            DB::commit();
            $response = ApiResponse::success(new ResultadoResource($resultado), 'Registro insertado correctamente.', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ApiResponse::error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $resultado = Resultado::findOrFail($id);
        $resultado->load (
            'examen.ordenExamen.paciente.user', 
            'examen.ordenExamen.doctor.user', 
            'examen.ordenExamen.estudio'
        );
        return ApiResponse::success(new ResultadoResource($resultado), 'Registro encontrado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        DB::beginTransaction();
        $response = [];
        try {

            $resultado = Resultado::findOrFail($id);
            $resultado->update([
                'informe' => $request->get('informe'),
                'conclusion' => $request->get('conclusion'),
                'recomendacion' => $request->get('recomendacion'),
                'fecha' => $request->get('fecha'),
                'examen_id' => $request->get('examen_id'),
            ]);
            $resultado->load('examen');

            DB::commit();
            $response = ApiResponse::success(new ResultadoResource($resultado), 'Registro actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ApiResponse::error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resultado = Resultado::findOrFail($id);
        $resultado->update(['estado' => 0]);
        return ApiResponse::success(new ResultadoResource($resultado), 'Registro deshabilitado correctamente.');
    }

    public function restore(string $id)
    {
        $resultado = Resultado::findOrFail($id);
        $resultado->update(['estado' => 1]);
        return ApiResponse::success(new ResultadoResource($resultado), 'Registro restaurado correctamente.');
    }

    public function disabled()
    {
        $resultados = Resultado::where('estado', 0)->get();
        return ApiResponse::success(ResultadoResource::collection($resultados), 'Lista de deshabilitados obtenida correctamente');
    }

    public function uploadImage($request, $data, $imagen, $destinationPath)
    {
        $success = false;

        if ($request->hasFile($imagen) && $request->file($imagen)->isValid()) {
            $file = $request->file($imagen);

            $request->validate([
                $imagen => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $microtime = explode(' ', microtime());
            $microseconds = isset($microtime[0]) ? $microtime[0] : '';
            $filename = time() . '-' . $data->getKey() . '-' . str_replace('.', '', $microseconds) . '.' . $file->getClientOriginalExtension();

            try {
                $uploadSuccess = $file->move($destinationPath, $filename);

                if ($uploadSuccess) {
                    $data->{$imagen} = $filename;
                    $data->save();
                    $success = true;
                }
            } catch (\Exception $e) {
                // \Log::error('Error al cargar archivo: ' . $e->getMessage());
            }
        }

        return $success;
    }

    public function resultadoPaciente(string $paciente_id) {
        $resultado = Resultado::select('resultado.*')
                                ->join('examen', 'resultado.examen_id', 'examen.id')
                                ->join('orden_examen', 'examen.orden_examen_id', 'orden_examen.id')
                                ->join('paciente', 'orden_examen.paciente_id', 'paciente.id')
                                ->where('paciente.id',  $paciente_id)
                                ->get();
        $resultado->load (
            'examen.ordenExamen.paciente.user', 
            'examen.ordenExamen.doctor.user', 
            'examen.ordenExamen.estudio'
        );
        return ApiResponse::success(ResultadoResource::collection($resultado), 'Lista de obtenida correctamente');
    }

}
