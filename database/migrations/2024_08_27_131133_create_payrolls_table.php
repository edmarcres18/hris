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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('gross_pay', 10, 2);
            $table->decimal('net_pay', 10, 2);
            $table->integer('days_worked');
            $table->decimal('overtime_hours', 5, 2);
            $table->decimal('overtime_pay', 8, 2);
            $table->foreignId('sss_id')->constrained();
            $table->foreignId('philhealth_id')->constrained();
            $table->foreignId('pagibig_id')->constrained();
            $table->foreignId('sss_loan_id')->nullable()->constrained();
            $table->foreignId('pagibig_loan_id')->nullable()->constrained();
            $table->foreignId('cash_advance_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
