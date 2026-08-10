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
    Schema::create('attendances', function (Blueprint $table) {
        $table->id();
       
        $table->unsignedBigInteger('employee_id'); 
        $table->date('date');
        $table->time('check_in')->nullable();
        $table->time('check_out')->nullable();
        $table->string('working_hours')->nullable(); 
        $table->enum('status', ['Present', 'Late', 'Absent', 'Half Day'])->default('Present');
        $table->timestamps();
    });
}
};
