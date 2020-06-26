<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersImagesTable extends Migration
{

    private $tableName = 'offers_images';

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
            $table->unsignedBigInteger('offer_id')->nullable();
            $table->text('name', 50);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('set null');
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
