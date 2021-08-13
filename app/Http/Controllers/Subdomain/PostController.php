<?php

namespace App\Http\Controllers\Subdomain;

use App\Http\Controllers\Controller;

use App\Models\Blog;
use App\Models\Post;

class PostController extends Controller {

  public function index(Blog $blog, Post $post) {
    return view('blog.posts.index', [
      'blog' => $blog,
      'post' => $post
    ]);
  }

}
