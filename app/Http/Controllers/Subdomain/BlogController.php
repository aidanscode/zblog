<?php

namespace App\Http\Controllers\Subdomain;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller {

  public function index(Blog $blog) {
    return "Welcome to {$blog->display_name}!";
  }

}
