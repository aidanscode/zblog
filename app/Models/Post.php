<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model {

  use SoftDeletes;

  protected $with = ['contents'];

  protected $fillable = [
    'blog_id',
    'author_id'
  ];

  public static function saveBlogPost(Blog $blog, User $author, string $title, string $content) : Post {
    $post = self::create([
      'blog_id' => $blog->id,
      'author_id' => $author->id
    ]);

    $post->saveNewVersion($title, $content);

    return $post;
  }

  public function author() {
    return $this->belongsTo(User::class, 'author_id');
  }

  public function blog() {
    return $this->belongsTo(Blog::class);
  }

  public function contents() {
    return $this->hasMany(PostContent::class)->orderBy('version', 'ASC');
  }

  public function getContentVersion($version = 'latest') : ?PostContent {
    $contents = $this->contents;

    //if arg is a string we're gonna assume they want the latest version, not bothering to check if it's actually "latest"
    if (gettype($version) === 'string') {
      $version = $contents->count();
    }

    return $contents->where('version', $version)->first();
  }

  public function getLatestTitle() {
    $latestPostContent = $this->getContentVersion('latest');

    return $latestPostContent->getTitle();
  }

  public function getLatestContent() {
    $latestPostContent = $this->getContentVersion('latest');

    return $latestPostContent->getContent();
  }

  /**
   * HELPERS
   */
  public function saveNewVersion(string $title, string $content) {
    $newVersionNumber = $this->contents->count() + 1;

    $this->contents()->save(
      tap(new PostContent(), function($postContent) use ($title, $content, $newVersionNumber) {
        $postContent->fill([
          'version' => $newVersionNumber,
          'title' => $title,
          'content' => $content
        ]);
      })
    );
  }

  /**
   * ROUTES
   */
  public function getUrlForRouteName(string $routeName, Blog $blog = null, array $customParams = []) {
    if (is_null($blog) || $blog->id !== $this->blog_id) {
      $blog = $this->blog;
    }

    $params = [
      'blog' => $blog->subdomain,
      'post' => $this
    ];
    $params = array_merge($params, $customParams);

    return route($routeName, $params);
  }

  public function getViewUrl(Blog $blog = null, $version = 'latest') {
    return $this->getUrlForRouteName('post.show', $blog, [
      'version' => $version
    ]);
  }

  public function getContentUrl(Blog $blog = null, $version = 'latest') {
    return $this->getUrlForRouteName('post.getContent', $blog, [
      'version' => $version
    ]);
  }

  public function getEditUrl(Blog $blog = null) {
    return $this->getUrlForRouteName('post.edit', $blog);
  }

  public function getUpdateUrl(Blog $blog = null) {
    return $this->getUrlForRouteName('post.update', $blog);
  }

  public function getVersionHistoryUrl(Blog $blog = null) {
    return $this->getUrlForRouteName('post.versionHistory', $blog);
  }

  public function getDeleteUrl(Blog $blog = null) {
    return $this->getUrlForRouteName('post.delete', $blog);
  }

}
