<?php

namespace App\Http\Controllers\Subdomain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Blog;
use App\Models\Post;

class PostController extends Controller {

  public function show(Blog $blog, Post $post, $version = 'latest') {
    $version = is_numeric($version) ? intval($version) : 'latest';
    $postContent = $post->getContentVersion($version);
    if (is_null($postContent)) {
      abort(404);
    }

    return view('blog.post.show', [
      'blog' => $blog,
      'post' => $post,
      'version' => $version
    ]);
  }

  public function getContent(Blog $blog, Post $post, $version = 'latest') {
    $version = is_numeric($version) ? intval($version) : 'latest';

    $postContent = $post->getContentVersion($version);
    if (is_null($postContent)) {
      abort(404);
    }

    return response()->json([
      'success' => true,
      'data' => [
        'title' => $postContent->getTitle(),
        'content' => $postContent->getContent()
      ]
    ]);
  }

  public function getVersionHistory(Blog $blog, Post $post) {
    return view('blog.post.version_history', [
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

    $post = Post::saveBlogPost(
      $blog,
      auth()->user(),
      $request->input('title'),
      $request->input('content')
    );

    return redirect($post->getViewUrl($blog))->with('success', 'Your post has been published!');
  }

  public function edit(Blog $blog, Post $post) {
    return view('blog.post.edit', [
      'blog' => $blog,
      'post' => $post
    ]);
  }

  public function update(Request $request, Blog $blog, Post $post) {
    $request->validate([
      'title' => 'required|string|min:1',
      'content' => 'required|string|min:1'
    ]);

    $post->saveNewVersion(
      $request->input('title'),
      $request->input('content')
    );

    return redirect($post->getViewUrl($blog))->with('success', 'You have updated your blog post!');
  }

}
