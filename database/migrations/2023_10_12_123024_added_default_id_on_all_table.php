<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {


        Schema::dropIfExists('carts');
        Schema::dropIfExists('products');
        Schema::dropIfExists('users');

        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->default(Str::uuid())->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table): void {
            $table->uuid('id')->default(Str::uuid())->primary();
            $table->string('name', 100);
            $table->decimal('price', 8, 2);
            $table->text('description');
            $table->string('image', 100);
            $table->timestamps();
        });
        Schema::create('carts', function (Blueprint $table) {
            $table->uuid('id')->default(Str::uuid())->primary();
            $table->uuid('user_id');
            $table->uuid('product_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->uuid('id')->primary()->change();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary()->change();
        });
        Schema::table('carts', function (Blueprint $table) {
            $table->uuid('id')->primary()->change();
            $table->unsignedBigInteger('user_id')->change();
        });
    }
};
