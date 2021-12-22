<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
 public function up()
 {
  Schema::create('ad_reports', function (Blueprint $table) {
   $table->id();
   $table->text('title')->nullable();
   $table->timestamps();
  });
 }

 public function down()
 {
  Schema::dropIfExists('ad_reports');
 }
}