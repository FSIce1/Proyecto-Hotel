<?php

namespace proyecto_inicial\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use proyecto_inicial\Http\Controllers\Controller;

// TODO: MODELOS
use proyecto_inicial\Models\Cliente\ClienteModel;

// TODO: PARA LAS RESTRICCIONES
use proyecto_inicial\Http\Requests\Cliente\ClienteFormRequest;
use proyecto_inicial\Http\Requests\Cliente\ClienteUpdateFormRequest;

// TODO: PARA EL DATABLES
use Yajra\DataTables\Facades\DataTables as DataTables;

class ClienteController extends Controller{
    
    // TODO: CREA
    public function store(ClienteFormRequest $request){
       
        if($request->ajax()){
            $resultado = ClienteModel::create($request->all());
            
            if($resultado){
                return response()->json(['success' => 'true']);
            } else{
                return response()->json(['success' => 'false']);
            }
        }
    
    }

    // TODO: LLAMAR A MI OBJETO
    public function edit($id){
        
        $cliente = ClienteModel::where('id', $id)->firstOrFail();
        return response()->json($cliente);

    }

    // TODO: MODIFICA
    public function update(ClienteUpdateFormRequest $request, $id){
        
        if($request->ajax()){
            
            $cliente = ClienteModel::where('id', $id)->firstOrFail();
        
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

        $cliente = ClienteModel::where('id', $id)->firstOrFail();

        $resultado = $cliente->where('id', $id)->delete();
        
        if($resultado){
            return response()->json(['success' => 'true']);
        } else{
            return response()->json(['success' => 'false']);
        }

    }
    
    // TODO: LISTAR
    public function listarClientes(Request $request){
        
        if($request->ajax()){

            $clientes = ClienteModel::select('tb_cliente.id',
            'tb_cliente.nombre_cliente',
            'tb_cliente.apellido_cliente',
            'tb_cliente.tipo_cliente',
            'tb_cliente.n_documento_cliente',
            'tb_cliente.n_celular_cliente',
            'tb_cliente.email_cliente',
            'tb_cliente.id_usuario_fk');
    
            return datatables($clientes)
            ->addColumn('action','cliente.actions')
            ->make(true);
    
        }

        return view('cliente/listar_clientes');
        
    }
    
}
