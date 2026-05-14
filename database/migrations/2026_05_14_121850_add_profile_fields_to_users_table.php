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
        Schema::table('users', function (Blueprint $table) {
            $table->string('preferred_locale', 2)->default('it')->after('role');
            $table->string('avatar_path')->nullable()->after('preferred_locale');
            $table->string('phone')->nullable()->after('avatar_path');
            $table->string('company')->nullable()->after('phone');
            $table->text('bio')->nullable()->after('company');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'preferred_locale',
                'avatar_path',
                'phone',
                'company',
                'bio',
            ]);
        });
    }
};
