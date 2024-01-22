<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use Psy\Readline\Hoa\Console;

class PublicacionController extends Controller
{

   

    public function index(Request $request)
    {
        //return $request;
        //$user = $request->user();

        $publicaciones = Publicacion::where('user_id',1)->get();
        
        //return response()->json($publicaciones);

        return response()->json(Publicacion::all());


        
    }
   
    public function store(Request $request)
    {

        // return $request->input('titulo');
        // Procesa el formulario y guarda la nueva publicación
        // Valida datos del formulario
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'user_id' => 'required',
        ]);
        
        
        // nueva Publicacion con los datos del formulario
        $publicacion =  Publicacion::create([
            'titulo' => $request->input('titulo'),
            'contenido' => $request->input('contenido'),
            'user_id' => $request->input('user_id'),
            //'user_id' =>1,
        ]);


        return response()->json($publicacion);


    }

   

    //edición de publicaciones
    public function edit(Publicacion $publicacion)
    {
        return view('publicaciones.edit', compact('publicacion'));
    }

    public function update(Request $request, Publicacion $publicacion)
    {
        // Valida los datos del formulario
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'id'=>'required'
        ]);
        
        $id= $request->input('id');
        $publicacion = Publicacion::find($id);
        
        // Actualiza los campos de la publicación con los datos del formulario
        $publicacion->update([
            'titulo' => $request->input('titulo'),
            'contenido' => $request->input('contenido'),
        ]);
        return response()->json($publicacion);
    }

    //eliminar publicación

    public function destroy( Request $request, $id)
    {
        // Elimina una publicación
        
        //$publicacion = Publicacion::find($request->id);
        $publicacion = Publicacion::find($id);
        $publicacion->delete();

        //return redirect()->route('publicaciones.index'); //redirige al index después de eliminar
        //retornar mensaje d eborrado
        return response()->json($publicacion);
    }
}
