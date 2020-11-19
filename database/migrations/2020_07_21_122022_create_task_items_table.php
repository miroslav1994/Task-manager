<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id');
            $table->integer('company_id');
            $table->String('comment');
            $table->integer('number_od_hours');
            $table->integer('number_of_minutes');
            $table->integer('createdBy');
            $table->mediumText('see_user');
            $table->string('file');
            $table->mediumText('automatic_comment');
            $table->mediumText('notifications');
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
        Schema::dropIfExists('task_items');
    }
}
