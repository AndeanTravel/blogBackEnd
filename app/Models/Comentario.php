<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    // Define las propiedades del modelo
    public $table = "comentarios";
    public $timestamps = true;
    protected $primaryKey = 'id';


    protected $fillable = [
        'id',
        'publicacion_id',
        'contenido',
        'user_id',
        
    ];

    // Relación con la tabla users (un usuario puede hacer muchos comentarios)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con la misma tabla comentarios (relación de muchos a uno consigo misma)
    /* public function comentariosHijos()
    {
        return $this->hasMany(Comentario::class, 'parent_id');
    } */

    // Relación con la tabla publicaciones (un comentario pertenece a una publicación)
    public function publicacion()
    {
        return $this->belongsTo(Publicacion::class);
    }
}
