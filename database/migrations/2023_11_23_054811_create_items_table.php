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
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            // Name
            $table->string('name')->nullable(false);

            // Slug
            $table->string('slug')->unique();

            // Relation to Brand and Type
            $table->foreignId('brand_id')->constrained();
            $table->foreignId('type_id')->constrained();

            // Description
            $table->text('photos')->nullable();
            $table->text('features')->nullable();
            $table->integer('price')->default(0);
            $table->integer('star')->default(0);
            $table->integer('review')->default(0);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item');
    }
};
