<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('surats', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('jenis_surat');
        $table->string('prioritas');
        $table->string('tujuan');
        $table->string('perihal');
        $table->text('isi_surat');
        $table->json('lampiran')->nullable();
        $table->string('template')->nullable();
        $table->string('status')->default('diajukan'); // bisa: diajukan, disetujui, ditolak, dll
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
