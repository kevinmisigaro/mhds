<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prescription_id');
            $table->foreign('prescription_id')->references('id')->on('prescriptions');
            $table->float('total_amount', 20,6);
            $table->float('approved_amount', 20,6);
            $table->boolean('dispatched_by_sp')->default(false);
            $table->boolean('invoice_generated')->default(false);
            $table->boolean('customer_delivery_accept')->default(false);
            $table->boolean('insurer_process_payment')->default(false);
            $table->boolean('sp_confirm_payment')->default(false);
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
        Schema::dropIfExists('deliveries');
    }
}
