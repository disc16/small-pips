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
        Schema::create('trade_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->foreignId('ticker_id')->index();
            $table->datetime('entry_date');
            $table->time('entry_time', precision: 0);
            $table->foreignId('entry_time_id')->index();
            $table->string('order_type')->nullable();
            $table->string('position')->nullable();
            $table->string('stock_sentiment')->nullable();
            $table->double('acct_curr_pair_price')->nullable();
            $table->string('trading_strategy_id')->nullable();
            $table->foreignId('economic_indicator_id')->index()->nullable();
            $table->string('ec_result')->nullable();
            $table->string('trade_sentiment')->nullable();
            $table->double('entry_price')->nullable();
            $table->double('stop_price')->nullable();
            $table->double('manual_risk_value')->nullable();
            $table->double('lots')->nullable();
            $table->double('risk_value')->nullable();
            $table->double('risk_pips')->nullable();
            $table->json('targets')->nullable();
            $table->datetime('actual_exit_date')->nullable();
            $table->time('actual_exit_time', precision: 0)->nullable();
            $table->foreignId('actual_exit_time_id')->index()->nullable();
            $table->double('actual_exit_price')->nullable();
            $table->double('actual_profit_loss')->nullable();
            $table->double('actual_actual_profit_loss')->nullable();
            $table->string('actual_status')->nullable();
            $table->integer('actual_holding_period')->nullable();
            $table->double('actual_percent_profit_loss')->nullable();
            $table->double('actual_reward_ratio')->nullable();
            $table->string('actual_remarks')->nullable();
            $table->datetime('system_exit_date')->nullable();
            $table->time('system_exit_time', precision: 0)->nullable();
            $table->foreignId('system_exit_time_id')->index()->nullable();
            $table->double('system_exit_price')->nullable();
            $table->double('system_profit_loss')->nullable();
            $table->double('system_actual_profit_loss')->nullable();
            $table->string('system_status')->nullable();
            $table->integer('system_holding_period')->nullable();
            $table->double('system_percent_profit_loss')->nullable();
            $table->double('system_reward_ratio')->nullable();
            $table->string('tf')->nullable();
            $table->string('open_chart')->nullable();
            $table->string('exit_chart')->nullable();
            $table->longtext('note')->nullable();
            $table->string('session')->nullable();
            $table->string('reason')->nullable();
            $table->foreignId('currency_price_id')->index()->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trade_records');
    }
};
