<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
 public function up()
 {
  Schema::create('ad_reviews', function (Blueprint $table) {
   $table->id();
   $table->text('title')->nullable();
   $table->text('content')->nullable();
   $table->boolean('is_visible')->default(false);
   $table->timestamps();
  });
 }

 public function down()
 {
  Schema::dropIfExists('ad_reviews');
 }
}