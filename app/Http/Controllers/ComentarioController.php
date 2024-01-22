<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use App\Models\Publicacion;

class ComentarioController extends Controller
{
    

    public function store(Request $request)
    {
        
        $request->validate([
            'contenido' => 'required|string',
        ]);
        

        $comentario =  Comentario::create([
            'publicacion_id' => 3,
            'contenido' => $request->input('contenido'),
            'user_id' => 1,
                        
        ]);
        return $comentario;
        return response()->json($comentario);
    }
    


    public function update (Request $request, Comentario $comentario)
    {
        // Valida los datos del formulario
        $request->validate([
            'contenido' => 'required|string',
            'id'=>'required'
        ]);
        
        $id= $request->input('id');
        $comentario = Comentario::find($id);
        
        // Actualiza los campos de la publicación con los datos del formulario
        $comentario->update([
            'contenido' => $request->input('contenido'),
        ]);
        return response()->json($comentario);
    }

    public function destroy( Request $request)
    {
        // Elimina una publicación
        
        $comentario = Comentario::find($request->id);
        $comentario->delete();

        //return redirect()->route('publicaciones.index'); //redirige al index después de eliminar
        return response()->json($comentario);
    }


    public function show(Comentario $comentario)
    {
        // Muestra un comentario específico
        return view('comentarios.show', compact('comentario'));
    }

  

}
