<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostContentsTable extends Migration {

  public function up() {
    Schema::create('post_contents', function (Blueprint $table) {
      $table->id();
      $table->foreignId('post_id');
      $table->unsignedInteger('version')->default(1);
      $table->string('title');
      $table->text('content');
      $table->timestamps();

      $table->foreign('post_id')->references('id')->on('posts');
      $table->index(['post_id', 'version']);
    });
  }

  public function down() {
    Schema::dropIfExists('post_contents');
  }

}
