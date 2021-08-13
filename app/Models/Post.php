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

  /**
   * ROUTES
   */
  public function getViewUrl(Blog $blog = null) {
    if (is_null($blog) || $blog->id !== $this->blog_id) {
      $blog = $this->blog;
    }

    return route('post.view', [
      'blog' => $blog->subdomain,
      'post' => $this
    ]);
  }

}
