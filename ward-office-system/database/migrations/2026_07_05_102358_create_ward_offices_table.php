<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ward_offices', function (Blueprint $table) {
            $table->id();
            $table->string('ward_number');
            $table->string('municipality');
            $table->string('district');
            $table->string('contact_phone')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();

            $table->unique(['ward_number', 'municipality']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ward_offices');
    }
};
