<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdAttributeCategoryPivot extends Migration
{
 public function up()
 {
  Schema::create('ad_attribute_category_pivot', function (Blueprint $table) {
   $table->id();
   //
   $table->timestamps();
  });
 }

 public function down()
 {
  Schema::dropIfExists('ad_attribute_category_pivot');
 }
}