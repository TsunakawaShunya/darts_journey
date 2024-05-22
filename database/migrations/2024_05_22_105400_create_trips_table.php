<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title', 50);     // 旅行名
            $table->string('description', 200);     // 詳細
            $table->string('first_point', 30);     // 場所名
            $table->double('first_latitude');     // 出発地緯度
            $table->double('first_longitude');     // 出発地経度
            $table->date('trip_date');     // 旅行日
            $table->time('trip_time');     // 旅行時間
            $table->string('transpotation', 30);     // 移動手段
            $table->integer('status');     // 0:非公開，1:公開
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
        Schema::dropIfExists('trips');
    }
};
