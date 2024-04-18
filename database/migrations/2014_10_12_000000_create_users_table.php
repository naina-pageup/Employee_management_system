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
        Schema::create('users', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name',50)->nullable();
            $table->string('email',150)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',75)->nullable();
            $table->enum('role', ['1', '2'])->comment("2 For superadmin and 1 for admin");
            $table->boolean('is_active')->default(1);
            $table->unsignedTinyInteger('created_by')->nullable();
            $table->unsignedTinyInteger('updated_by')->nullable(); 
            $table->timestamps();
            $table->dropColumn(['created_at', 'updated_at']);
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
