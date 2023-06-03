<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('Lessor')) {
            Schema::create('Lessor', function (Blueprint $table) {
                $table->increments('Lessor_id');
                $table->string('Lessor_name');
                $table->string('Lessor_email');
                $table->string('Lessor_phone', 20); // Chiều dài tối đa của số điện thoại là 20
                $table->string('Lessor_address');
                $table->string('Lessor_password');
                $table->timestamps();
            });
        }
         if (!Schema::hasTable('Renter')) {
            Schema::create('Renter', function (Blueprint $table) {
                $table->increments('Renter_id');
                $table->string('Renter_name');
                $table->string('Renter_email');
                $table->string('Renter_phone');
                $table->string('Renter_address');
                $table->string('Renter_password');
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('Address')) {
            Schema::create('Address', function ($table) {
                $table->increments('Address_id');
                $table->string('District');
                $table->string('Street',10000);
                $table->integer('Wards');
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('Apartment')) {
            Schema::create('Apartment', function (Blueprint $table) {
                $table->increments('Apartment_id');
                $table->unsignedInteger('Apartment_price'); // Sử dụng unsignedInteger cho giá trị không âm
                $table->unsignedInteger('Address_id');
                $table->foreign('Address_id')->references('Address_id')->on('Address')->onDelete('cascade');
                $table->string('Apartment_description');
                $table->unsignedInteger('Room_count'); // Sử dụng unsignedInteger cho giá trị không âm
                $table->unsignedInteger('Apartment_Area'); // Sử dụng unsignedInteger cho giá trị không âm
                $table->string('Apartment_image');
                $table->unsignedInteger('Lessor_id');
                $table->foreign('Lessor_id')->references('Lessor_id')->on('Lessor')->onDelete('cascade');
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('Service')) {
            Schema::create('Service', function (Blueprint $table) {
                $table->increments('Service_id');
                $table->string('Description');
                $table->string('Apartment_description');
                $table->unsignedInteger('Service_price'); // Sử dụng unsignedInteger cho giá trị không âm
                $table->string('Contact_info');
                $table->unsignedInteger('Apartment_id');
                $table->foreign('Apartment_id')->references('Apartment_id')->on('Apartment')->onDelete('cascade');
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('Contract')) {
            Schema::create('Contract', function (Blueprint $table) {
                $table->increments('Contract_id');
                $table->unsignedInteger('Lessor_id');
                $table->foreign('Lessor_id')->references('Lessor_id')->on('Lessor')->onDelete('cascade');
                $table->unsignedInteger('Renter_id');
                $table->foreign('Renter_id')->references('Renter_id')->on('Renter')->onDelete('cascade');
                $table->unsignedInteger('Apartment_id');
                $table->foreign('Apartment_id')->references('Apartment_id')->on('Apartment')->onDelete('cascade');
                $table->date('Start_date');
                $table->date('End_date');
                $table->integer('Price');
                $table->string('Payment_status');
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('Issue')) {
            Schema::create('Issue', function (Blueprint $table) {
                $table->increments('Issue_id');
                $table->unsignedInteger('Renter_id');
                $table->foreign('Renter_id')->references('Renter_id')->on('Renter')->onDelete('cascade');
                $table->unsignedInteger('Apartment_id');
                $table->foreign('Apartment_id')->references('Apartment_id')->on('Apartment')->onDelete('cascade');
                $table->string('Description');
                $table->date('Report_date');
                $table->integer('Price');
                $table->string('Status');
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('Schedule')) {
            Schema::create('Schedule', function (Blueprint $table) {
                $table->increments('Schedule_id');
                $table->unsignedInteger('Apartment_id');
                $table->foreign('Apartment_id')->references('Apartment_id')->on('Apartment')->onDelete('cascade');
                $table->date('Maintenance_date');
                $table->date('Duration');
                $table->string('Progress');
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('Rating')) {
            Schema::create('Rating', function (Blueprint $table) {
                $table->increments('Rating_id');
                $table->integer('Renter_id')->unsigned();
                $table->integer('Apartment_id')->unsigned();
                $table->integer('Rating_point');
                $table->string('Comments');
                $table->timestamps();
            });
        }
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
