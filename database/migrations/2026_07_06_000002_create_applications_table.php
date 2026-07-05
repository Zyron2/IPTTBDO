<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submitted_by')->constrained('users')->cascadeOnDelete();
            $table->string('tracking_no')->unique();
            $table->string('branch');
            $table->string('application_type')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('proponent_name')->nullable();
            $table->string('inventor_name')->nullable();
            $table->string('startup_name')->nullable();
            $table->string('status')->default('for_evaluation');
            $table->date('date_filed')->nullable();
            $table->text('remarks')->nullable();
            $table->text('viewed_details')->nullable();
            $table->json('payload')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};