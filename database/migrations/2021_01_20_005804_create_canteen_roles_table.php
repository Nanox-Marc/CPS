<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCanteenRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canteen_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('role');
        });
        DB::table('canteen_roles')->insert([
            ['role' => 'Supervisor'],
            ['role' => 'Cashier']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('canteen_roles');
    }
}
