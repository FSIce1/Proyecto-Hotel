<?php

namespace proyecto_inicial\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use proyecto_inicial\Http\Controllers\Controller;

use proyecto_inicial\Http\Requests\Usuario\UserFormRequest;

// TODO: MODELOS
use proyecto_inicial\Models\Usuario\UsuarioModel;

// TODO: PARA LAS RESTRICCIONES
use proyecto_inicial\Http\Requests\Usuario\UsuarioFormRequest;
use proyecto_inicial\Http\Requests\Usuario\UsuarioUpdateFormRequest;

// TODO: PARA EL lDATABLES
use Yajra\DataTables\Facades\DataTables as DataTables;


class UsuarioController extends Controller{
    
    // TODO: CREA
    public function store(UsuarioFormRequest $request){
       
        if($request->ajax()){
            $resultado = UsuarioModel::create($request->all());
            
            if($resultado){
                return response()->json(['success' => 'true']);
            } else{
                return response()->json(['success' => 'false']);
            }
        }
    
    }

    // TODO: LLAMAR A MI OBJETO
    public function edit($id){
        
        $usuario = UsuarioModel::where('id', $id)->firstOrFail();
        return response()->json($usuario);

    }

    // TODO: MODIFICA
    public function update(UsuarioUpdateFormRequest $request, $id){
        
        if($request->ajax()){
            
            $usuario = UsuarioModel::where('id', $id)->firstOrFail();
        
            $resultado = $usuario->where('id', $id)->update($request->except(['password','password_confirmation','_token', '_method' ,'guardar']));

            $input = $request->all();
            $resultado = $usuario->fill($input)->save();
            
        
            if($resultado){
                return response()->json(['success' => 'true']);
            } else{
                return response()->json(['success' => 'false']);
            }
            
        }

    }

    // TODO: ELIMINA
    public function destroy($id){

        $usuario = UsuarioModel::where('id', $id)->firstOrFail();

        $resultado=$usuario->where('id', $id)->delete();
        
        if($resultado){
            return response()->json(['success' => 'true']);
        } else{
            return response()->json(['success' => 'false']);
        }

    }
    
    // TODO: CAMBIAR ESTADO
    public function cambiarEstado(Request $request,$id){

        if($request->ajax()){
            
            $usuario = UsuarioModel::where('id', $id)->firstOrFail();
        
            $resultado = $usuario->where('id', $id)->update($request->except(['password','password_confirmation','_token', '_method' ,'guardar']));

            $input = $request->all();
            $resultado = $usuario->fill($input)->save();
        
            if($resultado){
                return response()->json(['success' => 'true']);
            } else{
                return response()->json(['success' => 'false']);
            }
            
        }
        
    }

    // TODO: LISTAR
    public function listarUsuarios(Request $request){
        
        if($request->ajax()){

            $usuarios = UsuarioModel::select('tb_usuario.id',
            'tb_usuario.nombre_usuario',
            'tb_usuario.email_usuario',
            'tb_usuario.estado_usuario');

                return datatables($usuarios)
                ->addColumn('action','usuario.actions')
                ->make(true);
    
        }
    
        return view('usuario/listar_usuarios');
        
    }

}
