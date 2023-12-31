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
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->string('building_cover_img');
            $table->string('building_title');
            $table->string('building_location');
            $table->integer('category_id');
            $table->string('area')->nullable();
            $table->string('place')->nullable();
            $table->string('rooms_num')->nullable();
            $table->string('floor')->nullable();
            $table->string('floor_num')->nullable();
            $table->string('bathroom_num')->nullable();
            $table->string('building_size')->nullable();
            $table->string('building_price')->nullable();
            $table->enum('building_selling_status',['rent ','sell'])->default('rent');
            $table->enum('building_avilability_status',['bussy ','empty'])->default('empty');
            $table->enum('wifi_status',['yes','no'])->default('yes');
            $table->enum('parking_status',['yes','no'])->default('yes');
            $table->string('building_desc')->nullable();
            $table->integer('added_by')->nullable();
            $table->string('notes')->nullable();
            $table->integer('owner_id')->nullable();
            $table->integer('tenant_id')->nullable();
            $table->integer('contract_price');
            $table->date('contract_date');
            $table->string('contract_img')->nullable();
            $table->string('contract_longtime');
            $table->enum('status',['active','inactive'])->default('active');
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
        Schema::dropIfExists('buildings');
    }
};
