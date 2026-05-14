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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('status')->default('draft_manual')->after('body')->index();
            $table->boolean('ai_generated')->default(false)->after('status');
            $table->text('ai_prompt')->nullable()->after('ai_generated');
            $table->string('ai_model')->nullable()->after('ai_prompt');
            $table->text('ai_notes')->nullable()->after('ai_model');
            $table->foreignId('reviewed_by')->nullable()->after('ai_notes')->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable()->after('reviewed_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropConstrainedForeignId('reviewed_by');
            $table->dropColumn([
                'status',
                'ai_generated',
                'ai_prompt',
                'ai_model',
                'ai_notes',
                'reviewed_at',
            ]);
        });
    }
};
