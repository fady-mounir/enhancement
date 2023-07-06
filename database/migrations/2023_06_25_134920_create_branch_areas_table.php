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
        Schema::create('branch_areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->references('id')->on('store_branches');
            $table->foreignId('area_id')->references('id')->on('areas');
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
        Schema::table('branch_areas', function (Blueprint $table) {
            $table->dropForeign('branch_areas_branch_id_foreign');
            $table->dropForeign('branch_areas_area_id_foreign');
        });
        Schema::dropIfExists('branch_areas');
    }
};
