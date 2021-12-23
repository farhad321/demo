<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdAttributeMapAd extends Migration
{
 public function up()
 {
  Schema::create('ad_attribute_pivot', function (Blueprint $table) {
   $table->id();
   $table->text('text')
         ->nullable();
   $table->boolean('boolean')
         ->nullable();
   $table->integer('integer')
         ->nullable();
   $table->float('float', 12, 4)
         ->nullable();
   $table->dateTime('date_time')
         ->nullable();
   $table->date('date')
         ->nullable();
   $table->json('json')
         ->nullable();
   $table->timestamps();
  });
 }

 public function down()
 {
  Schema::dropIfExists('ad_attribute_pivot');
 }
}