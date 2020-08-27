<?php

namespace proyecto_inicial\Http\Controllers\Tipo;

use Illuminate\Http\Request;
use proyecto_inicial\Http\Controllers\Controller;


// TODO: MODELOS
use proyecto_inicial\Models\Tipo\TipoModel;

// TODO: PARA LAS RESTRICCIONES
use proyecto_inicial\Http\Requests\Tipo\TipoFormRequest;
use proyecto_inicial\Http\Requests\Tipo\TipoUpdateFormRequest;

// TODO: PARA EL DATABLES
use Yajra\DataTables\Facades\DataTables as DataTables;


class TipoController extends Controller{
    
    
     // TODO: CREA
     public function store(Request $request){
       
        if($request->ajax()){
            $resultado = TipoModel::create($request->all());
            
            if($resultado){
                return response()->json(['success' => 'true']);
            } else{
                return response()->json(['success' => 'false']);
            }
        }
    
    }

    // TODO: LLAMAR A MI OBJETO
    public function edit($id){
        
        $cliente = TipoModel::where('id', $id)->firstOrFail();
        return response()->json($cliente);

    }

    // TODO: MODIFICA
    public function update(Request $request, $id){
        
        if($request->ajax()){
            
            $cliente = TipoModel::where('id', $id)->firstOrFail();
        
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

        $cliente = TipoModel::where('id', $id)->firstOrFail();

        $resultado = $cliente->where('id', $id)->delete();
        
        if($resultado){
            return response()->json(['success' => 'true']);
        } else{
            return response()->json(['success' => 'false']);
        }

    }
    
    // TODO: LISTAR
    public function listarTipos(Request $request){
        
        if($request->ajax()){

            $clientes = TipoModel::select('tb_tipo.id',
            'tb_tipo.nombre_tipo',
            'tb_tipo.id_usuario_fk');
    
            return datatables($clientes)
            ->addColumn('action','tipo.actions')
            ->make(true);
    
        }

        return view('tipo/listar_tipos');
        
    }

}
