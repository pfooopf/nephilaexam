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
            $table->string('user_id'); //this can be changed to team_id if many users are assigned in that same task but you need to create a model for that and create a eloquoent relationship for that.
            $table->string('title'); // Task title
            $table->text('description')->nullable(); // Task description, can be null
            $table->boolean('completed')->default(false); // Completion status
            $table->datetime('duedate')->nullable();
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
