<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ngay')->nullable();
            $table->integer('thang')->nullable();
            $table->integer('nam')->nullable();
            $table->date('ngay_thang_nam')->nullable();
            $table->string('mat_hang')->nullable();
            $table->string('nhom_hang')->nullable();
            $table->string('dien_giai')->nullable();
            $table->integer('province_id');
            $table->string('dvt')->nullable();
            $table->double('sl_dat_hang')->nullable();
            $table->double('sl_thuc_xuat')->nullable();
            $table->double('sl_thanh_toan')->nullable();
            $table->double('con_lai')->nullable();
            $table->double('don_gia')->nullable();
            $table->double('thanh_tien_thanh_toan')->nullable();

            $table->timestamps();
        });

        Schema::table('bills', function(Blueprint $table) {
            $table->foreign('province_id')->references('id')->on('provinces');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('bills');
    }
}
