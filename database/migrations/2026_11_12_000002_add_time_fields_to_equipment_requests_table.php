<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('equipment_requests', function (Blueprint $table) {
            $table->time('time_needed')->nullable()->after('date_needed');
            $table->time('expected_return_time')->nullable()->after('expected_return_date');
        });
    }

    public function down(): void
    {
        Schema::table('equipment_requests', function (Blueprint $table) {
            $table->dropColumn(['time_needed', 'expected_return_time']);
        });
    }
};

