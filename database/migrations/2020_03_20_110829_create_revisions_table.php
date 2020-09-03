<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisions', function (Blueprint $table) {
            $table->increments('id');
            $table->biginteger('user_id');
            $table->bigInteger('service_id');
            $table->biginteger('assignment_order_id');
            $table->biginteger('iteration')->default(0);
            $table->mediumText('note')->nullable();
            $table->mediumText('file')->nullable();
            $table->tinyInteger('solved')->default(0);
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
        Schema::dropIfExists('revisions');
    }
}
