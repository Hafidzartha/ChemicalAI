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
        Schema::create('hasil_analisis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_user');
            $table->string('video_path'); // relative storage path
            $table->string('analisis_mode');
            $table->json('array_param')->nullable();
            $table->json('hasil_analisis')->nullable(); // full analysis result
            $table->json('graf')->nullable();
            $table->float('durasi')->nullable();
            $table->float('akurasi')->nullable();
            $table->integer('data_point')->nullable();
            $table->text('interpretasi')->nullable();
            $table->text('rekomendasi')->nullable();
            $table->enum('status',['pending','processing','done','failed'])->default('pending');
            $table->timestamps();

            $table->index('id_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_analisis');
    }
};
