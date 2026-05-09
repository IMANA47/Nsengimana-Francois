<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_agent_memory', function (Blueprint $table) {
            $table->id();
            $table->string('category', 50); // skills, projects, experience, etc.
            $table->string('key', 100); // laravel, php, project_name, etc.
            $table->json('data'); // structured information
            $table->integer('priority')->default(1); // for response ordering
            $table->boolean('active')->default(true);
            $table->timestamps();
            
            $table->unique(['category', 'key']);
            $table->index(['category', 'active', 'priority']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_agent_memory');
    }
};
