<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model {

  protected $fillable = [
    'user_id', 'display_name', 'subdomain'
  ];

  public function getBlogIndexUrl() {
    return route('blog.index', ['blog' => $this->subdomain]);
  }

}
