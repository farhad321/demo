<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdCategory extends Migration
{
 public function up()
 {
  Schema::create('ad_category_pivot', function (Blueprint $table) {
   $table->id();
   $table->boolean('is_main')
         ->nullable();
   $table->timestamps();
  });
 }

 public function down()
 {
  Schema::dropIfExists('ad_category_pivot');

 }
}