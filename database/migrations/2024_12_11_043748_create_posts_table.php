<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('title'); // Title of the post
            $table->text('body'); // Body content of the post
            $table->timestamp('date_time')->default(DB::raw('CURRENT_TIMESTAMP')); // Date and time of the post
            $table->unsignedBigInteger('category_id'); // Foreign key for category
            $table->unsignedBigInteger('author_id'); // Foreign key for author
            $table->boolean('is_featured')->default(0); // Whether the post is featured (0 for false, 1 for true)
            $table->timestamps(); // Created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
