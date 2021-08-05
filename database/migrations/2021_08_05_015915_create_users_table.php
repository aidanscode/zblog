<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

  public function up() {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_source_type_id');
      $table->string('name');
      $table->string('email')->unique();
      $table->rememberToken();
      $table->timestamps();

      $table->foreign('user_source_type_id')->references('id')->on('user_source_types');
    });
  }

  public function down() {
    Schema::dropIfExists('users');
  }

}
