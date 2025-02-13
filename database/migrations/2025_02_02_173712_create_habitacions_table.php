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
        Schema::create('habitacions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade');
            $table->string('tipo');
            $table->string('acomodacion');
            $table->timestamps();
            
            $table->foreignId('tipo_acomodacion_id')->constrained('tipo_acomodacions')->onDelete('cascade');
            // $table->foreign('tipo_acomodacion_id')->references('id')->on('tipo_acomodacions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('habitacions', function (Blueprint $table) {
            $table->dropForeign(['tipo_acomodacion_id']);
            $table->dropColumn('tipo_acomodacion_id');
        });

        Schema::dropIfExists('habitacions');
    }
};
