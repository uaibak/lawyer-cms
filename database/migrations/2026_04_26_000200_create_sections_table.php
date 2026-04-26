<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sections', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('page_id')->constrained()->cascadeOnDelete();
            $table->string('type');
            $table->unsignedInteger('sort_order')->default(1);
            $table->longText('content');
            $table->timestamps();

            $table->index(['page_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
