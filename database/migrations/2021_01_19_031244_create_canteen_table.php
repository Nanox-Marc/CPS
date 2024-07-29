<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCanteenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canteen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('canteen_name');
            $table->integer('status')->nullable();
            $table->timestamps();
        });
        DB::table('canteen')->insert([
            ['canteen_name' => 'N/A', 'status' => '1']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('canteen');
    }
}
