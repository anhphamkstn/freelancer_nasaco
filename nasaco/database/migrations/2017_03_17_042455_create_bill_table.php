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
            $table->string('tinh')->nullable();
            $table->integer('ma_buu_chinh')->nullable();
            $table->string('dvt')->nullable();
            $table->double('sl_dat_hang')->nullable();
            $table->double('sl_thuc_xuat')->nullable();
            $table->double('sl_thanh_toan')->nullable();
            $table->double('con_lai')->nullable();
            $table->double('don_gia')->nullable();
            $table->double('thanh_tien_thanh_toan')->nullable();

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
        //
        Schema::dropIfExists('bills');
    }
}
