<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faculty', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('department', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('staff', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('courses', function (Blueprint $table) {
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
        Schema::table('faculty', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'updated_at']);
        });

        Schema::table('department', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'updated_at']);
        });

        Schema::table('staff', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'updated_at']);
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'updated_at']);
        });
    }
}
