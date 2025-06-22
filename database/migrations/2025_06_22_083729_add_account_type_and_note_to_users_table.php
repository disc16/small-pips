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
        Schema::table('users', function (Blueprint $table) {
            // $table->foreignId('account_type_id')->index()->default(1);
            // $table->string('subscription_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->dropIndex('users_account_type_id_index');
            // $table->dropColumn('account_type_id');
            // $table->dropColumn('subscription_note');
        });
    }
};
