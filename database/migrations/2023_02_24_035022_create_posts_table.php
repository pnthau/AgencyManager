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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('company_id')->constrained(); 
            $table->string('job_title');
            $table->string('district');
            $table->string('city');
            $table->boolean('remote');
            $table->boolean('is_parttime');
            $table->integer('min_salary');
            $table->integer('max_salary');
            $table->integer('currency_salary')->default(1);
            $table->text('requirement')->nullable();
            $table->softDeletes();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('num_applications')->nullable();
            $table->integer('status')->default(0);
            $table->string('slug')->default("slug");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('posts');
    }
};
