<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            // increment = kolom yang otomatis terisi sendirinya
            $table->increments('id'); 

            // unasignedInteger = acuan untuk menghubungkan antar tabel
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('type_id');

            // numerik biasa
            $table->integer('jumlah_pinjaman');
            $table->integer('jumlah_angsuran');
            $table->integer('lama_angsuran');

            // boolean = 0 atau 1
            $table->boolean('terverifikasi')->default(0);

            // date = mengambil tanggal
            $table->date('tanggal_pengajuan');
            $table->date('tanggal_persetujuan')->nullable(); // nullable boleh kosong
            $table->timestamps();


            // table relation
            // foreign = nama
            // references->on = mengambil id dari users
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('type_id')->references('id')->on('types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
