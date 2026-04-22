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
       Schema::create('queues', function (Blueprint $table) {
        $table->id(); // queue_id
        $table->foreignId('patient_id')->constrained('patients');
        $table->foreignId('department_id')->constrained('departments');
        $table->foreignId('doctor_id')->nullable()->constrained('doctors'); 
        $table->integer('queue_number');
        $table->date('queue_date');
        $table->enum('status', ['pending', 'called', 'completed', 'cancelled'])->default('pending');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queues');
    }
};
