<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

  public function author() {
    return $this->belongsTo(User::class, 'author_id');
  }

  public function blog() {
    return $this->belongsTo(Blog::class);
  }

}
