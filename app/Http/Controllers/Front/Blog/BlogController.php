<?php

namespace App\Http\Controllers\Front\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Post;
use Illuminate\Database\Eloquent\Builder;
use Str;

class BlogController extends Controller
{
 public function frontBlogShow($Y, $M, $D, $slug)
 {
  $post = Post::whereSlug($slug)
              ->first();
  if ($post) {
   return view('front.pages.blog.show', compact('post'));
  }
 }

 public function frontBlogCategoryIndexBlog($page = 1)
 {
  request()->request->add([
                           'page' => $page
                          ]);
  $posts = Post::
  whereHas('category', function (Builder $q) {
   return $q->whereSlug('blog');
  })
               ->latest()
               ->paginate(6);
//  return
  $urls = $posts->linkCollection();
//return
  $urls = $urls->map(function ($item) {
   $stringable = Str::of($item['label']);
   if ($stringable->contains('Previous')) {
    $item['label'] = '&laquo;';
   }
   elseif ($stringable->contains('Next')) {
    $item['label'] = '&raquo;';
   }
   $item['url'] = Str::of($item['url'])
                     ->replaceMatches("/\d*\?page=/", '',);
   return $item;
  });
//  return view('blog.index', compact('urls', 'posts',));
  return view('front.pages.blog.index', compact('urls', 'posts',));
 }

 public function frontBlogCategoryIndexNews()
 {
  return view('front.pages.blog.index');
 }

 public function frontBlogTagIndex()
 {
  return view('front.pages.blog.index');
 }
}