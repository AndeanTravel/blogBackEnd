<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{


    public function store(Request $request)
    {
        // Procesa el formulario y guarda el nuevo usuario
        // Implementa la lógica de almacenamiento según tus necesidades
        $usuario = User::create($request->all());

        return redirect()->route('usuarios.show', $usuario->id);
    }

    public function show(User $usuario)
    {
        // Muestra un usuario específico
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(User $usuario)
    {
        // Muestra el formulario de edición de usuarios
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, User $usuario)
    {
        // Procesa el formulario y actualiza el usuario
        // Implementa la lógica de actualización según tus necesidades
        $usuario->update($request->all());

        return redirect()->route('usuarios.show', $usuario->id);
    }

    public function destroy(User $usuario)
    {
        // Elimina un usuario
        $usuario->delete();

        return redirect()->route('usuarios.index'); // redirigir a donde quieras después de eliminar
    }
}
