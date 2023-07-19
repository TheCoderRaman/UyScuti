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
        Schema::create('sub_url_atlas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('root_url_id');

            $table->string('type');
            $table->string('devices');

            $table->text('url');
            $table->text('from_Url')->nullable();
            
            $table->text('title')->nullable();
            $table->json('keywords')->nullable();
            $table->longText('description')->nullable();

            $table->bigInteger('visits')->default(0);
            
            $table->string('modified_at')->nullable();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('root_url_id')->references('id')->on('root_url_atlas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_url_atlas');
    }
};
