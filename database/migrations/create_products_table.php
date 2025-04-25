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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('image_url');
            $table->json('additional_images')->nullable();
            $table->longText('description');
            $table->float('price');
            $table->timestamp('created_at')->useCurrent();
            $table->unsignedInteger('in_stock');
        });

        DB::statement("CREATE INDEX products_name_fulltext_idx ON products USING GIN (to_tsvector('english', name))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS products_name_fulltext_idx");
        Schema::dropIfExists('products');
    }
};
