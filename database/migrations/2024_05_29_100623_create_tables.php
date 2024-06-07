<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations
     */
    public function up(): void
    {

        Schema::create('switch_types', function (Blueprint $table) {
            $table->unsignedInteger('switch_type_id')->primary();
            $table->string('switch_type_name');
        });

        Schema::create('companies', function (Blueprint $table) {
            $table->string('company_id')->primary();
            $table->string('company_name');
        });

        
        Schema::create('switches', function (Blueprint $table) {
            $table->string('switch_id')->primary();
            $table->string('switch_name');
            $table->unsignedInteger('switch_type');
            $table->foreign('switch_type')->references('switch_type_id')->on('switch_types');
            $table->string('company_id');
            $table->foreign('company_id')->references('company_id')->on('companies');
            $table->unsignedInteger('activation_pressure');
            $table->unsignedInteger('bottom_out_force');
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->string('review_id')->primary();
            $table->string('switch_id');
            $table->foreign('switch_id')->references('switch_id')->on('switches');
            $table->string('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('title');
            $table->text('review_comment');
            $table->unsignedInteger('rate_star');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->string('user_id')->primary();
            $table->string('user_name');
            $table->string('email')->unique();
            $table->string('password');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('switches');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('users');
        Schema::dropIfExists('switch_types');
        Schema::dropIfExists('companies');
    }
};