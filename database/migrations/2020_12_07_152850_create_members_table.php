<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('firstname')->nullable(false);
            $table->string('lastname')->nullable(false);
            $table->date('birthdate')->nullable(false);
            $table->string('report_subject')->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->string('country')->nullable(false);
            $table->string('phone', 18)->nullable(false);
            
            $table->string('company')->nullable();
            $table->string('position')->nullable();
            $table->text('about')->nullable();
            $table->string('photo')->nullable();

            $table->boolean('visible')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
