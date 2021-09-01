<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexOfRecordsColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('records', function (Blueprint $table) {
            $table->bigInteger('merchant_id')->unsigned()->change();

            $table->index('merchant_id');
            $table->index('from');
            $table->index('time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('records', function (Blueprint $table) {
            $table->bigInteger('merchant_id')->change();

            $table->dropIndex('merchant_id');
            $table->dropIndex('from');
            $table->dropIndex('time');
        });
    }
}
