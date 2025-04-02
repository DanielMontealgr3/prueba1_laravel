<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
   

    public function index()
    {
        
        $documentoUsuarioLogueado = 1109000676;
        
        $usuario = Usuario::findOrFail($documentoUsuarioLogueado);

      
        return view('usuarios.index', compact('usuario')); 
    }

       public function showRecargarForm($usuario_documento)
    {
        $usuario = Usuario::where('documento_usuario', $usuario_documento)->firstOrFail();

        return view('usuarios.recargar', compact('usuario'));
    }


    public function processRecarga(Request $request, $usuario_documento)
    {
        $validated = $request->validate([
            'cantidad_recarga' => 'required|numeric|min:0.01|max:1000000',
        ]);

        DB::beginTransaction();

        try {
            $usuario = Usuario::where('documento_usuario', $usuario_documento)
                              ->lockForUpdate()
                              ->firstOrFail();

            $cantidadRecarga = (float) $validated['cantidad_recarga'];
            $saldoAnterior = (float) ($usuario->saldo_actual ?? 0);
            $saldoActual = $saldoAnterior + $cantidadRecarga;

            Recarga::create([
                'documento_usuario' => $usuario->documento_usuario,
                'cantidad_recarga'  => $cantidadRecarga,
                'saldo_anterior'    => $saldoAnterior,
                'saldo_actual'      => $saldoActual,
            ]);


            $usuario->saldo_actual = $saldoActual;
            $usuario->save();

            DB::commit();

            return redirect()->route('usuarios.recargar.form', ['usuario_documento' => $usuario->documento_usuario])
                             ->with('mensaje', 'Recarga realizada con éxito. Nuevo saldo: $' . number_format($saldoActual, 2));

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error("Error al procesar recarga para {$usuario_documento}: " . $e->getMessage());

            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Error al procesar la recarga. Intente de nuevo.');
        }
    }


  
}

