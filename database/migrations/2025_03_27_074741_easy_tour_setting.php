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
            $table->string('AppsLogo')->default('');
            $table->string('AppsEmail')->default('');
            $table->string('AppsPhone')->default('');
            $table->string('AppsAddress')->default('');
            $table->string('FacebookPage')->default('');
            $table->string('InstagramPage')->default('');
            $table->string('TwitterPage')->default('');
            $table->string('YoutubePage')->default('');
            $table->longtext('About')->default('');
            $table->longtext('AboutHeadline')->default('');
            $table->longtext('AboutIcon1')->default('');
            $table->longtext('AboutSubHeadline1')->default('');
            $table->longtext('AboutDescriptionSubHeadline1')->default('');
            $table->longtext('AboutIcon2')->default('');
            $table->longtext('AboutSubHeadline2')->default('');
            $table->longtext('AboutDescriptionSubHeadline2')->default('');
            $table->longtext('AboutIcon3')->default('');
            $table->longtext('AboutSubHeadline3')->default('');
            $table->longtext('AboutDescriptionSubHeadline3')->default('');
            $table->longtext('AboutImage')->default('');
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
