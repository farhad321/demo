<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
 public function up()
 {
  Schema::create('address_states', function (Blueprint $table) {
   $table->id();
   $table->string('name', 255)->nullable();

   $table->timestamps();
  });
 }

 public function down()
 {
  Schema::dropIfExists('address_states');
 }
}