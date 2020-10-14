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
            $table->integer('nis')->unique();
            $table->integer('id_kelas')->nullable();
            $table->integer('id_jurusan')->nullable();
            $table->integer('id_offering')->nullable();
            $table->text('fotoku')->nullable();
        });

        Schema::create('admins', function (Blueprint $table) {
            $table->id('id_admin');
            $table->text('nama_logo');
            $table->text('nama_instansi');
            $table->integer('batas_pinjam_buku')->nullable();
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
