<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaypalLinkToAssignmentOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assignment_orders', function (Blueprint $table) {
            //
            $table->mediumText('paypal_link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assignment_orders', function (Blueprint $table) {
            //
            $table->dropColumn('paypal_link');
        });
    }
}
