<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsupansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asupans', function (Blueprint $table) {
            $table->id(); // auto-increment primary key
            $table->unsignedBigInteger('user_id'); // foreign key reference to users table
            $table->string('nama');
            $table->string('kadar_gula');
            $table->string('kadar_kalori');
            $table->date('tanggal_konsumsi');
            $table->string('waktu_konsumsi');
            $table->string('catatan')->nullable();
            $table->timestamps();

            // Foreign key constraint to link to the users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asupans');
    }
}
