<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('users');
            $table->string('image');
            $table->unsignedBigInteger('card_id');
            $table->foreign('card_id')->references('id')->on('insurance_cards');
            $table->boolean('approved_by_admin')->default(false);
            $table->boolean('approved_by_insurer')->default(false);
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->foreign('manager_id')->references('id')->on('users');
            $table->unsignedBigInteger('insurer_id')->nullable();
            $table->foreign('insurer_id')->references('id')->on('users');
            $table->date('delivery_date')->nullable();
            $table->string('hospital_name');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('insurance_companies');
            $table->longText('insurance_comment')->nullable();
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
        Schema::dropIfExists('prescriptions');
    }
}
