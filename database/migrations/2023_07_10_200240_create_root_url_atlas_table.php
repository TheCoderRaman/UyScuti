<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('root_url_atlas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            
            $table->text('url');
            $table->json('domain_details')->nullable();

            $table->text('favicon')->nullable();
            $table->text('title')->nullable();
            $table->json('keywords')->nullable();
            $table->longText('description')->nullable();

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
        Schema::dropIfExists('root_url_atlas');
    }
};
