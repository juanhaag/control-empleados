<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Fichaje;
use Carbon\Carbon;

class AsistenciaController extends Controller
{
    public function marcarAsistenciaForm()
    {
        return view('asistencia.marcar');
    }
    public function marcarAsistencia(Request $request)
    {
        $request->validate([
            'dni' => 'required|exists:empleados,dni',
            'accion' => 'required|in:entrada,salida',
        ]);
    
        $empleado = Empleado::where('dni', $request->dni)->first();
    
        // Obtener información del dispositivo
        $ubicacion = $request->header('User-Agent');
    
        // Verificar si ya hay una entrada o salida para hoy
        $hoy = Carbon::now()->toDateString();
    
        $fichaje = Fichaje::where('empleado_id', $empleado->id)
            ->whereDate('entrada', $hoy)
            ->first();
    
        // Obtener límites de tiempo para el turno actual
        $horaLimiteManianaEntrada = Carbon::now()->setTimezone('America/Argentina/Buenos_Aires')->setHour(17)->setMinute(22)->setSecond(0);
        $horaLimiteTardeEntrada = Carbon::now()->setTimezone('America/Argentina/Buenos_Aires')->setHour(14)->setMinute(15)->setSecond(0);
        $horaLimiteNocheEntrada = Carbon::now()->setTimezone('America/Argentina/Buenos_Aires')->setHour(22)->setMinute(15)->setSecond(0);
    
        // Validar horario de entrada con tolerancia de 15 minutos
        if($request->accion == 'entrada'){
            $fueraDeHorario=false;
        }    
        if (($empleado->turno == 'maniana' && $request->accion == 'entrada' && Carbon::now()->greaterThan($horaLimiteManianaEntrada))
            || ($empleado->turno == 'tarde' && $request->accion == 'entrada' && Carbon::now()->greaterThan($horaLimiteTardeEntrada))
            || ($empleado->turno == 'noche' && $request->accion == 'entrada' && Carbon::now()->greaterThan($horaLimiteNocheEntrada))) {
            $fueraDeHorario = true;
        }
    
        if ($fichaje) {
            // Comprobar si ya se hizo la entrada o salida
            if ($request->accion == 'entrada' && $fichaje->entrada !== null) {
                return redirect()->back()->with('mensaje', 'Ya se realizó la entrada en el dia de hoy');
            } elseif ($request->accion == 'salida' && $fichaje->salida !== null) {
                return redirect()->back()->with('mensaje', 'Ya se realizó la salida.');
            }
    
            // Actualizar la entrada o salida y ubicación
            $campoHora = $request->accion == 'entrada' ? 'entrada' : 'salida';
            $fichaje->update([
                $campoHora => Carbon::now(),
                'ubicacion' => $ubicacion,
                'tarde' => $fueraDeHorario??$fichaje->tarde,
            ]);
        } else {
            // Crear un nuevo registro
            $horaCampo = $request->accion == 'entrada' ? 'entrada' : 'salida';
            $tarde = $fueraDeHorario && $request->accion == 'entrada';
    
            $nuevoFichaje = new Fichaje([
                'empleado_id' => $empleado->id,
                $horaCampo => Carbon::now(),
                'ubicacion' => $ubicacion,
                'tarde' => $tarde,
            ]);
    
            $nuevoFichaje->save();
        }
    
        $accionTexto = $request->accion == 'entrada' ? 'Entrada' : 'Salida';
        $msj = $fueraDeHorario??false;
        $mensajeHorario = $msj ? 'Fuera de horario' : 'En horario';
    
        return redirect()->back()->with('mensaje', "$accionTexto $mensajeHorario registrada correctamente.");
    }
    
    

}
