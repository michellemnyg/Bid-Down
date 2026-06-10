<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->string('category');
            $table->text('description');
            $table->unsignedInteger('max_price');
            $table->dateTime('bid_deadline')->nullable();
            $table->boolean('blind_review')->default(true);
            $table->boolean('auto_stop')->default(false);
            $table->string('status')->default('open');
            $table->unsignedBigInteger('winner_bid_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
