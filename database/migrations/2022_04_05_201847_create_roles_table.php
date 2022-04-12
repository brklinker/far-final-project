<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug'); //admin
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            // $table->foreign('role_id')->references('id')->('roles');
            $table->foreignId('role_id')->constrained();
        });

        $roles = [
            'user' => 'User',
            'admin' => 'Admin',
            'anr' => 'Anr'
        ];

        foreach ($roles as $slug => $name) {
            DB::table('roles')->insert([
                'slug' => $slug,
                'name' => $name
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns('users', ['role_id']);
        Schema::dropIfExists('roles');
    }
}
