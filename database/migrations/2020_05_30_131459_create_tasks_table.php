<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->unsignedInteger('project_id');
            $table->string('description')->nullable();
            $table->string('trello_card_id')->nullable();
            $table->decimal('hours', 3, 1)->default(0.0);
            $table->enum('type', ['sprint_backlog', 'in_progress', 'in_staging', 'in_production'])->default('sprint_backlog');
            $table->dateTime('finished_date')->nullable();
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
