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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['citizen', 'officer', 'admin'])->default('citizen')->after('email');
            $table->string('phone')->nullable()->after('role');
            $table->string('citizenship_number')->nullable()->unique()->after('phone');
            $table->string('address')->nullable()->after('citizenship_number');
            $table->foreignId('ward_office_id')->nullable()->after('address')
                ->constrained('ward_offices')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['ward_office_id']);
            $table->dropColumn(['role', 'phone', 'citizenship_number', 'address', 'ward_office_id']);
        });
    }
};
