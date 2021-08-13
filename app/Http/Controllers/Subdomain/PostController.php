<?php

namespace App\Http\Controllers\Subdomain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Blog;
use App\Models\Post;

class PostController extends Controller {

  public function index(Blog $blog, Post $post) {
    return view('blog.post.show', [
      'blog' => $blog,
      'post' => $post
    ]);
  }

  public function create(Blog $blog) {
    return view('blog.post.create', ['blog' => $blog]);
  }

  public function store(Request $request, Blog $blog) {
    $request->validate([
      'title' => 'required|string|min:1',
      'content' => 'required|string|min:1'
    ]);

    $post = $blog->posts()->create([
      'author_id' => auth()->id(),
      'title' => $request->input('title'),
      'content' => $request->input('content')
    ]);

    return redirect($post->getViewUrl($blog))->with('success', 'Your post has been published!');
  }

}
