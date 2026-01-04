<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoWaToDaftarPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daftar_pegawai', function (Blueprint $table) {
            $table->string('no_wa', 20)->nullable()->after('nip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daftar_pegawai', function (Blueprint $table) {
            $table->dropColumn('no_wa');
        });
    }
}
