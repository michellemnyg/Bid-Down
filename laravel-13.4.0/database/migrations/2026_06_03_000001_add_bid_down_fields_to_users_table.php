<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('freelancer')->after('email');
            $table->string('phone')->nullable()->after('password');
            $table->string('job_title')->nullable()->after('phone');
            $table->string('location')->nullable()->after('job_title');
            $table->string('skills')->nullable()->after('location');
            $table->text('bio')->nullable()->after('skills');
            $table->string('portfolio_url')->nullable()->after('bio');
            $table->string('avatar_url')->nullable()->after('portfolio_url');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'phone',
                'job_title',
                'location',
                'skills',
                'bio',
                'portfolio_url',
                'avatar_url',
            ]);
        });
    }
};
