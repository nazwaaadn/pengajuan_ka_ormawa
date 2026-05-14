<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Tabel Ormawa
        Schema::create('ormawa', function (Blueprint $table) {
            $table->id('id_ormawa');
            $table->string('nama_ormawa');
            $table->timestamps();
        });

    }

    public function down()  
    {
        Schema::dropIfExists('ormawa');
    }
};
