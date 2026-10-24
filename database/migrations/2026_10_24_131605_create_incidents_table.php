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
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // عنوان البلاغ
            $table->string('type'); // نوع الحادث
            $table->string('location'); // الموقع
            $table->string('status')->default('active'); // حالة البلاغ
            $table->decimal('lat', 10, 7)->nullable(); // خط العرض للخريطة
            $table->decimal('lng', 10, 7)->nullable(); // خط الطول للخريطة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};
