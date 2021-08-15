<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostContent extends Model {

  protected $fillable = [
    'post_id',
    'version',
    'title',
    'content'
  ];

  public function post() {
    return $this->belongsTo(Post::class);
  }

  public function getTitle() {
    return $this->title;
  }

  public function getContent() {
    return $this->content;
  }

}
