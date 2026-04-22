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
        Schema::table('queues', function (Blueprint $table) {
            // Add indexes for frequently queried columns
            $table->index('department_id');
            $table->index('patient_id');
            $table->index('doctor_id');
            $table->index('status');
            $table->index('queue_date');
            // Add composite index for common query pattern
            $table->index(['department_id', 'status']);
            $table->index(['queue_date', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('queues', function (Blueprint $table) {
            $table->dropIndex(['department_id']);
            $table->dropIndex(['patient_id']);
            $table->dropIndex(['doctor_id']);
            $table->dropIndex(['status']);
            $table->dropIndex(['queue_date']);
            $table->dropIndex(['department_id', 'status']);
            $table->dropIndex(['queue_date', 'status']);
        });
    }
};
