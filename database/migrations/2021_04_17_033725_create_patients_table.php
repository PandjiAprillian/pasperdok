<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->char('nik', 16)->unique();
            $table->string('nama');
            $table->text('alamat');
            $table->date('tanggal_lahir');
            $table->char('jenis_kelamin', 1);
            $table->string('handphone', 30);
            $table->string('photo')->default('default_profile.jpg');
            $table->text('keluhan');
            $table->tinyInteger('rawat_inap')->default(0);
            $table->foreignId('room_id')->default(0)->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('patients');
    }
}
