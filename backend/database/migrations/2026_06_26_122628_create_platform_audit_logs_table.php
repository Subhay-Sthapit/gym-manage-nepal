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
        if ( !Schema::hasTable('platform_audit_logs')) {
            Schema::create('platform_audit_logs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('platform_admin_id')
                    ->nullable()
                    ->constrained('platform_admins')
                    ->nullOnDelete();
                $table->string('action');
                $table->foreignId('gym_id')
                    ->nullable()
                    ->constrained('gyms')
                    ->nullOnDelete();
                $table->json('meta')->nullable();
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platform_audit_logs');
    }
};
