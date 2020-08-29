<?php

namespace proyecto_inicial\Http\Controllers\Habitacion;

use Illuminate\Http\Request;
use proyecto_inicial\Http\Controllers\Controller;
use proyecto_inicial\Models\Habitacion\HabitacionModel;
use proyecto_inicial\Models\Piso\PisoModel;
use proyecto_inicial\Models\Tipo\TipoModel;

class HabitacionController extends Controller{
    
    // TODO: CREA
    public function store(Request $request){
       
        if($request->ajax()){
            $resultado = HabitacionModel::create($request->all());
            
            if($resultado){
                return response()->json(['success' => 'true']);
            } else{
                return response()->json(['success' => 'false']);
            }
        }
    
    }

    // TODO: LLAMAR A MI OBJETO
    public function edit($id){
        
        $reserva = HabitacionModel::where('id', $id)->firstOrFail();
        return response()->json($reserva);

    }

    // TODO: MODIFICA
    public function update(Request $request, $id){
        
        if($request->ajax()){
            
            $habtacion = HabitacionModel::where('id', $id)->firstOrFail();
        
            $resultado = $habtacion->where('id', $id)->update($request->except(['_token', '_method' ,'guardar']));

            $input = $request->all();
            $resultado = $habtacion->fill($input)->save();
            
            if($resultado){
                return response()->json(['success' => 'true']);
            } else{
                return response()->json(['success' => 'false']);
            }
            
        }

    }

    // TODO: ELIMINA
    public function destroy($id){

        $habitacion = HabitacionModel::where('id', $id)->firstOrFail();

        $resultado = $habitacion->where('id', $id)->delete();
        
        if($resultado){
            return response()->json(['success' => 'true']);
        } else{
            return response()->json(['success' => 'false']);
        }

    }
    
    // TODO: LISTAR
    public function listarHabitaciones(Request $request){
        
        if($request->ajax()){

            $habitaciones = HabitacionModel::select('tb_habitacion.id',
            'tb_habitacion.codigo_habitacion',
            'tb_habitacion.id_piso_fk',
            'tb_habitacion.id_tipo_fk',
            'tb_reserva.id_usuario_fk',
            'tb_reserva.descripcion_habitacion');
    
            return datatables($habitaciones)
            ->addColumn('action','habitacion.actions')
            ->make(true);
    
        }

        /*$pisos = PisoModel::select('tb_piso.id',
        'tb_piso.nombre_piso',
        'tb_piso.id_usuario_fk');*/
        

        $pisos = PisoModel::pluck('nombre_piso','id')->prepend('Selecciona el Piso');
        $tipos = TipoModel::pluck('nombre_tipo','id')->prepend('Selecciona el Tipo');


        return view('habitacion/listar_habitacion')->with(compact('pisos','tipos'));
        
    }
    

}
