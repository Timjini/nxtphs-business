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
        Schema::create('camps', function (Blueprint $table) {
            $table->uuid()->primary('id');
            $table->uuid('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->cascadeOnDelete();
            $table->string('title');
            $table->string('description');
            $table->string('imageUrl');
            $table->string('videoUrl');
            $table->string('slug');
            $table->longText('htmlContent');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camps');
    }
};
