<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration
{
 public function up()
 {
  Schema::create('ad_attributes', function (Blueprint $table) {
   $table->id();
   $table->string('name', 255)
         ->nullable();
   $table->string('type', 255)
         ->nullable();
   $table->json('options')
         ->nullable();
   $table->string('validation', 255)
         ->nullable();
   $table->integer('position')
         ->nullable();
   $table->boolean('is_filterable')
         ->default(0);
   $table->boolean('is_visible_on_front')
         ->default(0);
   $table->timestamps();
  });
 }

 public function down()
 {
  Schema::dropIfExists('ad_attributes');
 }
}