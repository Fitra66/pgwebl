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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama pasar
            $table->string('kategori'); // Misal: Paling Ramai, Paling Murah
            $table->unsignedInteger('jumlah')->default(0);
            $table->timestamps();

            $table->unique(['nama', 'kategori']); // Unik kombinasi nama pasar + kategori
        });
    }
};
