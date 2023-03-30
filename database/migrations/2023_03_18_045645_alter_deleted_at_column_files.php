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
        if (!Schema::hasColumns('files', ['deleted_at'])) {
            Schema::table('files', function (Blueprint $table) {
                $table->softDeletes();
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
        if (Schema::hasColumns('files', ['deleted_at'])) {
            Schema::table('files', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        }
    }
};
