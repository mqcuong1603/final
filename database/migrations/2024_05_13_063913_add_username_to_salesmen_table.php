<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {   
        // Now add the unique username column
        Schema::table('salesmen', function (Blueprint $table) {
            $table->string('username')->after('email')->unique();
        });
    }

    public function down()
    {
        Schema::table('salesmen', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
};
