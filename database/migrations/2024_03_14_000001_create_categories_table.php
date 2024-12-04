<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // Seed initial categories
        DB::table('categories')->insert([
            ['name' => 'Course', 'slug' => 'course', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Live Class', 'slug' => 'live-class', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Modify courses table to use foreign key
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('category');
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained('categories');
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->enum('category', ['course', 'live-class']);
        });

        Schema::dropIfExists('categories');
    }
};