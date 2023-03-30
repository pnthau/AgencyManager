<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (Schema::hasColumns('users', ['city', 'password', 'company_id'])) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('city')->nullable()->change();
                $table->string('password')->nullable()->change();
                $table->foreignId('company_id')->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        // if (Schema::hasColumns('users', ['city', 'password', 'company_id'])) {
        //     Schema::table('users', function (Blueprint $table) {
        //         $table->dropColumn(['city', 'password', 'company_id']);
        //     });
        // }
    }
};
