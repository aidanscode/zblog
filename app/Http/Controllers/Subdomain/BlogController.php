<?php

namespace App\Http\Controllers\Subdomain;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller {

  public function index(Blog $blog) {
    return view('blog.index', [
      'blog' => $blog
    ]);
  }

  public function manage(Blog $blog) {
    $posts = $blog->posts()->orderBy('created_at', 'DESC')->paginate(15);

    return view('blog.manage', [
      'blog' => $blog,
      'posts' => $posts
    ]);
  }

}
