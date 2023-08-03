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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('owner_name');
            $table->string('consultant_name');
            $table->string('consultant_email');
            $table->string('contractor_name');
            $table->string('contractor_email');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('project_logo');
            $table->string('project_description');
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
