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
        Schema::create('employees', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('employee_id',15)->nullable();
            $table->string('name',50)->nullable();
            $table->string('email',150)->nullable();
            $table->string('contact',10)->nullable();
            $table->string('address',255)->nullable();
            $table->decimal('salary',9,2)->nullable();
            $table->smallInteger('manager_id')->nullable();
            $table->tinyInteger('department_id')->nullable();
            $table->tinyInteger('designation_id')->nullable();
            $table->date('joining_date')->nullable();
            $table->boolean('is_active')->default(1);
            $table->tinyInteger('created_by')->nullable();
            $table->tinyInteger('updated_by')->nullable();
            $table->timestamps();
            $table->dropColumn(['created_at', 'updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
