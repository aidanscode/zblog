<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class ProfileController extends Controller {

  public function index() {
    $blogs = auth()->user()->blogs;

    return view('pages.profile.index', [
      'blogs' => $blogs
    ]);
  }

  public function createBlog() {
    $user = auth()->user();

    if (!$user->canCreateNewBlog()) {
      return redirect(route('page.index'))->withErrors(['You can not create any more blogs!']);
    }

    return view('pages.profile.create_blog');
  }

  public function storeBlog(Request $request) {
    $user = auth()->user();

    if (!$user->canCreateNewBlog()) {
      return redirect(route('page.index'))->withErrors(['You can not create any more blogs!']);
    }

    $request->validate([
      'display_name' => 'required|string|min:1',
      'subdomain' => 'required|string|min:1|unique:App\Models\Blog,subdomain'
    ]);

    $blog = Blog::create([
      'display_name' => $request->input('display_name'),
      'subdomain' => $request->input('subdomain'),
      'user_id' => $user->id
    ]);

    return redirect($blog->getBlogIndexUrl())->with('success', "Successfully created your blog!");
  }

}
