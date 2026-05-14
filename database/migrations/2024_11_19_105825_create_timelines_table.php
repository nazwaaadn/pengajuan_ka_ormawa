<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('timelines', function (Blueprint $table) {
        $table->id();
        $table->string('judul_timeline');
        $table->date('tanggal_timeline_awal');
        $table->date('tanggal_timeline_akhir');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('timelines');
}

};
