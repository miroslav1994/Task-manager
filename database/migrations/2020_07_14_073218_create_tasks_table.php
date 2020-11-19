<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('preduzece_id');
            $table->string('name');
            $table->string('comment');
            $table->integer('application_id');
            $table->mediumText('urgently');
            $table->date('wanted_end_date');
            $table->integer('status_id');
            $table->integer('approved_by');
            $table->timestamp('approved_at');
            $table->integer('responsible_user_id');
            $table->date('provided_end_date');
            $table->date('end_date');
            $table->integer('model_create_tasks_id');
            $table->integer('responsible_user_implementer_id');
            $table->string('file_name');
            $table->string('file');
            $table->string('extension');
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
        Schema::dropIfExists('tasks');
    }
}
