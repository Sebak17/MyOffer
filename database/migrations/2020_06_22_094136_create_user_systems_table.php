<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSystemsTable extends Migration
{    

    private $tableName = 'users_system';
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->tableName))
            return;
        
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            
            $table->string('firstIP', 16);
            $table->string('activationHash', 64)->nullable();
            $table->integer('activationMailTime')->nullable();
            $table->string('passwordResetHash', 64)->nullable();
            $table->integer('passwordResetMailTime')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
