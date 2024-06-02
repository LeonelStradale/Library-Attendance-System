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
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('assistant_id');
            $table->foreign('assistant_id')->references('id')->on('assistants')->onDelete('cascade');
            $table->date('attendance_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->time('entry_time');
            $table->time('departure_time')->nullable();
            $table->integer('total_hours')->nullable();
            $table->boolean('locker')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
