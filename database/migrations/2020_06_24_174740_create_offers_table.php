<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{

    private $tableName = 'offers';

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
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->enum('status', ['INVISIBLE', 'VISIBLE', 'TO_DELETE', 'BANNED', 'VERIFICATION']);
            $table->unsignedBigInteger('category_id')->nullable();

            $table->float('price', 8, 2);

            $table->string('title', 120);
            $table->text('description');

            $table->text('location');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
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
