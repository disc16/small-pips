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
        Schema::create('currency_price_updates', function (Blueprint $table) {
            $table->id();
            $table->string('base_currency');
            $table->string('qoute_currency');
            $table->string('ticker_pair');
            $table->string('right_pair');
            $table->string('orig_pair');
            $table->string('jpy_pair');
            $table->double('close_price');
            $table->double('prev_close');
            $table->double('percent_change');
            $table->date('prev_date');
            $table->double('open_price');
            $table->double('high_price');
            $table->double('low_price');
            $table->double('close_price_2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_price_updates');
    }
};
