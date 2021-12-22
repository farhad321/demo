<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
 public function up()
 {
  Schema::create('ad_categories', function (Blueprint $table) {
   $table->id();
   $table->string('name');
   $table->string('slug')->unique();
   $table->longText('description')->nullable();
   $table->unsignedSmallInteger('position')->default(0);
   $table->boolean('is_visible')->default(false);
   $table->string('seo_title', 60)->nullable();
   $table->string('seo_description', 160)->nullable();
   $table->json('attributes')->nullable();
   $table->timestamps();
  });
 }

 public function down()
 {
  Schema::dropIfExists('ad_categories');
 }
}