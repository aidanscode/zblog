<?php

namespace App\Http\Controllers\Subdomain;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller {

  public function index(Blog $blog) {
    $posts = $blog->posts()->orderBy('created_at', 'DESC')->paginate(15);

    return view('blog.index', [
      'blog' => $blog,
      'posts' => $posts
    ]);
  }

  public function manage(Blog $blog) {
    return view('blog.manage.index', [
      'blog' => $blog
    ]);
  }

  public function managePosts(Blog $blog) {
    $posts = $blog->posts()->orderBy('created_at', 'DESC')->paginate(15);

    return view('blog.manage.posts', [
      'blog' => $blog,
      'posts' => $posts
    ]);
  }

}
