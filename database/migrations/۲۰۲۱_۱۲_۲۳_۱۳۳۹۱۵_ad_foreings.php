<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdForeings extends Migration
{
 public function up()
 {
  Schema::table('ad_attribute_pivot', function (Blueprint $table) {
   $table->after('id', function (Blueprint $table) {
    $table->foreignId('ad_attribute_id')
          ->constrained()
          ->cascadeOnDelete();
    $table->foreignId('ad_id')
          ->constrained()
          ->cascadeOnDelete();
   });
  });
  Schema::table('ad_attribute_category_pivot', function (Blueprint $table) {
   $table->after('id', function (Blueprint $table) {
    $table->foreignId('ad_attribute_id')
          ->constrained()
          ->cascadeOnDelete();
    $table->foreignId('ad_category_id')
          ->constrained()
          ->cascadeOnDelete();
   });
  });
 }

 public function down()
 {
  Schema::table('ad_attribute_pivot', function (Blueprint $table) {
   $table->dropForeign(['ad_attribute_id']);
   $table->dropForeign(['ad_id']);
  });
  Schema::table('ad_attribute_category_pivot', function (Blueprint $table) {
   $table->dropForeign(['ad_attribute_id']);
   $table->dropForeign(['ad_category_id']);
  });
 }
}