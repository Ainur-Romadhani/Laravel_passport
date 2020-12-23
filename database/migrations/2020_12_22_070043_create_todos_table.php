<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id('id_todos');
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('proggress');
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            $table->string('delete_by')->nullable();
            $table->date('deleted_at')->nullable();
            $table->timestamps();
            $table->bigInteger('user_id')->unsigned();
        });

        Schema::table('todos',function(Blueprint $table){
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todos');
    }
}
