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
        Schema::create('easytoursetting', function (Blueprint $table) {
            $table->id();
            $table->string('LegalName');
            $table->string('AppsName');
            $table->string('AppsLogo');
            $table->string('AppsEmail');
            $table->string('AppsPhone');
            $table->string('AppsAddress');
            $table->text('About');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('easytoursetting');
    }
};
