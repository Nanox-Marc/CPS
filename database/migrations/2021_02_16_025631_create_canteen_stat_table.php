<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCanteenStatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canteen_stat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status');
        });
        DB::table('canteen_stat')->insert([
            ['status' => 'Active'],
            ['status' => 'Inactive']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('canteen_stat');
    }
}
