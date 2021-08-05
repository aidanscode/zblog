<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration {
  public function up() {
    Schema::create('blogs', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->comment('The owner of this blog');
      $table->string('display_name', 64);
      $table->string('subdomain', 32)->unique();
      $table->timestamps();

      $table->foreign('user_id')->references('id')->on('users');
    });
  }

  public function down() {
    Schema::dropIfExists('blogs');
  }
}
