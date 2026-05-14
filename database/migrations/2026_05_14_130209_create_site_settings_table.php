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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->default('home')->unique();
            $table->string('hero_eyebrow')->nullable();
            $table->string('hero_title');
            $table->text('hero_body');
            $table->string('hero_image_path')->nullable();
            $table->string('primary_button_label')->nullable();
            $table->string('secondary_button_label')->nullable();
            $table->string('tertiary_button_label')->nullable();
            $table->string('metric_one_value')->nullable();
            $table->string('metric_one_label')->nullable();
            $table->string('metric_two_value')->nullable();
            $table->string('metric_two_label')->nullable();
            $table->string('metric_three_value')->nullable();
            $table->string('metric_three_label')->nullable();
            $table->string('hero_panel_title')->nullable();
            $table->string('hero_panel_body')->nullable();
            $table->string('destinations_heading')->nullable();
            $table->text('destinations_intro')->nullable();
            $table->string('packages_heading')->nullable();
            $table->text('packages_intro')->nullable();
            $table->string('assistant_eyebrow')->nullable();
            $table->string('assistant_heading')->nullable();
            $table->text('assistant_body')->nullable();
            $table->text('assistant_prompt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
