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
    Schema::create('salaries', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('employee_id');
        $table->string('month_year');
        $table->decimal('basic_salary', 10, 2);
        $table->decimal('bonus', 10, 2)->default(0.00);
        $table->decimal('deduction', 10, 2)->default(0.00);
        $table->decimal('net_salary', 10, 2);
        $table->enum('status', ['Paid', 'Pending'])->default('Paid');
        $table->timestamps();
    });
}
};
