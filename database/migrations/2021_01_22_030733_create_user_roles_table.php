<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // 1 = Normal User
    // 2 = Payroll
    // 3 = Admin
    // 4 = Cashier
    // 5 = Canteen SV


    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->unique();
            $table->string('role_id');
            $table->integer('canteen_id')->nullable();
            $table->timestamps();
        });

        DB::table('user_roles')->insert([
            ['user_id' => '2912280', 'role_id' => '3', 'canteen_id' => '1'],
            ['user_id' => '2911498', 'role_id' => '3', 'canteen_id' => '1'],
            ['user_id' => '2912257', 'role_id' => '3', 'canteen_id' => '1']        
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
}
