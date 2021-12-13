<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUpdatedByToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faculty', function (Blueprint $table) {
            $table->bigInteger('updated_by')->nullable();
        });

        Schema::table('department', function (Blueprint $table) {
            $table->bigInteger('updated_by')->nullable();
        });

        Schema::table('staff', function (Blueprint $table) {
            $table->bigInteger('updated_by')->nullable();
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->bigInteger('updated_by')->nullable();
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
            $table->dropColumn('updated_by');
        });

        Schema::table('department', function (Blueprint $table) {
            $table->dropColumn('updated_by');
        });

        Schema::table('staff', function (Blueprint $table) {
            $table->dropColumn('updated_by');
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('updated_by');
        });
    }
}
