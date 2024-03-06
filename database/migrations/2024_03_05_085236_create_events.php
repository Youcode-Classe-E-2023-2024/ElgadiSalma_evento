<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->bigInteger('id_image')->nullable();
            $table->bigInteger('ville_id');
            $table->bigInteger('price');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('acceptation')->default(0);            
            $table->bigInteger('created_by');
            $table->bigInteger('nombre_place');
            $table->bigInteger('category_id');
            $table->dateTime('deadline');
            $table->timestamps();

            $table->foreign('ville_id')->references('id')->on('lieu')->onDelete('cascade');
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
