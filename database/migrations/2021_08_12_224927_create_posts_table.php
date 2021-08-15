<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration {

  public function up() {
    Schema::create('posts', function (Blueprint $table) {
      $table->id();
      $table->foreignId('blog_id');
      $table->foreignId('author_id');
      $table->timestamps();

      $table->foreign('blog_id')->references('id')->on('blogs');
      $table->foreign('author_id')->references('id')->on('users');
    });
  }

  public function down() {
    Schema::dropIfExists('posts');
  }

}
