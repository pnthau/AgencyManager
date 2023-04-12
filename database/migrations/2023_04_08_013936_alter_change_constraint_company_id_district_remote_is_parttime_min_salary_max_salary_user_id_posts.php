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
        if (Schema::hasColumns('posts', ['user_id', 'company_id', 'job_title', 'district', 'city', 'remote', 'is_parttime', 'min_salary', 'max_salary'])) {
            Schema::table('posts', function (Blueprint $table) {
                $table->string('job_title')->nullable()->change();
                $table->string('district')->nullable()->change();
                $table->string('city')->nullable()->change();
                $table->renameColumn('remote', 'remoteable')->boolean('remote')->nullable()->change();
                $table->boolean('is_parttime')->nullable()->change();
                $table->integer('min_salary')->nullable()->change();
                $table->integer('max_salary')->nullable()->change();
                $table->foreignId('user_id')->nullable()->change();
                $table->foreignId('company_id')->nullable()->change();
            });
        }
        if (Schema::hasColumns('companies', ['address', 'address2', 'district', 'zipcode', 'phone', 'email', 'logo'])) {
            Schema::table('companies', function (Blueprint $table) {
                $table->string('address')->nullable()->change();
                $table->string('address2')->nullable()->change();
                $table->string('district')->nullable()->change();
                $table->string('zipcode')->nullable()->change();
                $table->string('phone')->nullable()->change();
                $table->string('email')->nullable()->change();
                $table->string('logo')->nullable()->change();
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
    }
};
