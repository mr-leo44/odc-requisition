<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  public function up()
  {
    Schema::create('livraisons', function (Blueprint $table) {
      $table->id();
      $table->foreignId('demande_detail_id')->references('id')->on('demande_details');
      $table->integer('quantite')->default(0);
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('livraisons');
  }

};
