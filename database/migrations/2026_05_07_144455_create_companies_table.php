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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name'); // Şirkətin rəsmi adı
            $table->string('name');         // Səlahiyyətli şəxsin ad, soyadı
            $table->string('email')->unique()->nullable(); // Giriş üçün unikal olmalıdır
            $table->string('phone')->nullable();
            $table->string('voen')->nullable();   // Ehtiyac olarsa VÖEN sahəsi
            $table->string('password');           // Giriş şifrəsi (mütləqdir)
            $table->string('status')->default('pending');
            $table->rememberToken();              // "Beni hatırla" funksiyası üçün (mütləqdir)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
