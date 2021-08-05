<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSourceTypesTable extends Migration {

  public function up() {
    Schema::create('user_source_types', function (Blueprint $table) {
      $table->id();
      $table->string('name');
    });
  }

  public function down() {
    Schema::dropIfExists('user_source_types');
  }
}
