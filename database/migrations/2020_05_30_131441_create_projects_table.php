<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->json('type');
            $table->float('rate');
            $table->unsignedInteger('team_id');
            $table->timestamps();
        });
        Schema::create('project_task', function (Blueprint $table) {
            $table->id();
            $table->string('project_id');
            $table->string('task_id');
            $table->timestamps();
        });
        Schema::create('invoice_project', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->string('project_id');
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
        Schema::dropIfExists('projects');
        Schema::dropIfExists('project_task');
        Schema::dropIfExists('invoice_project');
    }
}
