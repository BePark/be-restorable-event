<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Events extends Migration
{
	public function up()
	{
	    if(!Schema::hasTable('events'))
        {
            Schema::create('events',function(Blueprint $table)
            {
                $table->increments('id');
                $table->dateTime('occurred');
                $table->string('name', 255);
                $table->text('data');
                $table->index('occurred');
            });
        }
	}

	public function down()
	{
		Schema::dropIfExists('events');
	}
}
