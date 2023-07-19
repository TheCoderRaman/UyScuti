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
        Schema::create('crawled_url_atlas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('sub_url_id')->nullable();

            $table->text('url');
            $table->string('status');

            $table->string('modified_at')->nullable();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crawled_url_atlas');
    }
};
