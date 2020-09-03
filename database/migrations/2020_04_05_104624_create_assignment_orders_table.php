<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_orders', function (Blueprint $table) {
             $table->increments('id');
            
            $table->string('price');
           
        
            $table->mediumText('order_files')->nullable();
            $table->string('solution')->nullable();
            $table->integer('completed')->unsigned()->default(0);
            $table->integer('user_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->integer('no_of_pages')->unsigned();
            $table->integer('academic_level_id')->unsigned();
            $table->bigInteger('paper_id');
            $table->string('deadline');

            $table->string('status')->default('Processing');

            $table->softDeletes();
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
        Schema::dropIfExists('assignment_orders');
    }
}
