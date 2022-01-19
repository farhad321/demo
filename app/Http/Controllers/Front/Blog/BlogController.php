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
              ->firstOrFail();
  request()->request->add([
                           'post' => $post,
                          ]);
  return view('front.pages.blog.show', compact('post'));
 }

 public function frontBlogCategoryIndexBlog($page = 1)
 {
  request()->request->add([
                           'page' => $page
                          ]);
  $posts = Post::with([
                       'media' => function ($q) {
                        $q->whereCollectionName('SpecialImage');
                       },
                      ])
               ->whereHas('category', function (Builder $q) {
                return $q->whereSlug('blog');
               })
               ->latest()
               ->paginate(6, ['*'], '', $page);
  $urls = $posts->linkCollection();
  $urls = $urls->map(function ($item) {
   $stringable = Str::of($item['label']);
   if ($stringable->contains('Previous')) {
    $item['label'] = '&laquo;';
   }
   elseif ($stringable->contains('Next')) {
    $item['label'] = '&raquo;';
   }
   $item['url'] = Str::of($item['url'])
                     ->replaceMatches("/\/\d+/", '',)
                     ->replaceMatches("/\?\=/", '/',);
   return $item;
  });
  return view('front.pages.blog.index', compact('urls', 'posts',));
 }

 public function frontBlogCategoryIndexNews($page = 1)
 {
  request()->request->add([
                           'page' => $page
                          ]);
  $posts = Post::
  with([
        'media' => function ($q) {
         $q->whereCollectionName('SpecialImage');
        },
       ])
               ->whereHas('category', function (Builder $q) {
                return $q->whereSlug('news');
               })
               ->latest()
               ->paginate(6, ['*'], '', $page);
  $urls = $posts->linkCollection();
  $urls = $urls->map(function ($item) {
   $stringable = Str::of($item['label']);
   if ($stringable->contains('Previous')) {
    $item['label'] = '&laquo;';
   }
   elseif ($stringable->contains('Next')) {
    $item['label'] = '&raquo;';
   }
   $item['url'] = Str::of($item['url'])
                     ->replaceMatches("/\/\d+/", '',)
                     ->replaceMatches("/\?\=/", '/',);
   return $item;
  });
  return view('front.pages.blog.index', compact('urls', 'posts',));
 }

 public function frontBlogTagIndex($slug, $page = 1)
 {
  request()->request->add([
                           'page' => $page
                          ]);
  $posts = Post::
  withAllTags([$slug], 'post')
               ->with([
                       'media' => function ($q) {
                        $q->whereCollectionName('SpecialImage');
                       },
                      ])
               ->latest()
               ->paginate(6, ['*'], '', $page);
  $urls = $posts->linkCollection();
//  return
  $urls = $urls->map(function ($item) {
   $stringable = Str::of($item['label']);
   if ($stringable->contains('Previous')) {
    $item['label'] = '&laquo;';
   }
   elseif ($stringable->contains('Next')) {
    $item['label'] = '&raquo;';
   }
   $item['url'] = Str::of($item['url'])
                     ->replaceMatches("/\/\/page\/\d+/", '',)
                     ->replaceMatches("/\?\=/", '//page/',);
   return $item;
  });
  return view('front.pages.blog.index', compact('urls', 'posts',));
 }
}