<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnInStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // $table->renameColumn('old_col_name', 'new_col_name');

        if (Schema::hasColumn('students', 'new_column')) {

            Schema::table('students', function (Blueprint $table) {
                //
                // $table->renameColumn('new_column', 'new_column_rename');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('students', 'new_column_rename')) {

            Schema::table('students', function (Blueprint $table) {
                //
                // $table->renameColumn('new_column_rename', 'new_column');
            });
        }
    }
}
