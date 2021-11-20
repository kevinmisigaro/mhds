<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsuaranceCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->boolean('active')->default(false);
            $table->unsignedBigInteger('manager_id');
            $table->foreign('manager_id')->references('id')->on('users');
            $table->float('margin', 8, 2)->nullable();
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
        Schema::dropIfExists('insurance_companies');
    }
}
