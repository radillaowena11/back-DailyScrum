<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyScrumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_scrum', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->enum('team', array('DDS','Beon','DOT','Node1','Node2','React1','React2','Laravel','Laravel_Vue','android'));
            $table->string('activity_yesterday');
            $table->string('activity_today');
            $table->string('problem_yesterday');
            $table->string('solution');
            $table->string('date');
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
        Schema::dropIfExists('daily_scrum');
    }
}
