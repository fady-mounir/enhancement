<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('driver_image')->nullable();
            $table->string('user_name')->comment('User Name For The Driver');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('team_id')->references('id')->on('teams');
            $table->string('driver_color_in_map')->comment('To See The Driver In Marker Map');
            $table->foreignId('vehicle_type_id')->nullable()->references('id')->on('vehicle_types');
            $table->string('vehicle_description')->nullable()->comment('To Enter The Year/Model For His Vehicle');
            $table->string('vehicle_licence_plate')->nullable()->unique()->comment('Vehicle Licence Plate Number');
            $table->string('Vehicle_color')->nullable()->comment('Vehicle Color');
            $table->boolean('driver_status')->default(0)->comment('It Show To Us If The Driver Is Available Or Not (Online , Offline ) ');
            $table->enum('device_type', ['android', 'iphone'])->comment('The Type Of Driver Device');
            $table->integer('total_orders_delivery')->default(0);
            $table->integer('total_deliver_today')->default(0);
            $table->integer('max_deliver_per_day')->comment('It Show The Number Of Order The User Can Delivery Per Day');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /*
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
