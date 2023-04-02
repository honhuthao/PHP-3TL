<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // drop the foreign key constraint
            $table->primary('user_id'); // set user_id as primary key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropPrimary('customers_user_id_primary'); // drop the primary key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // add the foreign key constraint back
        });
    }
};