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
        Schema::create('images', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('path'); // This will store the relative path to the image in the 'public' folder
            $table->boolean('is_active')->default(1);
            $table->unsignedInteger('created_by')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
