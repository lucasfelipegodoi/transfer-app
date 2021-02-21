<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("users_type", function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type', 255)->unique();
        });

        DB::table("users_type")->insert([
        	[
                'id' => 1,
        		'type' => 'Comum',
            ],
        	[
                'id' => 2,
        		'type' => 'Lojista',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_type');
    }
}
