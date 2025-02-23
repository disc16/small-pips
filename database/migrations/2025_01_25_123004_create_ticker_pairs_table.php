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
        Schema::create('ticker_pairs', function (Blueprint $table) {
            $table->id();
            $table->string('ticker');
            $table->string('market_type');
            $table->string('description');
            $table->string('position');
            $table->string('sentiment_long');
            $table->string('sentiment_short');
            $table->float('board_lot');
            $table->integer('standard_lot');
            $table->integer('mini_lot');
            $table->integer('micro_lot');
            $table->float('pip_multiplier');
            $table->string('account_base_currency');
            $table->string('with_account_currency_pair');
            $table->string('account_currency_pair')->nullable();
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticker_pairs');
    }
};
