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
        Schema::create('currency_prices', function (Blueprint $table) {
            $table->id();
            $table->string('base_currency');
            $table->string('qoute_currency');
            $table->foreignId('ticker_id')->index();
            $table->float('close_price');
            $table->float('prev_close');
            $table->float('percent_change');
            $table->date('prev_date');
            $table->enum('original_pair', ['yes', 'no']);
            $table->enum('jpy_pair', ['yes', 'no']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_prices');
    }
};
