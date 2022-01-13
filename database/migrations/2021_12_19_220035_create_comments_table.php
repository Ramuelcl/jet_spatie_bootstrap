<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->mediumText('content');

            $table->timestamps();

            // 1 opcion - Relation One To Many
            // $table->unsignedBigInteger('post_id');
            // $table->foreing('post_id')->references('id')->on('posts');
            // 2 opcion - Relation One To Many
            $table->foreignId('blog_id')->constrained();
            // post_id =
            // post: model du table posts (aves s a la fin); _
            // id: champ reference foreing
    // 3 cambiar model:Blog.php - Relation One To Many
    // use App\Models\Comment;

    // public function comments() // s al final
    // {
    //     return $this->hasMany(Comment::class);
    // }
    // 4 cambiar model:Comment.php - Relation One To Many
    // use App\Models\Blog;

    // public function blog() // sin s al final
    // {
    //     return $this->belongsTo(Blog::class);
    // }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
