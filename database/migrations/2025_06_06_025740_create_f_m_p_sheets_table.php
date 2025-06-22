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
        Schema::create('f_m_p_sheets', function (Blueprint $table) {
            $table->id();
            $table->string('ticker_pair');
            $table->string('ticker');
            $table->double('bid');
            $table->double('ask');
            $table->double('open');
            $table->double('low');
            $table->double('high');
            $table->double('changes');
            $table->datetime('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('f_m_p_sheets');
    }
};
