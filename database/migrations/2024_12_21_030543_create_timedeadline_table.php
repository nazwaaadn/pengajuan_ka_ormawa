<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimedeadlineTable extends Migration
{
    public function up()
    {
        Schema::create('timedeadline', function (Blueprint $table) {
            $table->id();
            $table->date('submission_start_time')->nullable();
            $table->date('submission_end_time')->nullable();
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('timedeadline');
    }
}
