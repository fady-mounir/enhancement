<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->references('id')->on('users');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('website_url');
            $table->text('address');
            $table->decimal('delivery_per_month');
            $table->boolean('is_active')->default(true);
            $table->string('hear_about_us');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stores',function (Blueprint $table){
            $table->dropForeign('stores_owner_id_foreign');
        });
        Schema::dropIfExists('stores');
    }
};
