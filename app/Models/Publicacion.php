<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{

    public $table = "publicaciones";
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'titulo',
        'contenido',
        'user_id'
    ];

    // Relación con la tabla users (una publicación pertenece a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con la tabla comentarios (una publicación puede tener muchos comentarios)
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}
