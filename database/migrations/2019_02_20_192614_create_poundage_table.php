<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoundageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poundage', function (Blueprint $table) {
            $table->increments('id');
            $table->string('toll_item', 50)->comment('收费项');
            $table->decimal('sum',10,2)->comment('金额');
            $table->string('remark')->default('...')->comment('备注');
            $table->tinyInteger('status')->default(0)->comment('状态:0=没有使用,1=默认');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poundage');
    }
}
