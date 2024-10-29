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
        Schema::create('gaji', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('karyawan')->onDelete('cascade');
        $table->decimal('gaji_pokok', 10, 2);
        $table->decimal('tunjangan', 10, 2)->default(0);
        $table->decimal('bonus', 10, 2)->default(0);
        $table->decimal('potongan', 10, 2)->default(0);
        $table->decimal('total_gaji', 10, 2);
        $table->string('bulan');
        $table->string('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gajis');
    }
};
