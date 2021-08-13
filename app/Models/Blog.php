<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model {

  protected $fillable = [
    'user_id', 'display_name', 'subdomain'
  ];

  public function creator() {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function posts() {
    return $this->hasMany(Post::class);
  }

  public function getBlogIndexUrl() {
    return route('blog.index', ['blog' => $this->subdomain]);
  }

  public function getDisplayName() {
    return $this->display_name;
  }

}
