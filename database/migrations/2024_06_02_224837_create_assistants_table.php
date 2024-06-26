<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assistants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number_id')->nullable()->unique();
            $table->string('first_name');
            $table->string('paternal_surname');
            $table->string('maternal_surname');
            $table->string('career')->nullable();
            $table->string('grade')->nullable();
            $table->string('area')->nullable();
            $table->string('gender');
            $table->string('user_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assistants');
    }
};
