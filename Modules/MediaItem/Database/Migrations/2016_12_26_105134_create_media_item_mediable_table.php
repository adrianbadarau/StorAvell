<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaItemMediableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_item_mediable', function (Blueprint $table) {
            $table->integer('media_id',false,true);
            $table->morphs('mediable');
            $table->primary(['media_id', 'mediable_id', 'mediable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_item_mediable');
    }
}
