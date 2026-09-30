<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('issuer');
            $table->text('description')->nullable();
            $table->string('category')->nullable(); // Pelatihan, Magang, Lomba, Organisasi
            $table->unsignedSmallInteger('year')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('file_url')->nullable(); // link PDF/gambar sertifikat asli
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
