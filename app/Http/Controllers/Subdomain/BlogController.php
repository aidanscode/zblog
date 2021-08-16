<?php

namespace App\Http\Controllers\Subdomain;

use Illuminate\Http\Request;

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

  public function manageSettings(Blog $blog) {
    return view('blog.manage.settings', [
      'blog' => $blog
    ]);
  }

  public function saveSettings(Request $request, Blog $blog) {
    $request->validate([
      'display_name' => 'required|string|min:1'
    ]);

    $blog->fill([
      'display_name' => $request->input('display_name')
    ]);
    $blog->save();

    return redirect(route('blog.manage.settings', ['blog' => $blog->subdomain]))->with('success', 'Successfully saved blog settings!');
  }

}
