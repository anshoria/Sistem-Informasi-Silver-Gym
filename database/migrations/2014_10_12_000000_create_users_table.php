<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->nullable();
            $table->date('tanggal_bergabung')->nullable();
            $table->date('tanggal_berakhir')->nullable();
            $table->string('no_member')->nullable()->unique();
            $table->string('nama');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('nohp');
            $table->text('alamat')->nullable();
            $table->string('gambar')->nullable();
            $table->string('password')->nullable();
            $table->boolean('is_member')->default(false);
            $table->boolean('is_admin')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
