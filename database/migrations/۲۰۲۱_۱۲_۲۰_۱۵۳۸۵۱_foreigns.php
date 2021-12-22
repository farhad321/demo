<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Foreigns extends Migration
{
 public function up()
 {
  Schema::table('users', function (Blueprint $table) {
   $table->after('id', function (Blueprint $table) {
    $table->foreignId('state_id')
          ->nullable()
          ->constrained('address_states')
          ->cascadeOnDelete();
    $table->foreignId('city_id')
          ->nullable()
          ->constrained('address_cities')
          ->cascadeOnDelete();
   });
  });
  Schema::table('ads', function (Blueprint $table) {
   $table->after('id', function (Blueprint $table) {
    $table->foreignId('user_id')
          ->nullable()
          ->constrained()
          ->cascadeOnDelete();
    $table->foreignId('state_id')
          ->nullable()
          ->constrained('address_states')
          ->cascadeOnDelete();
    $table->foreignId('city_id')
          ->nullable()
          ->constrained('address_cities')
          ->cascadeOnDelete();
   });
  });
  Schema::table('ad_reviews', function (Blueprint $table) {
   $table->after('id', function (Blueprint $table) {
    $table->foreignId('user_id')
          ->nullable()
          ->constrained()
          ->cascadeOnDelete();
    $table->foreignId('ad_id')
          ->nullable()
          ->constrained()
          ->cascadeOnDelete();
   });
  });
  Schema::table('ad_reports', function (Blueprint $table) {
   $table->after('id', function (Blueprint $table) {
    $table->foreignId('user_id')
          ->nullable()
          ->constrained()
          ->cascadeOnDelete();
    $table->foreignId('ad_id')
          ->nullable()
          ->constrained()
          ->cascadeOnDelete();
   });
  });
  Schema::table('ad_favorites', function (Blueprint $table) {
   $table->after('id', function (Blueprint $table) {
    $table->foreignId('user_id')
          ->nullable()
          ->constrained()
          ->cascadeOnDelete();
    $table->foreignId('ad_id')
          ->nullable()
          ->constrained()
          ->cascadeOnDelete();
   });
  });
  Schema::table('address_cities', function (Blueprint $table) {
   $table->after('id', function (Blueprint $table) {
    $table->foreignId('state_id')
          ->nullable()
          ->constrained('address_states')
          ->cascadeOnDelete();
   });
  });
  Schema::table('ad_categories', function (Blueprint $table) {
   $table->after('id', function (Blueprint $table) {
    $table->foreignId('parent_id')
          ->nullable()
          ->constrained('ad_categories')
          ->cascadeOnDelete();
   });
  });
  Schema::table('ad_category_pivot', function (Blueprint $table) {
   $table->after('id', function (Blueprint $table) {
    $table->foreignId('ad_category_id')
          ->constrained()
          ->cascadeOnDelete();
    $table->foreignId('ad_id')
          ->constrained()
          ->cascadeOnDelete();
   });
  });
 }

 public function down()
 {
  Schema::table('ads', function (Blueprint $table) {
   $table->dropForeign(['user_id']);
   $table->dropForeign(['state_id']);
   $table->dropForeign(['city_id']);
  });
  Schema::table('ad_reviews', function (Blueprint $table) {
   $table->dropForeign(['user_id']);
   $table->dropForeign(['ad_id']);
  });
  Schema::table('ad_reports', function (Blueprint $table) {
   $table->dropForeign(['user_id']);
   $table->dropForeign(['ad_id']);
  });
  Schema::table('ad_favorites', function (Blueprint $table) {
   $table->dropForeign(['user_id']);
   $table->dropForeign(['ad_id']);
  });
  Schema::table('address_cities', function (Blueprint $table) {
   $table->dropForeign(['state_id']);
  });
  Schema::table('ad_categories', function (Blueprint $table) {
   $table->dropForeign(['parent_id']);
  });
  Schema::table('ad_category_pivot', function (Blueprint $table) {
   $table->dropForeign(['ad_category_id']);
   $table->dropForeign(['ad_id']);
  });
 }
}