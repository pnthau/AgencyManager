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
        if (!Schema::hasColumn('posts', 'link')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->text('link')->nullable()->after('job_title');
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
         if (Schema::hasColumn('posts', 'link')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn(['link']);
            });
        }
    }
};
