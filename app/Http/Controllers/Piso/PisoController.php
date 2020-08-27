<?php

namespace proyecto_inicial\Http\Controllers\Piso;

use Illuminate\Http\Request;
use proyecto_inicial\Http\Controllers\Controller;

// TODO: MODELOS
use proyecto_inicial\Models\Piso\PisoModel;

// TODO: PARA LAS RESTRICCIONES
use proyecto_inicial\Http\Requests\Piso\PisoFormRequest;
use proyecto_inicial\Http\Requests\Piso\PisoUpdateFormRequest;

// TODO: PARA EL DATABLES
use Yajra\DataTables\Facades\DataTables as DataTables;


class PisoController extends Controller{
    
     // TODO: CREA
     public function store(PisoFormRequest $request){
       
        if($request->ajax()){
            $resultado = PisoModel::create($request->all());
            
            if($resultado){
                return response()->json(['success' => 'true']);
            } else{
                return response()->json(['success' => 'false']);
            }
        }
    
    }

    // TODO: LLAMAR A MI OBJETO
    public function edit($id){
        
        $cliente = PisoModel::where('id', $id)->firstOrFail();
        return response()->json($cliente);

    }

    // TODO: MODIFICA
    public function update(PisoUpdateFormRequest $request, $id){
        
        if($request->ajax()){
            
            $cliente = PisoModel::where('id', $id)->firstOrFail();
        
            $resultado = $cliente->where('id', $id)->update($request->except(['_token', '_method' ,'guardar']));

            $input = $request->all();
            $resultado = $cliente->fill($input)->save();
            
            if($resultado){
                return response()->json(['success' => 'true']);
            } else{
                return response()->json(['success' => 'false']);
            }
            
        }

    }

    // TODO: ELIMINA
    public function destroy($id){

        $cliente = PisoModel::where('id', $id)->firstOrFail();

        $resultado = $cliente->where('id', $id)->delete();
        
        if($resultado){
            return response()->json(['success' => 'true']);
        } else{
            return response()->json(['success' => 'false']);
        }

    }
    
    // TODO: LISTAR
    public function listarPisos(Request $request){
        
        if($request->ajax()){

            $clientes = PisoModel::select('tb_piso.id',
            'tb_piso.nombre_piso',
            'tb_piso.id_usuario_fk');
    
            return datatables($clientes)
            ->addColumn('action','piso.actions')
            ->make(true);
    
        }

        return view('piso/listar_pisos');
        
    }
    

}
