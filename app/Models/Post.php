<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

  protected $fillable = [
    'blog_id',
    'author_id',
    'title',
    'content'
  ];

  public function author() {
    return $this->belongsTo(User::class, 'author_id');
  }

  public function blog() {
    return $this->belongsTo(Blog::class);
  }

  public function getContent() {
    return $this->content;
  }

  /**
   * ROUTES
   */
  public function getViewUrl(Blog $blog = null) {
    if (is_null($blog) || $blog->id !== $this->blog_id) {
      $blog = $this->blog;
    }

    return route('post.show', [
      'blog' => $blog->subdomain,
      'post' => $this
    ]);
  }

  public function getContentUrl(Blog $blog = null) {
    if (is_null($blog) || $blog->id !== $this->blog_id) {
      $blog = $this->blog;
    }

    return route('post.getContent', [
      'blog' => $blog->subdomain,
      'post' => $this
    ]);
  }

}
