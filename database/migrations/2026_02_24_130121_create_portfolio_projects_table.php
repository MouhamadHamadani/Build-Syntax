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
        Schema::create('portfolio_projects', function (Blueprint $table) {
            $table->id(); $table->string('title');
            $table->text('description');
            $table->enum('category', ['web', 'ecommerce', 'mobile', 'other'])->default('web');
            $table->json('technologies')->nullable();
            $table->string('project_url', 500)->nullable();
            $table->string('image_url', 500)->nullable();
            $table->boolean('featured')->default(false);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['category', 'featured']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_projects');
    }
};
