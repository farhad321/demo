<?php

namespace App\Http\Controllers\Front\Blog;

use App\Http\Controllers\Controller;

class BlogController extends Controller
{
 public function frontBlogShow()
 {
  return view('front.pages.blog.show');
 }

 public function frontBlogCategoryIndexBlog()
 {
  return view('front.pages.blog.index');
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