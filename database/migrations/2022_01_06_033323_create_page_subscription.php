<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageSubscription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_subscription', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('page', 60)->index()->comment('粉絲專頁 ID');
            $table->string('app_id', 60)->index()->comment('應用程式 ID');
            $table->string('secret')->comment('應用程式密碼');
            $table->text('access_token')->comment('粉絲專頁存取權杖');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('建立時間');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('更新時間');
            $table->softDeletes()->comment('刪除時間');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_subscription');
    }
}
