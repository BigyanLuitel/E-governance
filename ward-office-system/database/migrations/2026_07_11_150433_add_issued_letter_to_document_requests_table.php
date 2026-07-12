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
        Schema::table('document_requests', function (Blueprint $table) {
            $table->string('reference_number')->nullable()->unique()->after('status');
            $table->string('issued_letter_path')->nullable()->after('reference_number');
            $table->timestamp('letter_issued_at')->nullable()->after('issued_letter_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('document_requests', function (Blueprint $table) {
            $table->dropColumn(['reference_number', 'issued_letter_path', 'letter_issued_at']);
        });
    }
};
