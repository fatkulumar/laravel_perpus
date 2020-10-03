<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['user', 'manager', 'admin'])->default('user')->after('password');
            $table->integer('nis');
            $table->integer('id_kelas');
            $table->integer('id_jurusan');
            $table->integer('id_offering');
            $table->text('fotoku')->nullable();
        });

        Schema::create('admins', function (Blueprint $table) {
            $table->id('id_admin');
            $table->text('nama_logo');
            $table->text('nama_instansi');
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
        // Schema::dropIfExists('admin');
        Schema::table('users',function(Blueprint $table) {
            $table->dropColumn('role');
        });

        Schema::dropIfExists('admins');
    }
}
