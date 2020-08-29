<?php

namespace proyecto_inicial\Http\Controllers\Reserva;

use Illuminate\Http\Request;
use proyecto_inicial\Http\Controllers\Controller;
use proyecto_inicial\Models\Reserva\ReservaModel;

class ReservaController extends Controller{
 
    // TODO: CREA
     public function store(Request $request){
       
        if($request->ajax()){
            $resultado = ReservaModel::create($request->all());
            
            if($resultado){
                return response()->json(['success' => 'true']);
            } else{
                return response()->json(['success' => 'false']);
            }
        }
    
    }

    // TODO: LLAMAR A MI OBJETO
    public function edit($id){
        
        $reserva = ReservaModel::where('id', $id)->firstOrFail();
        return response()->json($reserva);

    }

    // TODO: MODIFICA
    public function update(Request $request, $id){
        
        if($request->ajax()){
            
            $reserva = ReservaModel::where('id', $id)->firstOrFail();
        
            $resultado = $reserva->where('id', $id)->update($request->except(['_token', '_method' ,'guardar']));

            $input = $request->all();
            $resultado = $reserva->fill($input)->save();
            
            if($resultado){
                return response()->json(['success' => 'true']);
            } else{
                return response()->json(['success' => 'false']);
            }
            
        }

    }

    // TODO: ELIMINA
    public function destroy($id){

        $reserva = ReservaModel::where('id', $id)->firstOrFail();

        $resultado = $reserva->where('id', $id)->delete();
        
        if($resultado){
            return response()->json(['success' => 'true']);
        } else{
            return response()->json(['success' => 'false']);
        }

    }
    
    // TODO: LISTAR
    public function listarReservas(Request $request){
        
        if($request->ajax()){

            $clientes = ReservaModel::select('tb_reserva.id',
            'tb_reserva.id_cliente_fk',
            'tb_reserva.id_habitacion_fk',
            'tb_reserva.id_usuario_fk',
            'tb_reserva.detalles_habitacion',
            'tb_reserva.estado_reserva');
    
            return datatables($clientes)
            ->addColumn('action','reserva.actions')
            ->make(true);
    
        }

        return view('reserva/listar_reservas');
        
    }
    
}
