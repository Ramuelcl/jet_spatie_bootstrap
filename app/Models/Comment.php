<?php

namespace App\Models;

// use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    // 4 cambiar model:Comment.php - Relation One To Many
    public function blog() // sin s al final
    {
        return $this->belongsTo(App\Models\Blog::class);
    }
}
