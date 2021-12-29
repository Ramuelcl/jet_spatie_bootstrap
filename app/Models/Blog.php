<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'contenido'];

    // 3 cambiar model:Blog.php - Relation One To Many
    public function comments() // s al final
    {
        return $this->hasMany(App\Models\Comment::class);
    }
}
